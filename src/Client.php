<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient;

use Dnhb\ApiClient\Contract\ApiRequestInterface;
use Dnhb\ApiClient\Contract\AuthInterface;
use Dnhb\ApiClient\Exception\ApiClientConnectException;
use Dnhb\ApiClient\Exception\ApiClientResponseException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;

/**
 * Class Client
 *
 * @package Dnhb\ApiClient
 */
class Client
{
    /** @var ClientInterface */
    private $client;
    /** @var AuthInterface */
    private $auth;
    /** @var string */
    private $host = 'https://api.hypotheekbond.nl';

    /**
     * Client constructor.
     *
     * @param ClientInterface $client
     * @param AuthInterface   $auth
     */
    public function __construct(ClientInterface $client, AuthInterface $auth)
    {
        $this->client = $client;
        $this->auth = $auth;
    }

    /**
     * @param ApiRequestInterface $request
     *
     * @return mixed
     * @throws ApiClientResponseException
     * @throws ApiClientConnectException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(ApiRequestInterface $request)
    {
        $requestParams = $request->getRequestParams();

        $requestParams[$this->auth->getKey()] = $this->auth->getValue();
        $paramString = http_build_query($requestParams);
        $url = "{$this->host}/{$request->getBaseUrl()}?{$paramString}";
        $method = $request->getMethod();

        try {
            $params = array_merge(
                [
                    'headers' => $request->getHeaders(),
                ],
                $request->getOptions()
            );
            $response = $this->client->request($method, $url, $params);
            $responseBody = $response->getBody()->getContents();

            return $request->getResponseTransformer()->transform(json_decode($responseBody, true));
        } catch (ClientException $e) {
            throw new ApiClientResponseException(
                $e->getMessage(), $e->getRequest(), $e->getResponse(), $e->getCode(),
                $e
            );
        } catch (ConnectException $e) {
            throw new ApiClientConnectException($e->getMessage(), $e->getRequest(), null, $e);
        }
    }

    /**
     * @param string $host
     *
     * @return Client
     */
    public function setHost($host): Client
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }
}