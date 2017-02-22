<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Tests;


use Dnhb\ApiClient\Auth\Auth;
use Dnhb\ApiClient\Client;
use GuzzleHttp\Client as GuzzleHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * Class LiveUrlTest
 */
final class LiveUrlTest extends TestCase
{
    /**
     *
     */
    public function testLiveUrl()
    {
        $guzzleClient = new GuzzleHttpClient();

        $auth = Auth::apiKey('key');

        $client = new Client($guzzleClient, $auth);
        $url = $client->getHost();
        self::assertEquals('https://api.hypotheekbond.nl', $url);
    }
}