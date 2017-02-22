<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Calculation\Mortgage\MaximumByValue;


use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithFloatResult;

/**
 * Class MaximumMortgageByValueRequest
 *
 * @package Dnhb\ApiClient\Calculation\Mortgage\MaximumByValue
 */
final class MaximumMortgageByValueRequest extends AbstractGetApiRequest
{
    use WithFloatResult;

    /** @var string */
    protected $baseUrl = 'calculation/v1/mortgage/maximum-by-value';

    /**
     * MaximumMortgageByValueRequest constructor.
     * @param MaximumMortgageByValueParameter $parameter
     */
    public function __construct(MaximumMortgageByValueParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}