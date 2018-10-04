<?php
declare(strict_types=1);


namespace Dnhb\ApiClient\Tests\Signal\SavingsBasedMortgageRefinancing;


use DateTime;
use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class SavingsBasedMortgageRefinancingTest
 */
final class SavingsBasedMortgageRefinancingTest extends ApiClientTestCase
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
                  "uuid": "f15cba8b-f47e-4cdb-8b63-bff7340c7bd1",
                  "clientId": 999,
                  "clientExternalId": "",
                  "savings": {
                    "monthly": 341.68,
                    "frt": 6744.18
                  }
                }
              ]
            }
        '
        );

        $result = $api->signal()->getSavingsBasedMortgageRefinancingSignals(
            new DateTime('2018-01-01 00:00:00'),
            new DateTime('2018-01-01 00:00:00'),
            1,
            100
        );

        foreach ($result as $assertableArray) {
            $this->executeAssertChecks($assertableArray);
        }

        $this->assertRequestInContainer(
            Method::GET,
            '/signal/v1/refinancing-savings-based-mortgage',
            implode(
                '&',
                [
                    'page=1',
                    'limit=100',
                    'new-since=2018-01-01T00%3A00%3A00%2B00%3A00',
                    'updated-since=2018-01-01T00%3A00%3A00%2B00%3A00',
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
        self::assertArrayHasKey('uuid', $results);
        self::assertArrayHasKey('clientId', $results);
        self::assertArrayHasKey('clientExternalId', $results);
        self::assertArrayHasKey('savings', $results);
    }
}
