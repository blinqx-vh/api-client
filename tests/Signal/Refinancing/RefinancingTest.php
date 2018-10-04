<?php
declare(strict_types=1);


namespace Dnhb\ApiClient\Tests\Signal\Refinancing;


use DateTime;
use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class RefinancingTest
 */
final class RefinancingTest extends ApiClientTestCase
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
                  "uuid": "7a029774-8ffb-4b41-abcd-2904bbae223b",
                  "clientId": 999,
                  "clientExternalId": "",
                  "savings": {
                    "monthly": 0.00,
                    "frt": 0.00
                  }
                },
                {
                  "uuid": "b4582c7b-8662-4c4d-bf22-a0e929090fc7",
                  "clientId": 999,
                  "clientExternalId": "",
                  "savings": {
                    "monthly": 0.00,
                    "frt": 0.00
                  }
                }
              ]
            }
        '
        );

        $result = $api->signal()->getRefinancingSignals(
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
            '/signal/v1/refinancing',
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
