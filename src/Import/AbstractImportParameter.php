<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Import;

use Dnhb\ApiClient\Import\Contract\ImportParameter;
use Dnhb\ApiClient\Import\Traits\WithIdentifier;
use Dnhb\ApiClient\Import\Traits\WithRequiredProperties;


/**
 * Class AbstractImportParameter
 *
 * @package Dnhb\ApiClient\Import
 */
abstract class AbstractImportParameter implements ImportParameter
{
    use WithIdentifier, WithRequiredProperties;

    /** @var Scope */
    private $scope;

    /**
     * BaseImportParameter constructor.
     * @param string $identifier
     * @param Scope  $scope
     */
    public function __construct(string $identifier, Scope $scope)
    {
        $this->scope = $scope;

        $this->setIdentifier($identifier);
        $this->getScope()->add($this);
    }

    /**
     * @return Scope
     */
    public function getScope(): Scope
    {
        return $this->scope;
    }
}