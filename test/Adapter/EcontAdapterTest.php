<?php

declare(strict_types=1);

namespace VasilDakov\ShippingTest\Adapter;

use PHPUnit\Framework\TestCase;
use VasilDakov\Econt\EcontInterface;
use VasilDakov\Shipping\Adapter\EcontAdapter;
use VasilDakov\Shipping\Model\Country;
use VasilDakov\Shipping\Request\GetCountriesRequest;
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
        $adapter = $this->getEcontAdapter();

        $this->client
            ->expects(self::once())
            ->method('getCountries')
            ->willReturn($this->getJson())
        ;

        $response = $adapter->getCountries(new GetCountriesRequest());

        self::assertInstanceOf(GetCountriesResponse::class, $response);
    }

    /**
     * @test
     */
    public function itCanTransformCountries(): void
    {
        $adapter = $this->getEcontAdapter();

        $this->client
            ->expects(self::once())
            ->method('getCountries')
            ->willReturn($this->getJson())
        ;

        $response = $adapter->getCountries(new GetCountriesRequest());
        $country = $response->countries->first();
        $array = $country->toArray();

        self::assertInstanceOf(Country::class, $country);
        self::assertArrayHasKey('name', $array);
        self::assertArrayHasKey('nameEn', $array);
        self::assertArrayHasKey('isoAlpha2', $array);
        self::assertArrayHasKey('isoAlpha3', $array);
    }


    /**
     * @test
     */
    public function itCanFindCountry(): void
    {
        $adapter = $this->getEcontAdapter();

        $json = $this->getJson();

        $this->client
            ->expects(self::once())
            ->method('getCountries')
            ->willReturn($json)
        ;

        $response = $adapter->getCountries(new GetCountriesRequest('Bulg'));
        $country = $response->countries->first();

        self::assertEquals(1, $response->countries->count());
        self::assertInstanceOf(Country::class, $country);
        self::assertEquals('Bulgaria', $country->nameEn);
        self::assertEquals('BGR', $country->isoAlpha3);
    }


    /**
     * @test
     */
    public function itCanReturnName(): void
    {
        $adapter = new EcontAdapter();

        self::assertEquals('Econt', $adapter->getName());
    }


    private function getEcontAdapter(): EcontAdapter
    {
        return new EcontAdapter($this->client);
    }


    private function getJson(): false|string
    {
        return file_get_contents(
            './vendor/vasildakov/econt/data/GetCountriesResponse.json'
        );
    }
}
