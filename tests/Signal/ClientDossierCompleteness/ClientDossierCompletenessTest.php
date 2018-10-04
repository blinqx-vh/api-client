<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Tests\Signal\ClientDossierCompleteness;

use DateTime;
use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class ClientDossierCompletenessTest
 */
final class ClientDossierCompletenessTest extends ApiClientTestCase
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
                  "uuid": "4307a762-9fb1-43d4-aef9-e31e7e98a679",
                  "clientId": 999,
                  "clientExternalId": "",
                  "completeness": {
                    "percentage": 96
                  }
                }
              ]
            }
        '
        );

        $result = $api->signal()->getClientDossierCompletenessSignals(
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
            '/signal/v1/client-dossier-completeness',
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
        self::assertArrayHasKey('completeness', $results);
    }
}
