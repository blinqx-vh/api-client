<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Signal\Continuation;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithArrayResult;

/**
 * Class ContinuationSignalRequest
 */
final class ContinuationSignalRequest extends AbstractGetApiRequest
{
    use WithArrayResult;

    /** @var string */
    protected $baseUrl = 'signal/v1/continuation';

    /**
     * ContinuationSignalRequest constructor.
     *
     * @param ContinuationSignalParameter $parameter
     */
    public function __construct(ContinuationSignalParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}
