<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Tests\Signal\ForSale;

use DateTime;
use Dnhb\ApiClient\Data\ForSaleStatus;
use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class ForSaleTest
 */
final class ForSaleTest extends ApiClientTestCase
{
    /**
     * Test the request.
     *
     * @throws \Dnhb\ApiClient\Exception\ApiClientConnectException
     * @throws \Dnhb\ApiClient\Exception\ApiClientInvalidArgumentException
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
                  "uuid": "2a6a5102-2e90-492e-92e7-9287c17b5338",
                  "clientId": 9999,
                  "clientExternalId": "",
                  "status": "FOR_SALE",
                  "forSaleSince": "2018-08-01T00:00:00+02:00",
                  "house": {
                    "street": "Straatnaam",
                    "number": "999",
                    "numberAddition": ""
                  }
                }
              ]
            }
        '
        );

        $result = $api->signal()->getForSaleSignals(
            new ForSaleStatus(ForSaleStatus::FOR_SALE),
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
            '/signal/v1/for-sale',
            implode(
                '&',
                [
                    'page=1',
                    'limit=100',
                    'new-since=2018-01-01T00%3A00%3A00%2B00%3A00',
                    'updated-since=2018-01-01T00%3A00%3A00%2B00%3A00',
                    'status=FOR_SALE',
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
        self::assertArrayHasKey('status', $results);
        self::assertArrayHasKey('forSaleSince', $results);
        self::assertArrayHasKey('house', $results);
    }
}
