<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import\Manager;

use Dnhb\ApiClient\Contract\PostParameterInterface;
use Dnhb\ApiClient\Exception\ApiClientException;
use Dnhb\ApiClient\Import\Assert\Assertion;
use Dnhb\ApiClient\Import\Scope;
use stdClass;

/**
 * Class ImportParameterManager
 */
final class ImportParameterManager implements PostParameterInterface
{
    /**
     * The cap of dossiers per import request
     */
    const MAX_SCOPES = 1;

    /** @var array */
    private $scopes;

    /**
     * @param Scope $scope
     *
     * @return $this|ImportParameterManager
     * @throws \Dnhb\ApiClient\Exception\ApiClientValidationException
     */
    public function addScope(Scope $scope): ImportParameterManager
    {
        Assertion::lessThan(
            count($this->scopes),
            self::MAX_SCOPES,
            sprintf('A maximum of %s scopes per import request is allowed', self::MAX_SCOPES)
        );

        $this->scopes[] = $scope;

        return $this;
    }

    /**
     * @return stdClass
     * @throws ApiClientException
     */
    public function toJsonableObject(): stdClass
    {
        if (null === $this->scopes) {
            throw new ApiClientException('No scopes to serialize');
        }

        $validationManager = new ValidationManager();
        $serializedScopes = [];

        foreach ($this->scopes as $scope) {
            $validationManager->currentScope($scope);
            $scope->validate($validationManager);

            $serializedScopes[$scope->getIdentifier()] = $scope->serialize();
        }

        if (!$validationManager->isValid()) {
            throw $validationManager->getValidationException();
        }

        return (object) $serializedScopes;
    }
}