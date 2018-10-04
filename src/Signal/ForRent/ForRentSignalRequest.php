<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Signal\ForRent;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithArrayResult;

/**
 * Class ForRentSignalRequest
 */
final class ForRentSignalRequest extends AbstractGetApiRequest
{
    use WithArrayResult;

    /** @var string */
    protected $baseUrl = 'signal/v1/for-rent';

    /**
     * ForRentSignalRequest constructor.
     *
     * @param ForRentSignalParameter $parameter
     */
    public function __construct(ForRentSignalParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}
