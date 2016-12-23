<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Calculation\Mortgage\MaximumByIncome;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithFloatResult;

/**
 * Class MaximumMortgageByIncomeRequest
 *
 * @package Dnhb\ApiClient\Calculation\Mortgage\MaximumByIncome
 */
final class MaximumMortgageByIncomeRequest extends AbstractGetApiRequest
{
    use WithFloatResult;

    /** @var string */
    protected $baseUrl = 'calculation/v1/loanparts/maximum-by-income';

    /**
     * MaximumMortgageByIncomeRequest constructor.
     * @param MaximumMortgageByIncomeParameter $parameter
     */
    public function __construct(MaximumMortgageByIncomeParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}