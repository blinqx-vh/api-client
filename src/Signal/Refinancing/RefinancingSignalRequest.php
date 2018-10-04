<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Signal\Refinancing;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithArrayResult;

/**
 * Class RefinancingSignalRequest
 */
final class RefinancingSignalRequest extends AbstractGetApiRequest
{
    use WithArrayResult;

    /** @var string */
    protected $baseUrl = 'signal/v1/refinancing';

    /**
     * RefinancingSignalRequest constructor.
     *
     * @param RefinancingSignalParameter $parameter
     */
    public function __construct(RefinancingSignalParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}
