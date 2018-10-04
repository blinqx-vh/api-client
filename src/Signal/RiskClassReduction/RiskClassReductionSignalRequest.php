<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Signal\RiskClassReduction;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithArrayResult;

/**
 * Class RiskClassReductionSignalRequest
 */
final class RiskClassReductionSignalRequest extends AbstractGetApiRequest
{
    use WithArrayResult;

    /** @var string */
        protected $baseUrl = 'signal/v1/risk-class-reduction';

    /**
     * RiskClassReductionSignalRequest constructor.
     *
     * @param RiskClassReductionSignalParameter $parameter
     */
    public function __construct(RiskClassReductionSignalParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}
