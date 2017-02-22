<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Calculation\Mortgage\Payment;


use Assert\Assertion;
use Dnhb\ApiClient\Data\MortgageType;
use Dnhb\ApiClient\Exception\ApiClientInvalidArgumentException;

/**
 * Class PaymentMortgageParameter
 *
 * @package Dnhb\ApiClient\Calculation\Mortgage\Payment
 */
final class PaymentLoanpartParameter
{
    /** @var array */
    private $supportedTypes = [
        MortgageType::ANNUITY,
        MortgageType::INTEREST_ONLY,
        MortgageType::LINEAR
    ];
    /** @var MortgageType */
    private $type;
    /** @var float */
    private $amount;
    /** @var int */
    private $durationInMonths;
    /** @var array */
    private $fixedRatePeriods;

    /**
     * PaymentLoanpartParameter constructor.
     * @param MortgageType $type
     * @param float        $amount
     * @param int          $durationInMonths
     * @param array|null   $fixedRatePeriods
     * @throws ApiClientInvalidArgumentException
     */
    public function __construct(
        MortgageType $type,
        float $amount,
        int $durationInMonths,
        array $fixedRatePeriods = null
    ) {
        if (!in_array($type->getValue(), $this->supportedTypes, true)) {
            throw new ApiClientInvalidArgumentException(
                sprintf(
                    'Only %s mortgage types are supported for Payment calculations',
                    implode(', ', $this->supportedTypes)
                )
            );
        }
        $this->type = $type;
        $this->amount = $amount;
        $this->durationInMonths = $durationInMonths;

        Assertion::allIsInstanceOf($fixedRatePeriods, PaymentFixedRatePeriodParameter::class);
        $this->fixedRatePeriods = $fixedRatePeriods;
    }

    /**
     * @return MortgageType
     */
    public function getType(): MortgageType
    {
        return $this->type;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getDurationInMonths(): int
    {
        return $this->durationInMonths;
    }


    /**
     * @return PaymentFixedRatePeriodParameter[]
     */
    public function getFixedRatePeriods(): array
    {
        return $this->fixedRatePeriods;
    }

}