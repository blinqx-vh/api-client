<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import\Parameter;

use Assert\AssertionFailedException;
use Dnhb\ApiClient\Data\AccountType;
use Dnhb\ApiClient\Import\AbstractImportParameter;
use Dnhb\ApiClient\Import\Assert\Assertion;
use Dnhb\ApiClient\Import\Manager\ValidationManager;
use Dnhb\ApiClient\Import\Scope;
use Dnhb\ApiClient\Import\Traits\WithSerialize;

final class AssetParameter extends AbstractImportParameter
{
    use WithSerialize;

    private const TYPE = 'Asset';

    protected ?AccountType $accountType;
    protected int $resourceAmount = 0;
    protected int $bankId;

    public function __construct($identifier, Scope $scope)
    {
        parent::__construct($identifier, $scope);

        $this->setRequiredProperties(
            [
                'accountType',
                'resourceAmount',
                'bankId'
            ]
        );
    }

    public function getType(): string
    {
        return self::TYPE;
    }

    public function setAccountType(AccountType $value): AssetParameter
    {
        $this->accountType = $value;

        return $this;
    }

    /**
     * @throws AssertionFailedException
     */
    public function setResourceAmount(int $resourceAmount): AssetParameter
    {
        Assertion::min($resourceAmount, 0, 'Invalid resource amount supplied (%s). resource amount cannot be negative.');

        $this->resourceAmount = $resourceAmount;

        return $this;
    }

    public function setBankId(int $bankId): AssetParameter
    {
        $this->bankId = $bankId;

        return $this;
    }

    public function getAccountType(): AccountType
    {
        return $this->accountType;
    }

    public function getResourceAmount(): int
    {
        return $this->resourceAmount;
    }

    public function getBankId(): int
    {
        return $this->bankId;
    }

    public function validate(ValidationManager $validationManager): void
    {
        $this->validateRequiredProperties($validationManager, get_object_vars($this));
    }
}
