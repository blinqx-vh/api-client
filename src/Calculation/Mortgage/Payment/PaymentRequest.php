<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Calculation\Mortgage\Payment;

use Dnhb\ApiClient\Contract\AbstractPostApiRequest;
use Dnhb\ApiClient\Contract\JsonablePostParameter;
use Dnhb\ApiClient\ResponseTransformer\MortgagePayments;
use Dnhb\ApiClient\ResponseTransformer\TransformerInterface;

/**
 * Class Payment
 *
 * @package Dnhb\ApiClient\Calculation\Mortgage
 */
final class PaymentRequest extends AbstractPostApiRequest
{
    /** @var string */
    protected $baseUrl = 'calculation/v1/mortgage/payment';

    /**
     * PaymentRequest constructor.
     *
     * @param JsonablePostParameter $parameters
     */
    public function __construct(JsonablePostParameter $parameters)
    {
        $this->options['body'] = json_encode($parameters->toJsonableObject());
    }

    /**
     * @return TransformerInterface|MortgagePayments
     */
    public function getResponseTransformer(): TransformerInterface
    {
        return new MortgagePayments();
    }
}