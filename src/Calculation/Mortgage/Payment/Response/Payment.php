<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Calculation\Mortgage\Payment\Response;


/**
 * Class Payment
 *
 * @package Dnhb\ApiClient\Calculation\Mortgage\Payment\Response
 */
final class Payment
{

    /** @var int */
    private $month;
    /** @var string */
    private $date;
    /** @var  float */
    private $repayment;
    /** @var float */
    private $gross;
    /** @var float */
    private $net;
    /** @var float */
    private $remainingDebt;
    /** @var float */
    private $interest;

    /**
     * Payment constructor.
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->month = $response['month'];
        $this->date = $response['date'];
        $this->repayment = $response['repayment'];
        $this->gross = $response['gross'];
        $this->net = $response['net'];
        $this->remainingDebt = $response['remainingDebt'];
        $this->interest = $response['interest'];
    }

    /**
     * @return int
     */
    public function getMonth(): int
    {
        return $this->month;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return float
     */
    public function getRepayment(): float
    {
        return $this->repayment;
    }

    /**
     * @return float
     */
    public function getGross(): float
    {
        return $this->gross;
    }

    /**
     * @return float
     */
    public function getNet(): float
    {
        return $this->net;
    }

    /**
     * @return float
     */
    public function getRemainingDebt(): float
    {
        return $this->remainingDebt;
    }

    /**
     * @return float
     */
    public function getInterest(): float
    {
        return $this->interest;
    }


}