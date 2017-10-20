<?php

namespace Dnhb\ApiClient\Tests\Interest\Label;

use Dnhb\ApiClient\Data\AvailableForType;
use Dnhb\ApiClient\Data\MortgageType;
use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class BankLabelsTest
 */
final class BankLabelsTest extends ApiClientTestCase
{
    /**
     * Test the request.
     */
    public function testRequest()
    {
        $api = $this->getApi(
            '
            {
              "data": [
                {
                  "data": {
                    "id": 0,
                    "providerId": 0,
                    "name": "string"
                  }
                }
              ]
            }
        '
        );

        $result = $api->interest()->getBankLabels(
            1,
            null,
            new MortgageType(MortgageType::INTEREST_ONLY),
            new AvailableForType(AvailableForType::TYPE_BOTH),
            false,
            100.0,
            1,
            false,
            null,
            1,
            100
        );

        foreach ($result as $assertableArray) {
            $this->executeAssertChecks($assertableArray);
        }

        $this->assertRequestInContainer(
            Method::GET,
            '/interest/v1/label',
            implode(
                '&',
                [
                    'mortgageProviderId=1',
                    'repaymentType=INTEREST_ONLY',
                    'availableFor=BOTH',
                    'nhg=false',
                    'loanToValuePercentage=100',
                    'period=1',
                    'onlyUseIncludedLabels=false',
                    'page=1',
                    'limit=100',
                    'api_key=key',
                ]
            )
        );
    }

    /**
     * Assert check on array result return.
     *
     * @param $results
     */
    private function executeAssertChecks($results)
    {
        self::assertArrayHasKey('id', $results['data']);
        self::assertArrayHasKey('providerId', $results['data']);
        self::assertArrayHasKey('name', $results['data']);
    }
}