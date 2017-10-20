<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Interest\Label;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithArrayResult;

/**
 * Class BankLabelsRequest
 */
class BankLabelsRequest extends AbstractGetApiRequest
{
    use WithArrayResult;
    protected $baseUrl = 'interest/v1/label';

    /**
     * BankLabelsRequest constructor.
     *
     * @param BankLabelsParameter $parameter
     */
    public function __construct(BankLabelsParameter $parameter)
    {
        $this->requestParams = $parameter->serialize();
    }
}