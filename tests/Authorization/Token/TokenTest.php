<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Tests\Calculation\Regulation;

use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class TokenTest
 *
 * @package Dnhb\ApiClientTests\Authorization\Token
 */
final class TokenTest extends ApiClientTestCase
{
    /** */
    public function testRequest()
    {
        $api = $this->getApi('{"data":{"token":"secret-token"}}');

        $result = $api->authorization()->token();

        self::assertSame('secret-token', $result);

        $this->assertRequestInContainer(
            Method::GET,
            '/auth/v1/token',
            'api_key=key'
        );
    }
}