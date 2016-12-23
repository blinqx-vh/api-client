<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Calculation\Fine\Loanpart;


use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithFloatResult;

/**
 * Class FineLoanpartRequest
 *
 * @package Dnhb\ApiClient\Calculation\Fine\Loanpart
 */
class FineLoanpartRequest extends AbstractGetApiRequest
{
    use WithFloatResult;

    /** @var string */
    protected $baseUrl = 'calculation/v1/fine/loanpart';

    /**
     * FineLoanpartRequest constructor.
     * @param FineLoanpartParameter $parameter
     */
    public function __construct(FineLoanpartParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}