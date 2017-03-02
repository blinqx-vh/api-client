<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Tests\TestCase;


use Dnhb\ApiClient\Api;
use Dnhb\ApiClient\Auth\Auth;
use Dnhb\ApiClient\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use LogicException;
use PHPUnit\Framework\TestCase;

/**
 * Class ApiClientTestCase
 *
 * @package Dnhb\ApiClientTests\TestCase
 */
abstract class ApiClientTestCase extends TestCase
{
    /** @var array */
    private $historyContainer;

    /** */
    abstract public function testRequest();

    /**
     * @param string $responseBody
     * @return Api
     */
    protected function getApi(string $responseBody): Api
    {
        $this->historyContainer = [];
        $history = Middleware::history($this->historyContainer);

        $mock = new MockHandler([
            new Response(200, [], $responseBody),
        ]);

        $stack = HandlerStack::create($mock);
        $stack->push($history);

        $guzzleClient = new \GuzzleHttp\Client(['handler' => $stack]);

        $auth = Auth::apiKey('key');

        $client = new Client($guzzleClient, $auth);
        return new Api($client);
    }

    /**
     * @param string $method
     * @param string $path
     * @param string $query
     */
    protected function assertRequestInContainer(string $method, string $path, string $query)
    {
        self::assertCount(1, $this->historyContainer); //only 1 request
        self::assertSame($method, $this->getExecutedRequest()->getMethod());
        self::assertSame($path, $this->getExecutedRequest()->getUri()->getPath());
        self::assertSame($query, $this->getExecutedRequest()->getUri()->getQuery());
    }

    /**
     * @return array
     */
    protected function getHistoryContainer(): array
    {
        return $this->historyContainer;
    }

    /**
     * @return Request
     */
    protected function getExecutedRequest(): Request
    {
        if (!isset($this->historyContainer[0]['request'])) {
            throw new LogicException('No requests were put in the history container yet');
        }

        return $this->historyContainer[0]['request'];
    }
}