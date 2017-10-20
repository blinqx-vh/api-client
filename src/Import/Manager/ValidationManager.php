<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import\Manager;

use Dnhb\ApiClient\Exception\ApiClientValidationException;
use Dnhb\ApiClient\Import\Scope;

/**
 * Class ValidationManager
 */
final class ValidationManager
{
    /** @var ApiClientValidationException|null */
    private $validationException;
    /** @var string */
    private $currentScopeIdentifier;

    /**
     * @param Scope $scope
     */
    public function currentScope(Scope $scope)
    {
        $this->currentScopeIdentifier = $scope->getIdentifier();
    }

    /**
     * @param string $message
     */
    public function addFailure(string $message)
    {
        $this->validationException =
            new ApiClientValidationException(
                sprintf('%s in scope \'%s\'', $message, $this->currentScopeIdentifier),
                $this->validationException
            );
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->validationException === null;
    }

    /**
     * @return ApiClientValidationException|null
     */
    public function getValidationException()
    {
        return $this->validationException;
    }
}