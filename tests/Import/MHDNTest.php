<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Tests\Import;

use Dnhb\ApiClient\Request\Method;
use Dnhb\ApiClient\Tests\TestCase\ApiClientTestCase;

/**
 * Class MHDNTest
 */
final class MHDNTest extends ApiClientTestCase
{
    /** */
    public function testRequest()
    {
        $api = $this->getApi('{"data":{"id":1}}');

        $id = $api->import()->mHDN('<ExampleMessage></ExampleMessage>');

        $this->assertSame(1, $id);
        $this->assertRequestInContainer(
            Method::POST,
            '/client/v1/import/mhdn/insert',
            'api_key=key'
        );
    }
}