<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Calculation\Mortgage\Payment\Response;

use Dnhb\ApiClient\Exception\ApiClientResponseException;


/**
 * Class PaymentResponse
 *
 * @package Dnhb\ApiClient\Calculation\Mortgage\Payment\Response
 */
final class PaymentResponse
{
    /** @var Payment[] */
    private $payments = [];
    /** @var  TotalPayment */
    private $total;

    /**
     * PaymentResponse constructor.
     * @param array $response
     * @throws ApiClientResponseException
     */
    public function __construct(array $response)
    {
        if (!isset($response['data']['months'])) {
            throw new ApiClientResponseException('Invalid response for Payment');
        }

        /** @var array $months */
        $months = $response['data']['months'];
        foreach ($months as $month) {
            $this->payments[] = new Payment($month);
        }

        $this->total = new TotalPayment($response['data']['total']);
    }

    /**
     * @return Payment[]
     */
    public function getPayments(): array
    {
        return $this->payments;
    }

    /**
     * @return TotalPayment
     */
    public function getTotal(): TotalPayment
    {
        return $this->total;
    }


}