<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Tests\Calculation\Mortgage\MaximumByValue;

use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class MaximumMortgageByValueTest
 *
 * @package Dnhb\ApiClientTests\Calculation\Mortgage\MaximumByValue
 */
class MaximumMortgageByValueTest extends ApiClientTestCase
{
    /** */
    public function testRequest()
    {
        $api = $this->getApi('{"data":{"result":102000.0}}');

        $result = $api->calculation()->getMaximumMortgageByValue(100000);

        self::assertSame(102000.0, $result);

        $this->assertRequestInContainer(
            Method::GET,
            '/calculation/v1/mortgage/maximum-by-value',
            implode(
                '&',
                [
                    'objectvalue=100000',
                    'api_key=key',
                ]
            )
        );
    }
}