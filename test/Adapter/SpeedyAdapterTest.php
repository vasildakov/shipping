<?php

namespace VasilDakov\ShippingTest\Adapter;

use PHPUnit\Framework\TestCase;
use VasilDakov\Shipping\Adapter\SpeedyAdapter;
use VasilDakov\Shipping\Request\GetCitiesRequest;
use VasilDakov\Shipping\Request\GetCountriesRequest;
use VasilDakov\Shipping\Request\GetOfficesRequest;
use VasilDakov\Shipping\Response\GetCitiesResponse;
use VasilDakov\Shipping\Response\GetCountriesResponse;
use VasilDakov\Shipping\Response\GetOfficesResponse;
use VasilDakov\Speedy\SpeedyInterface;

final class SpeedyAdapterTest extends TestCase
{
    protected SpeedyInterface $speedy;

    protected function setUp(): void
    {
        $this->speedy = $this->createMock(SpeedyInterface::class);

        parent::setUp();
    }

    /**
     * @test
     */
    public function itCanBeConstructedWithoutArguments(): void
    {
        $adapter = new SpeedyAdapter();

        self::assertInstanceOf(SpeedyAdapter::class, $adapter);
    }

    /**
     * @test
     */
    public function itCanReturnName(): void
    {
        $adapter = new SpeedyAdapter($this->speedy);

        self::assertEquals('Speedy', $adapter->getName());
    }

    /**
     * @test
     */
    public function itCanGetCountries(): void
    {
        // Arrange
        $json = file_get_contents('./vendor/vasildakov/speedy/test/Assets/Countries.json');

        $adapter = new SpeedyAdapter($this->speedy);
        $request = new GetCountriesRequest();

        $this->speedy->expects(self::once())->method('findCountry')->willReturn($json);

        // Act
        $response = $adapter->getCountries($request);

        // Assert
        self::assertInstanceOf(GetCountriesResponse::class, $response);
    }


    /**
     * @test
     */
    public function itCanGetCities(): void
    {
        // Arrange
        $json = $this->getSitesJson();
        $adapter = new SpeedyAdapter($this->speedy);
        $request = new GetCitiesRequest(isoAlpha3: 'BGR', countryId: 100);
        $this->speedy->expects(self::once())->method('findSite')->willReturn($json);

        // Act
        $response = $adapter->getCities($request);

        // Assert
        self::assertInstanceOf(GetCitiesResponse::class, $response);
    }


    /**
     * @test
     */
    public function itCanGetOfficesByCity(): void
    {
        // Arrange
        $json = $this->getOfficesJson();
        $adapter = new SpeedyAdapter($this->speedy);
        $request = new GetOfficesRequest(countryId: null, cityId: 68134);
        $this->speedy->expects(self::once())->method('findOffice')->willReturn($json);

        // Act
        $response = $adapter->getOffices($request);

        // Assert
        self::assertInstanceOf(GetOfficesResponse::class, $response);
    }

    private function getSitesJson(): false|string
    {
        return json_encode([
            'sites' => [
                [
                    "id" => 1,
                    "countryId" => 2,
                    "mainSiteId" => 3,
                    "type" => "Type",
                    "typeEn" => "Type in English",
                    "name" => "Name",
                    "nameEn" => "Name in English",
                ]
            ]
        ]);
    }

    private function getOfficesJson(): false|string
    {
        return json_encode([
            'offices' => [
                [
                    "id" => 1,
                    "countryId" => 2,
                    "name" => "Name",
                    "nameEn" => "Name in English",
                ]
            ]
        ]);
    }
}
