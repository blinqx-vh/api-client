<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Calculation\Mortgage\Payment;

/**
 * Class PaymentFixedRatePeriodParameter
 *
 * @package Dnhb\ApiClient\Calculation\Mortgage\Payment
 */
final class PaymentFixedRatePeriodParameter
{
    /** @var int */
    private $durationInYears;
    /** @var float */
    private $interestRate;

    /**
     * PaymentFixedRatePeriodParameter constructor.
     *
     * @param int   $durationInYears
     * @param float $interestRate
     */
    public function __construct(int $durationInYears, float $interestRate)
    {
        $this->durationInYears = $durationInYears;
        $this->interestRate = $interestRate;
    }

    /**
     * @return int
     */
    public function getDurationInYears(): int
    {
        return $this->durationInYears;
    }

    /**
     * @return float
     */
    public function getInterestRate(): float
    {
        return $this->interestRate;
    }
}