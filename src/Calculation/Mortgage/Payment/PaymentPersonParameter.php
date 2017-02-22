<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Calculation\Mortgage\Payment;


use DateTime;

/**
 * Class PaymentPersonParameter
 *
 * @package Dnhb\ApiClient\Calculation\Mortgage\Payment
 */
final class PaymentPersonParameter
{
    /** @var DateTime */
    private $dateOfBirth;
    /** @var float */
    private $salary;

    /**
     * PaymentPersonParameter constructor.
     *
     * @param DateTime $dateOfBirth
     * @param          $grossYearlyIncome
     */
    public function __construct(DateTime $dateOfBirth, float $grossYearlyIncome)
    {
        $this->dateOfBirth = $dateOfBirth;
        $this->salary = $grossYearlyIncome;
    }

    /**
     * @return DateTime
     */
    public function getDateOfBirth(): DateTime
    {
        return $this->dateOfBirth;
    }

    /**
     * @return float
     */
    public function getSalary(): float
    {
        return $this->salary;
    }


}