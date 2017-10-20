<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Exception;

use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ApiClientResponseException
 *
 * @package Dnhb\ApiClient\Exception
 */
final class ApiClientResponseException extends ApiClientException
{
    /** @var RequestInterface */
    private $request;
    /** @var ResponseInterface */
    private $response;

    /**
     * ApiClientResponseException constructor.
     *
     * @param string            $message
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param int               $code
     * @param Exception         $previous
     */
    public function __construct(
        $message = null,
        RequestInterface $request = null,
        ResponseInterface $response = null,
        $code = null,
        Exception $previous = null
    ) {
        $this->request = $request;
        $this->response = $response;
        if ($this->getResponse()->getBody()) {
            $body = json_decode($this->getResponse()->getBody()->getContents());
            $message .= ' [message] ' . $body->error->message;
        }
        parent::__construct($message, $code, $previous);
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