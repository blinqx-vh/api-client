<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Contract;

/**
 * Interface GetApiInterface
 *
 * @package Dnhb\ApiClient\Contract
 */
interface PostApiRequestInterface
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
}