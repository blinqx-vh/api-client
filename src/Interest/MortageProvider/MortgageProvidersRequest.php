<?php


namespace Dnhb\ApiClient\Interest\MortageProvider;


use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithArrayResult;

/**
 * Class MortgageProvidersRequest
 */
class MortgageProvidersRequest extends AbstractGetApiRequest
{

    use WithArrayResult;

    protected $baseUrl = 'interest/v1/mortgage-provider';

    /**
     * MortgageProvidersRequest constructor.
     *
     * @param MortgageProvidersParameter $parameter
     */
    public function __construct(MortgageProvidersParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}