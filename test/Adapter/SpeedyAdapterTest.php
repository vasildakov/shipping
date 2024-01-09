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

final class SpeedyAdapterTest extends TestCase
{
    protected function setUp(): void
    {
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
        $adapter = new SpeedyAdapter();

        self::assertEquals('Speedy', $adapter->getName());
    }

    /**
     * @test
     */
    public function itCanGetCountries(): void
    {
        // Arrange
        $adapter = new SpeedyAdapter();
        $request = new GetCountriesRequest();

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
        $adapter = new SpeedyAdapter();
        $request = new GetCitiesRequest(isoAlpha3: 'BGR', countryId: 100);

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
        $adapter = new SpeedyAdapter();
        $request = new GetOfficesRequest(countryId: null, cityId: 68134);

        // Act
        $response = $adapter->getOffices($request);

        // Assert
        self::assertInstanceOf(GetOfficesResponse::class, $response);
    }
}
