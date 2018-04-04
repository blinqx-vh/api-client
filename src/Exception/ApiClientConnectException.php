<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Exception;

use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ApiClientConnectException
 *
 * @package Dnhb\ApiClient
 */
class ApiClientConnectException extends ApiClientException
{
    /** @var RequestInterface */
    private $request;
    /** @var ResponseInterface */
    private $response;

    /**
     * ApiClientConnectException constructor.
     *
     * @param string            $message
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param Exception         $previous
     */
    public function __construct(
        $message,
        RequestInterface $request,
        ResponseInterface $response = null,
        Exception $previous = null
    ) {
        parent::__construct($message, 0, $previous);

        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
