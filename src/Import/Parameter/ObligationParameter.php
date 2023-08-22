<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import\Parameter;

use Dnhb\ApiClient\Data\CreditType;
use Dnhb\ApiClient\Import\AbstractImportParameter;
use Dnhb\ApiClient\Import\Assert\Assertion;
use Dnhb\ApiClient\Import\Manager\ValidationManager;
use Dnhb\ApiClient\Import\Scope;
use Dnhb\ApiClient\Import\Traits\WithSerialize;

class ObligationParameter extends AbstractImportParameter
{
    use WithSerialize;

    private const TYPE = 'Obligation';

    protected ?CreditType $creditType;
    protected int $creditAmount = 0;

    public function __construct($identifier, Scope $scope)
    {
        parent::__construct($identifier, $scope);

        $this->setRequiredProperties(
            [
                'creditType',
                'creditAmount',
            ]
        );
    }

    public function getType(): string
    {
        return self::TYPE;
    }

    public function setCreditType(CreditType $value): ObligationParameter
    {
        $this->creditType = $value;

        return $this;
    }

    public function setCreditAmount(int $creditAmount): ObligationParameter
    {
        Assertion::min($creditAmount, 0, 'Invalid credit supplied (%s). credit cannot be negative.');

        $this->creditAmount = $creditAmount;

        return $this;
    }

    public function getCreditType(): CreditType
    {
        return $this->creditType;
    }

    public function getCreditAmount(): int
    {
        return $this->creditAmount;
    }

    public function validate(ValidationManager $validationManager): void
    {
        $this->validateRequiredProperties($validationManager, get_object_vars($this));
    }
}
