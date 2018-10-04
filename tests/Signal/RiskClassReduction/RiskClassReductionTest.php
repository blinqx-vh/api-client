<?php
declare(strict_types=1);


namespace Dnhb\ApiClient\Tests\Signal\RiskClassReduction;


use DateTime;
use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class RiskClassReductionTest
 */
final class RiskClassReductionTest extends ApiClientTestCase
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
                  "uuid": "61139af3-f0e7-40d4-85c0-28eea88e29d4",
                  "clientId": 999,
                  "clientExternalId": "",
                  "savings": {
                    "net": 7265.73,
                    "gross": 13404.14
                  }
                }
              ]
            }
        '
        );

        $result = $api->signal()->getRiskClassReductionSignals(
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
            '/signal/v1/risk-class-reduction',
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
