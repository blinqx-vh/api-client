<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Module;

use Dnhb\ApiClient\Import\InsertDossierRequest;
use Dnhb\ApiClient\Import\Manager\ImportParameterManager;
use Dnhb\ApiClient\Import\Scope;

/**
 * Class Import
 *
 * @package Dnhb\ApiClient\Module
 */
final class Import extends AbstractModule
{
    /**
     * @param ImportParameterManager $parameter
     *
     * @return int
     */
    public function insertDossier(Scope $scope): int
    {
        $parameter = new ImportParameterManager();
        $parameter->addScope($scope);

        return $this->client->send(new InsertDossierRequest($parameter));
    }
}