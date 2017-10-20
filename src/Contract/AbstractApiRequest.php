<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Contract;

/**
 * Class AbstractApiRequest
 *
 * @package Dnhb\ApiClient\Contract
 */
abstract class AbstractApiRequest implements ApiRequestInterface
{
    /** @var string */
    protected $baseUrl = '';
    /** @var array */
    protected $requestParams = [];
    /** @var array */
    protected $options = [];

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @return array
     */
    public function getRequestParams(): array
    {
        return $this->requestParams;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}