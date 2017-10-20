<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Interest\Rate;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithArrayResult;

/**
 * Class InterestRatesRequest
 *
 * @package Dnhb\ApiClient\Interest\Rate
 */
class InterestRatesRequest extends AbstractGetApiRequest
{
    use WithArrayResult;
    protected $baseUrl = 'interest/v1/interest-rates';

    /**
     * InterestRatesRequest constructor.
     *
     * @param InterestRatesParameter $parameter
     */
    public function __construct(InterestRatesParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}