<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Address\Option;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithArrayResult;

/**
 * Class AddressOptionRequest
 */
class AddressOptionRequest extends AbstractGetApiRequest
{
    use WithArrayResult;
    /**
     * @var string
     */
    protected $baseUrl = 'address/v1/options';

    /**
     * AddressOptionRequest constructor.
     *
     * @param AddressOptionParameter $parameter
     */
    public function __construct(AddressOptionParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}