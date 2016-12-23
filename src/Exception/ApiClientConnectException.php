<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Exception;


use Exception;
use GuzzleHttp\Exception\ConnectException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ApiClientConnectException
 *
 * @package Dnhb\ApiClient
 */
class ApiClientConnectException extends ConnectException
{
    /**
     * ApiClientConnectException constructor.
     *
     * @param string $message
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param Exception $previous
     */
    public function __construct(
        $message = null,
        RequestInterface $request = null,
        ResponseInterface $response = null,
        Exception $previous = null
    ) {
        parent::__construct($message, $request, $response, $previous);
    }
}