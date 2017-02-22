<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Contract;

use stdClass;

/**
 * Interface PostParameterInterface
 *
 * @package Dnhb\ApiClient\Contract
 */
interface PostParameterInterface
{
    /**
     * @return stdClass
     */
    public function toJsonableObject(): stdClass;
}