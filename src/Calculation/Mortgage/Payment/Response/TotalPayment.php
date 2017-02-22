<?php
declare(strict_types=1);


namespace Dnhb\ApiClient\Calculation\Mortgage\Payment\Response;


/**
 * Class TotalPayment
 *
 * @package Dnhb\ApiClient\Calculation\Mortgage\Payment\Response
 */
final class TotalPayment
{
    /** @var float */
    private $interestPayment;
    /** @var float */
    private $repayment;
    /** @var float */
    private $gross;
    /** @var float */
    private $net;
    /** @var float */
    private $remainingDebt;
    /** @var float */
    private $investment;

    /**
     * TotalPayment constructor.
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->interestPayment = $response['interestPayment'];
        $this->repayment = $response['repayment'];
        $this->gross = $response['gross'];
        $this->net = $response['net'];
        $this->remainingDebt = $response['remainingDebt'];
        $this->investment = $response['investment'];
    }

    /**
     * @return mixed
     */
    public function getInterestPayment(): float
    {
        return $this->interestPayment;
    }

    /**
     * @return mixed
     */
    public function getRepayment(): float
    {
        return $this->repayment;
    }

    /**
     * @return mixed
     */
    public function getGross(): float
    {
        return $this->gross;
    }

    /**
     * @return mixed
     */
    public function getNet(): float
    {
        return $this->net;
    }

    /**
     * @return mixed
     */
    public function getRemainingDebt(): float
    {
        return $this->remainingDebt;
    }

    /**
     * @return mixed
     */
    public function getInvestment(): float
    {
        return $this->investment;
    }


}