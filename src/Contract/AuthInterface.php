<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Contract;


/**
 * Interface AuthorizationInterface
 *
 * @package Dnhb\ApiClient\Contract
 */
interface AuthInterface
{
    /** */
    const TYPE_APIKEY = 'api_key';
    /** */
    const TYPE_JWT = 'token';

    /**
     * @return string
     */
    public function getKey(): string;

    /**
     * @return string
     */
    public function getValue(): string;
}