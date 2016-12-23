<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Tests\Calculation\Regulation;

use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class ConstructionAddedValueTest
 *
 * @package Dnhb\ApiClientTests\Calculation\Regulation
 */
final class ConstructionAddedValueTest extends ApiClientTestCase
{

    /** */
    public function testRequest()
    {
        $api = $this->getApi('{"data":{"result":40}}');

        $result = $api->calculation()->getConstructionAddedValue();

        self::assertSame(40.0, $result);

        $this->assertRequestInContainer(
            Method::GET,
            '/calculation/v1/regulation/construction-added-value',
            'api_key=key'
        );
    }
}