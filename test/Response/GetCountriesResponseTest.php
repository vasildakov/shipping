<?php

namespace VasilDakov\ShippingTest\Response;

use PHPUnit\Framework\TestCase;
use VasilDakov\Shipping\Collection\ArrayCollection;
use VasilDakov\Shipping\Model\Country;
use VasilDakov\Shipping\Response\GetCountriesResponse;

final class GetCountriesResponseTest extends TestCase
{
    /**
     * @test
     */
    public function itCanBeConstructed(): void
    {
        self::assertInstanceOf(GetCountriesResponse::class, new GetCountriesResponse());
    }

    /**
     * @test
     */
    public function itCanFindByName(): void
    {
        $response = new GetCountriesResponse($this->getCountries());

        $country = $response->findByName('Bulgaria')->first();

        self::assertInstanceOf(Country::class, $country);
        self::assertEquals('Bulgaria', $country->nameEn);
    }

    /**
     * @test
     */
    public function itCanFindByIsoAlpha2(): void
    {
        $response = new GetCountriesResponse($this->getCountries());

        $country = $response->findByIsoAlpha2('BG')->first();

        self::assertInstanceOf(Country::class, $country);
        self::assertEquals('BG', $country->isoAlpha2);
    }


    /**
     * @test
     */
    public function itCanFindByIsoAlpha3(): void
    {
        $response = new GetCountriesResponse($this->getCountries());

        $country = $response->findByIsoAlpha3('BGR')->first();

        self::assertInstanceOf(Country::class, $country);
        self::assertEquals('BGR', $country->isoAlpha3);
    }


    private function getCountries(): array
    {
        $json = $this->getJson();
        $array = json_decode($json, true);

        $records = [];
        foreach ($array['countries'] as $row) {
            $records[] = new Country(
                id: null,
                name: $row['name'],
                nameEn: $row['nameEn'],
                isoAlpha2: $row['code2'],
                isoAlpha3: $row['code3']
            );
        }
        return $records;
    }

    private function getJson(): false|string
    {
        return file_get_contents(
            './vendor/vasildakov/econt/data/GetCountriesResponse.json'
        );
    }
}
