<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Module;

use Dnhb\ApiClient\Import\InsertDossierRequest;
use Dnhb\ApiClient\Import\Manager\ImportParameterManager;
use Dnhb\ApiClient\Import\MHDN\MHDNParameter;
use Dnhb\ApiClient\Import\MHDN\MHDNRequest;
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

    /**
     * @param string $message
     *
     * @return int
     */
    public function mHDN(string $message): int
    {
        $mHDNParameter = MHDNParameter::fromString($message);

        return $this->client->send(new MHDNRequest($mHDNParameter));
    }
}