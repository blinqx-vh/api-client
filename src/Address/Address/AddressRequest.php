<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Address\Address;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithArrayResult;

/**
 * Class AddressRequest
 */
class AddressRequest extends AbstractGetApiRequest
{
    use WithArrayResult;
    /**
     * @var string
     */
    protected $baseUrl = 'address/v1/address';

    /**
     * AddressRequest constructor.
     *
     * @param AddressParameter $parameter
     */
    public function __construct(AddressParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}