<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Calculation\Mortgage\MaximumByIncome;


/**
 * Class MaximumMortgageByIncomePersonParameter
 *
 * @package Dnhb\ApiClient\Calculation\Mortgage\MaximumByIncome
 */
final class MaximumMortgageByIncomePersonParameter
{
    /** @var float */
    private $income;
    /** @var int */
    private $age;
    /** @var float */
    private $alimony;
    /** @var float */
    private $loans;
    /** @var float */
    private $studentLoans;

    /**
     * MaximumMortgageByIncomePersonParameter constructor.
     * @param float $yearlyIncome
     * @param int   $age
     * @param float $yearlyAlimony
     * @param float $loans
     * @param float $studentLoans
     */
    public function __construct(
        float $yearlyIncome,
        int $age,
        float $yearlyAlimony,
        float $loans,
        float $studentLoans
    ) {
        $this->income = $yearlyIncome;
        $this->age = $age;
        $this->alimony = $yearlyAlimony;
        $this->loans = $loans;
        $this->studentLoans = $studentLoans;
    }

    /**
     * @return float
     */
    public function getIncome(): float
    {
        return $this->income;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return float
     */
    public function getAlimony(): float
    {
        return $this->alimony;
    }

    /**
     * @return float
     */
    public function getLoans(): float
    {
        return $this->loans;
    }

    /**
     * @return float
     */
    public function getStudentLoans(): float
    {
        return $this->studentLoans;
    }
}