<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Contract;

use stdClass;

/**
 * Interface JsonablePostParameter
 *
 * @package Dnhb\ApiClient\Contract
 */
interface JsonablePostParameter
{
    /**
     * @return stdClass
     */
    public function toJsonableObject(): stdClass;
}