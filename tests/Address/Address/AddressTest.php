<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Tests\Address\Address;

use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class AddressTest
 *
 * @package Dnhb\ApiClientTests\Address\Address
 */
final class AddressTest extends ApiClientTestCase
{
    /** */
    public function testRequest()
    {
        $api = $this->getApi(
            '{
              "data": [
                {
                  "street": "Snelgersmastraat",
                  "housenumber": "3",
                  "housenumber-addition": "I",
                  "city": "Appingedam",
                  "postalcode": "9901AA",
                  "municipality": "Appingedam",
                  "built": 1900
                }
              ],
              "meta": {
                "pagination": {
                  "total": 1,
                  "count": 1,
                  "per_page": 25,
                  "current_page": 1,
                  "total_pages": 1,
                  "links": []
                }
              }
            }'
        );

        $result = $api->address()->getAddress(
            null,
            null,
            '9901AA',
            '3',
            0,
            25
        );

        $this->assertResultKeys($result[0]);
        $this->assertResultSubset($result[0]);
    }

    /**
     * Assert given result has keys.
     *
     * @param array $result
     */
    private function assertResultKeys(array $result)
    {
        self::assertArrayHasKey('street', $result);
        self::assertArrayHasKey('housenumber', $result);
        self::assertArrayHasKey('housenumber-addition', $result);
        self::assertArrayHasKey('city', $result);
        self::assertArrayHasKey('postalcode', $result);
        self::assertArrayHasKey('municipality', $result);
        self::assertArrayHasKey('built', $result);
    }

    /**
     * Assert given result has correct subset.
     *
     * @param array $result
     */
    private function assertResultSubset(array $result)
    {
        self::assertArraySubset(
            [
                'street'               => 'Snelgersmastraat',
                'housenumber'          => '3',
                'housenumber-addition' => 'I',
                'city'                 => 'Appingedam',
                'postalcode'           => '9901AA',
                'municipality'         => 'Appingedam',
                'built'                => 1900,
            ],
            $result,
            true
        );
    }
}