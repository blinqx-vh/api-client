<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Tests\Calculation\Regulation;

use DateTime;
use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class AOWDateTest
 *
 * @package Dnhb\ApiClient\Tests\Calculation\Regulation
 */
final class AOWDateTest extends ApiClientTestCase
{
    /** */
    public function testRequest()
    {
        $api = $this->getApi('{"data":{"result":"2099-01-10"}}');

        $result = $api->calculation()->getAOWDate(new DateTime('1980-01-01'));

        self::assertSame('2099-01-10', $result->format('Y-m-d'));

        $this->assertRequestInContainer(
            Method::GET,
            '/calculation/v1/regulation/aow-date',
            implode(
                '&',
                [
                    'dateOfBirth=1980-01-01',
                    'api_key=key',
                ]
            )
        );
    }
}