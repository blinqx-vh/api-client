<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Import\Contract;


use Dnhb\ApiClient\Import\Scope;
use stdClass;

/**
 * Interface ImportParameter
 *
 * @package Dnhb\ApiClient\Import
 */
interface ImportParameter extends Validatable
{
    /**
     * @return stdClass
     */
    public function serialize(): stdClass;

    /**
     * @return string
     */
    public function getIdentifier(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return Scope
     */
    public function getScope(): Scope;
}