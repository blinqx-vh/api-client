<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Calculation\Mortgage\Payment;


use Dnhb\ApiClient\Contract\PostParameterInterface;
use stdClass;

/**
 * Class PaymentParameters
 *
 * @package Dnhb\ApiClient\Calculation\Mortgage\Payment
 */
final class PaymentParameters implements PostParameterInterface
{
    /** @var PaymentLoanpartParameter[] */
    private $loanparts;
    /** @var float */
    private $woz;
    /** @var PaymentPersonParameter[] */
    private $persons;

    /**
     * PaymentParameters constructor.
     *
     * @param array $loanparts
     * @param $woz
     * @param array $persons
     */
    public function __construct(array $loanparts, float $woz, array $persons)
    {
        $this->loanparts = $loanparts;
        $this->woz = $woz;
        $this->persons = $persons;
    }

    /**
     * @return stdClass
     */
    public function toJsonableObject(): stdClass
    {
        $loanparts = [];
        foreach ($this->loanparts as $loanpart) {
            $interesPeriods = [];
            foreach ($loanpart->getFixedRatePeriods() as $fixedRatePeriod) {
                $interesPeriods[] = (object)[
                    'duration' => $fixedRatePeriod->getDurationInYears(),
                    'interestRate' => $fixedRatePeriod->getInterestRate()
                ];
            }
            $loanparts[] = (object)[
                'amount' => $loanpart->getAmount(),
                'mortgageType' => $loanpart->getType()->getValue(),
                'durationInMonths' => $loanpart->getDurationInMonths(),
                'interestPeriods' => $interesPeriods
            ];
        }

        $people = [];
        foreach ($this->persons as $person) {
            $people[] = (object)[
                'dob' => $person->getDateOfBirth()->format('Y-m-d'),
                'grossIncome' => $person->getSalary()
            ];
        }

        return (object)[
            'loanparts' => $loanparts,
            'WOZ' => $this->woz,
            'people' => $people,
        ];
    }
}