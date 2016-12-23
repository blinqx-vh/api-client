<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Calculation\Fine\Loanpart;

use Assert\Assertion;
use DateInterval;
use DateTime;
use Dnhb\ApiClient\Contract\GetParameterInterface;
use Dnhb\ApiClient\Data\MortgageType;
use Dnhb\ApiClient\Exception\ApiClientInvalidArgumentException;


/**
 * Class FineLoanpartParameter
 *
 * @package Dnhb\ApiClient\Calculation\Fine\Loanpart
 */
final class FineLoanpartParameter implements GetParameterInterface
{
    /** @var array */
    private $supportedTypes = [
        MortgageType::ANNUITY,
        MortgageType::INTEREST_ONLY,
        MortgageType::LINEAR
    ];

    /** @var string */
    private $loanpartStartDate;
    /** @var int */
    private $loanpartDurationInMonths;
    /** @var string */
    private $fixedRateTermStartDate;
    /** @var int */
    private $fixedRateTermDurationInYears;
    /** @var float */
    private $remainingDebt;
    /** @var float */
    private $interestPercentage;
    /** @var float */
    private $originalDebt;
    /** @var string */
    private $mortgageType;
    /** @var string */
    private $refinancingDate;
    /** @var float */
    private $presentDayInterest;
    /** @var float */
    private $fineFreePercentage;

    /**
     * FineLoanpartParameter constructor.
     * @param DateTime $loanpartStartDate
     * @param int $loanpartDurationInMonths
     * @param DateTime $fixedRateTermStartDate
     * @param $fixedRateTermDurationInMonths
     * @param float $remainingDebt
     * @param float $interestPercentage
     * @param float $originalDebt
     * @param MortgageType $mortgageType
     * @param DateTime $refinancingDate
     * @param float $presentDayInterest
     * @param float $fineFreePercentage
     * @throws ApiClientInvalidArgumentException
     */
    public function __construct(
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
    ) {
        if (!in_array($mortgageType->getValue(), $this->supportedTypes, true)) {
            throw new ApiClientInvalidArgumentException(
                sprintf(
                    'Only %s mortgage types are supported for Payment calculations',
                    implode(', ', $this->supportedTypes)
                )
            );
        }

        // Logic assertions
        $loanpartEndDate = clone $loanpartStartDate;
        $loanpartEndDate->add(new DateInterval('P' . $loanpartDurationInMonths . 'M'));

        Assertion::lessOrEqualThan($refinancingDate, $loanpartEndDate);

        Assertion::greaterOrEqualThan($fineFreePercentage, 0);
        Assertion::lessOrEqualThan($fineFreePercentage, 100);


        $this->loanpartStartDate = $loanpartStartDate->format('Y-m-d');
        $this->loanpartDurationInMonths = $loanpartDurationInMonths;
        $this->fixedRateTermStartDate = $fixedRateTermStartDate->format('Y-m-d');
        $this->fixedRateTermDurationInYears = round($fixedRateTermDurationInMonths / 12);
        $this->remainingDebt = $remainingDebt;
        $this->interestPercentage = $interestPercentage;
        $this->originalDebt = $originalDebt;
        $this->mortgageType = $mortgageType->getValue();
        $this->refinancingDate = $refinancingDate->format('Y-m-d');
        $this->presentDayInterest = $presentDayInterest;
        $this->fineFreePercentage = $fineFreePercentage;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'loanPartStartDate' => $this->loanpartStartDate,
            'loanPartDuration' => $this->loanpartDurationInMonths,
            'fixedRateTermStartDate' => $this->fixedRateTermStartDate,
            'fixedRateTermDuration' => $this->fixedRateTermDurationInYears,
            'remainingDebt' => $this->remainingDebt,
            'percentage' => $this->interestPercentage,
            'originalDebt' => $this->originalDebt,
            'mortgageType' => $this->mortgageType,
            'refinancingDate' => $this->refinancingDate,
            'presentDayInterest' => $this->presentDayInterest,
            'fineFreePercentage' => $this->fineFreePercentage
        ];
    }

    /**
     * @return string
     */
    public function getLoanpartStartDate(): string
    {
        return $this->loanpartStartDate;
    }

    /**
     * @return int
     */
    public function getLoanpartDurationInMonths(): int
    {
        return $this->loanpartDurationInMonths;
    }

    /**
     * @return string
     */
    public function getFixedRateTermStartDate(): string
    {
        return $this->fixedRateTermStartDate;
    }

    /**
     * @return int
     */
    public function getFixedRateTermDurationInYears(): int
    {
        return $this->fixedRateTermDurationInYears;
    }

    /**
     * @return float
     */
    public function getRemainingDebt(): float
    {
        return $this->remainingDebt;
    }

    /**
     * @return float
     */
    public function getInterestPercentage(): float
    {
        return $this->interestPercentage;
    }

    /**
     * @return float
     */
    public function getOriginalDebt(): float
    {
        return $this->originalDebt;
    }

    /**
     * @return string
     */
    public function getMortgageType(): string
    {
        return $this->mortgageType;
    }

    /**
     * @return string
     */
    public function getRefinancingDate(): string
    {
        return $this->refinancingDate;
    }

    /**
     * @return float
     */
    public function getPresentDayInterest(): float
    {
        return $this->presentDayInterest;
    }

    /**
     * @return float
     */
    public function getFineFreePercentage(): float
    {
        return $this->fineFreePercentage;
    }
}