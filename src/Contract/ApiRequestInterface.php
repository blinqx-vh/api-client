<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Contract;

use Dnhb\ApiClient\ResponseTransformer\TransformerInterface;

/**
 * Interface ApiRequestInterface
 *
 * @package Dnhb\ApiClient\Contract
 */
interface ApiRequestInterface
{
    /**
     * @return string
     */
    public function getBaseUrl(): string;

    /**
     * @return array
     */
    public function getRequestParams(): array;

    /**
     * @return array
     */
    public function getOptions(): array;

    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @return array
     */
    public function getHeaders(): array;

    /**
     * @return TransformerInterface
     */
    public function getResponseTransformer(): TransformerInterface;

    /**
     * @param TransformerInterface $transformer
     *
     * @return ApiRequestInterface
     */
    public function setResponseTransformer(TransformerInterface $transformer): ApiRequestInterface;
}