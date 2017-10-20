<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Module;

use Assert\Assertion;
use DateTime;
use Dnhb\ApiClient\Calculation\Fine\Loanpart\FineLoanpartParameter;
use Dnhb\ApiClient\Calculation\Fine\Loanpart\FineLoanpartRequest;
use Dnhb\ApiClient\Calculation\Mortgage\MaximumByIncome\MaximumMortgageByIncomeParameter;
use Dnhb\ApiClient\Calculation\Mortgage\MaximumByIncome\MaximumMortgageByIncomeRequest;
use Dnhb\ApiClient\Calculation\Mortgage\MaximumByValue\MaximumMortgageByValueParameter;
use Dnhb\ApiClient\Calculation\Mortgage\MaximumByValue\MaximumMortgageByValueRequest;
use Dnhb\ApiClient\Calculation\Mortgage\Payment\PaymentLoanpartParameter;
use Dnhb\ApiClient\Calculation\Mortgage\Payment\PaymentParameters;
use Dnhb\ApiClient\Calculation\Mortgage\Payment\PaymentPersonParameter;
use Dnhb\ApiClient\Calculation\Mortgage\Payment\PaymentRequest;
use Dnhb\ApiClient\Calculation\Mortgage\Payment\Response\PaymentResponse;
use Dnhb\ApiClient\Calculation\Regulation\ConstructionAddedValue\ConstructionAddedValueRequest;
use Dnhb\ApiClient\Data\MortgageType;

/**
 * Class Calculation
 * acts as a facade to the actual requests
 *
 * @package Dnhb\ApiClient\Module
 */
final class Calculation extends AbstractModule
{
    /**
     * @return float
     */
    public function getConstructionAddedValue(): float
    {
        return $this->client->send(new ConstructionAddedValueRequest());
    }

    /**
     * @param $loanParts
     * @param $woz
     * @param $persons
     *
     * @return PaymentResponse
     */
    public function getMortgagePayments($loanParts, float $woz, $persons): PaymentResponse
    {
        Assertion::allIsInstanceOf($loanParts, PaymentLoanpartParameter::class);
        Assertion::allIsInstanceOf($persons, PaymentPersonParameter::class);
        $parameters = new PaymentParameters($loanParts, $woz, $persons);

        return $this->client->send(new PaymentRequest($parameters));
    }

    /**
     * @param DateTime     $loanpartStartDate
     * @param int          $loanpartDurationInMonths
     * @param DateTime     $fixedRateTermStartDate
     * @param int          $fixedRateTermDurationInMonths
     * @param float        $remainingDebt
     * @param float        $interestPercentage
     * @param float        $originalDebt
     * @param MortgageType $mortgageType
     * @param DateTime     $refinancingDate
     * @param float        $presentDayInterest
     * @param float        $fineFreePercentage
     *
     * @return float
     */
    public function getLoanpartFine(
        DateTime $loanpartStartDate,
        int $loanpartDurationInMonths,
        DateTime $fixedRateTermStartDate,
        int $fixedRateTermDurationInMonths,
        float $remainingDebt,
        float $interestPercentage,
        float $originalDebt,
        MortgageType $mortgageType,
        DateTime $refinancingDate,
        float $presentDayInterest,
        float $fineFreePercentage
    ): float {
        $parameter = new FineLoanpartParameter(
            $loanpartStartDate,
            $loanpartDurationInMonths,
            $fixedRateTermStartDate,
            $fixedRateTermDurationInMonths,
            $remainingDebt,
            $interestPercentage,
            $originalDebt,
            $mortgageType,
            $refinancingDate,
            $presentDayInterest,
            $fineFreePercentage
        );

        return $this->client->send(new FineLoanpartRequest($parameter));
    }

    /**
     * @param float $interestPercentage
     * @param array $persons
     * @param bool  $nhg
     * @param int   $mortgageDurationInMonths
     * @param int   $fixedRateTermDurationInMonths
     * @param float $notDeductible
     * @param float $groundRent
     *
     * @return float
     */
    public function getMaximumMortgageByIncome(
        float $interestPercentage,
        array $persons,
        bool $nhg,
        int $mortgageDurationInMonths,
        int $fixedRateTermDurationInMonths,
        float $notDeductible,
        float $groundRent
    ): float {
        $parameter = new MaximumMortgageByIncomeParameter(
            $interestPercentage,
            $persons,
            $nhg,
            $mortgageDurationInMonths,
            $fixedRateTermDurationInMonths,
            $notDeductible,
            $groundRent
        );

        return $this->client->send(new MaximumMortgageByIncomeRequest($parameter));
    }

    /**
     * @param float $objectValue
     *
     * @return float
     */
    public function getMaximumMortgageByValue(float $objectValue): float
    {
        $parameters = new MaximumMortgageByValueParameter($objectValue);

        return $this->client->send(new MaximumMortgageByValueRequest($parameters));
    }
}