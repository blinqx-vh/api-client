<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Signal\LifeInsurance;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithArrayResult;

/**
 * Class LifeInsuranceSignalRequest
 */
final class LifeInsuranceSignalRequest extends AbstractGetApiRequest
{
    use WithArrayResult;

    /** @var string */
    protected $baseUrl = 'signal/v1/life-insurance';

    /**
     * LifeInsuranceSignalRequest constructor.
     *
     * @param LifeInsuranceSignalParameter $parameter
     */
    public function __construct(LifeInsuranceSignalParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}
