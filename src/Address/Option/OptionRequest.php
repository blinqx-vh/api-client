<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Address\Option;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithArrayResult;

/**
 * Class OptionRequest
 */
class OptionRequest extends AbstractGetApiRequest
{
    use WithArrayResult;
    /**
     * @var string
     */
    protected $baseUrl = 'address/v1/options';

    /**
     * OptionRequest constructor.
     *
     * @param OptionParameter $parameter
     */
    public function __construct(OptionParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}