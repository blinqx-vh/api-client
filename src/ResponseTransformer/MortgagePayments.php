<?php
declare(strict_types=1);


namespace Dnhb\ApiClient\ResponseTransformer;


use Dnhb\ApiClient\Calculation\Mortgage\Payment\Response\PaymentResponse;

/**
 * Class MortgagePayments
 *
 * @package Dnhb\ApiClient\ResponseTransformer
 */
final class MortgagePayments implements TransformerInterface
{
    /**
     * @param array $response
     * @return PaymentResponse
     */
    public function transform(array $response): PaymentResponse
    {
        return new PaymentResponse($response);
    }
}