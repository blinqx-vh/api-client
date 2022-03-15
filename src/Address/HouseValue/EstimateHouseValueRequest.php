<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Address\HouseValue;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithArrayResult;

final class EstimateHouseValueRequest extends AbstractGetApiRequest
{
    use WithArrayResult;

    /** @var string */
    protected $baseUrl = 'address/v1/estimateHouseValue';

    public function __construct(EstimateHouseValueParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}
