<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Calculation\Regulation\AOWDate;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithDateResult;

/**
 * Class AOWDateRequest
 *
 * @package Dnhb\ApiClient\Calculation\Regulation\AOWDate
 */
final class AOWDateRequest extends AbstractGetApiRequest
{
    use WithDateResult;
    /** @var string */
    protected $baseUrl = 'calculation/v1/regulation/aow-date';

    /**
     * AOWDateRequest constructor.
     *
     * @param AOWDateParameter $parameter
     */
    public function __construct(AOWDateParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}