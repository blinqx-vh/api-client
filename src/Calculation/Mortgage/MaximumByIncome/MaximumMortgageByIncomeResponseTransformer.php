<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Calculation\Mortgage\MaximumByIncome;

use Dnhb\ApiClient\Exception\ApiClientUnexpectedResultException;
use Dnhb\ApiClient\ResponseTransformer\TransformerInterface;

/**
 * Class MaximumMortgageByIncomeResponseTransformer
 *
 * @package Dnhb\ApiClient\Calculation\Mortgage\MaximumByIncome
 */
class MaximumMortgageByIncomeResponseTransformer implements TransformerInterface
{
    /**
     * @param array $response
     *
     * @return MaximumMortgageByIncomeResult
     */
    public function transform(array $response): MaximumMortgageByIncomeResult
    {
        if (!isset($response['data']['result']) || !isset($response['data']['calculationValues'])) {
            throw new ApiClientUnexpectedResultException();
        }

        return new MaximumMortgageByIncomeResult(
            $response['data']['result'],
            $response['data']['calculationValues']
        );
    }
}