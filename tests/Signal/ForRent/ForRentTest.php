<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Tests\Signal\ForRent;

use DateTime;
use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class ForRentTest
 */
final class ForRentTest extends ApiClientTestCase
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
                  "uuid": "4d070efa-08fd-4516-bbcd-939c1ae7797a",
                  "clientId": 999,
                  "clientExternalId": "",
                  "offline": true,
                  "forRentSince": "2016-02-18T00:00:00+01:00",
                  "house": {
                    "street": "Straatnaam",
                    "number": "99",
                    "numberAddition": ""
                  }
                }
              ]
            }
        '
        );

        $result = $api->signal()->getForRentSignals(
            true,
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
            '/signal/v1/for-rent',
            implode(
                '&',
                [
                    'page=1',
                    'limit=100',
                    'new-since=2018-01-01T00%3A00%3A00%2B00%3A00',
                    'updated-since=2018-01-01T00%3A00%3A00%2B00%3A00',
                    'offline=true',
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
        self::assertArrayHasKey('offline', $results);
        self::assertArrayHasKey('forRentSince', $results);
        self::assertArrayHasKey('house', $results);
    }
}
