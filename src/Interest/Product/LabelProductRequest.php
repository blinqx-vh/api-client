<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Interest\Product;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithArrayResult;

/**
 * Class LabelProductRequest
 */
class LabelProductRequest extends AbstractGetApiRequest
{
    use WithArrayResult;
    protected $baseUrl = 'interest/v1/product';

    /**
     * BankLabelsRequest constructor.
     *
     * @param LabelProductParameter $parameter
     */
    public function __construct(LabelProductParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}