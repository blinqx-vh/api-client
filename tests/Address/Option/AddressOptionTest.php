<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Tests\Address\Option;

use Dnhb\ApiClient\Data\FieldType;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class AddressOptionTest
 *
 * @package Dnhb\ApiClientTests\Address\Option
 */
final class AddressOptionTest extends ApiClientTestCase
{
    /** */
    public function testRequest()
    {
        $api = $this->getApi(
            '{
              "data": [
                "Snelgersmastraat"
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

        $result = $api->address()->getAddressOptions(
            null,
            null,
            '9901AA',
            null,
            FieldType::FIELD_STREET,
            0,
            25
        );

        self::assertSame('Snelgersmastraat', $result[0]);
    }
}