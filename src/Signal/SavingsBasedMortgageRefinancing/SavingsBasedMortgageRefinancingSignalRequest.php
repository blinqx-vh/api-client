<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Signal\SavingsBasedMortgageRefinancing;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithArrayResult;

/**
 * Class SavingsBasedMortgageRefinancingSignalRequest
 */
final class SavingsBasedMortgageRefinancingSignalRequest extends AbstractGetApiRequest
{
    use WithArrayResult;

    /** @var string */
    protected $baseUrl = 'signal/v1/refinancing-savings-based-mortgage';

    /**
     * SavingsBasedMortgageRefinancingSignalRequest constructor.
     *
     * @param SavingsBasedMortgageRefinancingSignalParameter $parameter
     */
    public function __construct(SavingsBasedMortgageRefinancingSignalParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}
