<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Tests\Interest\Rate;


use Dnhb\ApiClient\Data\AvailableForType;
use Dnhb\ApiClient\Data\SortDirectionType;
use Dnhb\ApiClient\Data\SortInterestRatesByType;
use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class InterestRateTest
 *
 * @package Dnhb\ApiClientTests\Interest\Rate
 */
final class InterestRateTest extends ApiClientTestCase
{

    /**
     * Test the request.
     */
    public function testRequest()
    {
        $api = $this->getApi('
            {
              "data": [
                {
                  "code": "string",
                  "duration": "string",
                  "percentage": 0,
                  "nhg": true,
                  "rateClass": "string",
                  "marketValueMax": 0,
                  "providerId": 0,
                  "providerName": "string",
                  "labelId": 0,
                  "labelName": "string",
                  "productId": 0,
                  "productName": "string"
                }
              ]
            }
        ');

        $result = $api->interest()->getInterestRates(
            37,
            400,
            2529,
            new AvailableForType(AvailableForType::TYPE_CONTINUATION),
            true,
            100,
            true,
            0,
            true,
            new SortInterestRatesByType(SortInterestRatesByType::INTEREST_RATES_SORT_TYPE_PERCENTAGE),
            new SortDirectionType(SortDirectionType::DIRECTION_ASC),
            1,
            25
        );

        foreach ($result as $assertableArray) {
            $this->executeAssertChecks($assertableArray);
        }

        $this->assertRequestInContainer(
            Method::GET,
            '/interest/v1/interest-rates',
            implode('&', [
                'mortgageProviderId=37',
                'labelId=400',
                'productId=2529',
                'availableFor=CONTINUATION',
                'nhg=true',
                'loanToValuePercentage=100',
                'bestInterestOnly=true',
                'period=0',
                'onlyUseIncludedLabels=true',
                'sortBy=percentage',
                'sortDirection=ASC',
                'page=1',
                'limit=25',
                'api_key=key'
            ])
        );
    }

    /**
     * Assert check on array result return.
     *
     * @param $results
     */
    private function executeAssertChecks($results)
    {
        self::assertArrayHasKey('code', $results);
        self::assertArrayHasKey('duration', $results);
        self::assertArrayHasKey('percentage', $results);
        self::assertArrayHasKey('nhg', $results);
        self::assertArrayHasKey('rateClass', $results);
        self::assertArrayHasKey('providerId', $results);
        self::assertArrayHasKey('providerName', $results);
        self::assertArrayHasKey('labelId', $results);
        self::assertArrayHasKey('labelName', $results);
        self::assertArrayHasKey('productId', $results);
        self::assertArrayHasKey('productName', $results);
    }
}