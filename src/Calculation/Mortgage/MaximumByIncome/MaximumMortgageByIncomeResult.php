<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Calculation\Mortgage\MaximumByIncome;

/**
 * Class MaximumMortgageByIncomeResult
 *
 * @package Dnhb\ApiClient\Calculation\Mortgage\MaximumByIncome
 */
final class MaximumMortgageByIncomeResult
{
    /** @var float */
    private $maximumMortgage;
    /** @var array */
    private $calculationValues;

    /**
     * MaximumMortgageByIncomeResult constructor.
     *
     * @param float $maximumMortgage
     * @param array $calculationValues
     */
    public function __construct(float $maximumMortgage, array $calculationValues)
    {
        $this->maximumMortgage = $maximumMortgage;
        $this->calculationValues = $calculationValues;
    }

    /**
     * @return float
     */
    public function getMaximumMortgage(): float
    {
        return $this->maximumMortgage;
    }

    /**
     * @return float
     */
    public function getTotalReferenceIncome(): float
    {
        return $this->calculationValues['totalReferenceIncome'];
    }
}
