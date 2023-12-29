<?php

declare(strict_types=1);

namespace VasilDakov\ShippingTest\Adapter;

use PHPUnit\Framework\TestCase;
use VasilDakov\Econt\EcontInterface;
use VasilDakov\Shipping\Adapter\EcontAdapter;
use VasilDakov\Shipping\Model\Country;
use VasilDakov\Shipping\Response\GetCountriesResponse;

final class EcontAdapterTest extends TestCase
{
    private EcontInterface $client;

    protected function setUp(): void
    {
        $this->client = $this->createMock(EcontInterface::class);
        parent::setUp();
    }


    /**
     * @test
     */
    public function itCanBeConstructedWithoutArguments(): void
    {
        $adapter = new EcontAdapter();

        self::assertInstanceOf(EcontAdapter::class, $adapter);
    }

    /**
     * @test
     */
    public function itCanGetCountries(): void
    {
        $adapter = new EcontAdapter($this->client);

        $json = file_get_contents(
            './vendor/vasildakov/econt/data/GetCountriesResponse.json'
        );

        $this->client
            ->expects(self::once())
            ->method('getCountries')
            ->willReturn($json)
        ;

        $response = $adapter->getCountries();
        //var_dump($response);
        self::assertInstanceOf(GetCountriesResponse::class, $response);
    }

    /**
     * @test
     */
    public function itCanTransformCountries(): void
    {
        $adapter = new EcontAdapter($this->client);

        $json = file_get_contents(
            './vendor/vasildakov/econt/data/GetCountriesResponse.json'
        );

        $this->client
            ->expects(self::once())
            ->method('getCountries')
            ->willReturn($json)
        ;

        $response = $adapter->getCountries();
        $country = $response->countries[0];

        self::assertInstanceOf(Country::class, $country);
        self::assertArrayHasKey('id', (array) $country);
        self::assertArrayHasKey('name', (array) $country);
        self::assertArrayHasKey('nameEn', (array) $country);
        self::assertArrayHasKey('isoAlpha2', (array) $country);
        self::assertArrayHasKey('isoAlpha3', (array) $country);
    }
}
