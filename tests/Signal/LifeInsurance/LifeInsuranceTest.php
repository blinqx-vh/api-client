<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Tests\Signal\LifeInsurance;

use DateTime;
use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class LifeInsuranceTest
 */
final class LifeInsuranceTest extends ApiClientTestCase
{
    /**
     * Test the request.
     *
     * @throws \Dnhb\ApiClient\Exception\ApiClientConnectException
     * @throws \Dnhb\ApiClient\Exception\ApiClientResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testRequest()
    {
        $api = $this->getApi(
            '
            {
              "data": [
                {
                  "uuid": "a99e7960-adfd-46de-b5ce-43dd8a3a7e70",
                  "clientId": 9999,
                  "clientExternalId": "",
                  "premium": {
                    "current": 87,
                    "possible": 53.32
                  },
                  "totalDifference": -6297.36
                }
              ]
            }
        '
        );

        $result = $api->signal()->getLifeInsurenaceSignals(
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
            '/signal/v1/life-insurance',
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
        self::assertArrayHasKey('premium', $results);
        self::assertArrayHasKey('totalDifference', $results);
    }
}
