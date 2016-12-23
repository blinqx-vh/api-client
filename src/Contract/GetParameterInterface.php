<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Contract;


/**
 * Interface GetParameterInterface
 *
 * @package Dnhb\ApiClient\Contract
 */
interface GetParameterInterface
{
    /**
     * @return array
     */
    public function serialize(): array;
}