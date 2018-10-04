<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Signal\ForSale;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithArrayResult;

/**
 * Class ForSaleSignalRequest
 */
final class ForSaleSignalRequest extends AbstractGetApiRequest
{
    use WithArrayResult;

    /** @var string */
    protected $baseUrl = 'signal/v1/for-sale';

    /**
     * ForSaleSignalRequest constructor.
     *
     * @param ForSaleSignalParameter $parameter
     */
    public function __construct(ForSaleSignalParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}
