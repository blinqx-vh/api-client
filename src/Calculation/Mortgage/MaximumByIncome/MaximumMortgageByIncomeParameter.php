<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Calculation\Mortgage\MaximumByIncome;


use Assert\Assertion;
use Dnhb\ApiClient\Contract\GetParameterInterface;
use Dnhb\ApiClient\Request\WithFloatResult;

/**
 * Class MaximumMortgageByIncomeParameter
 *
 * @package Dnhb\ApiClient\Calculation\Mortgage\MaximumByIncome
 */
final class MaximumMortgageByIncomeParameter implements GetParameterInterface
{
    use WithFloatResult;

    /** @var float */
    private $interestPercentage;
    /** @var bool */
    private $nhg;
    /** @var int */
    private $mortgageDurationInMonths;
    /** @var int */
    private $fixedRateTermDurationInMonths;
    /** @var float */
    private $notDeductible;
    /** @var float */
    private $groundRent;

    /** @var float */
    private $personOneIncome;
    /** @var int */
    private $personOneAge;
    /** @var float */
    private $personOneAlimony;
    /** @var float */
    private $personOneLoans;
    /** @var float */
    private $personOneStudentLoans;

    /** @var float */
    private $personTwoIncome;
    /** @var int */
    private $personTwoAge;
    /** @var float */
    private $personTwoAlimony;
    /** @var float */
    private $personTwoLoans;
    /** @var float */
    private $personTwoStudentLoans;

    /**
     * MaximumMortgageByIncomeParameter constructor.
     * @param float $interestPercentage
     * @param array $persons Array of person objects
     * @param bool $nhg
     * @param int $mortgageDurationInMonths
     * @param int $fixedRateTermDurationInMonths
     * @param float $notDeductible
     * @param float $groundRent
     */
    public function __construct(
        float $interestPercentage,
        array $persons,
        bool $nhg,
        int $mortgageDurationInMonths,
        int $fixedRateTermDurationInMonths,
        float $notDeductible,
        float $groundRent
    ) {
        Assertion::allIsInstanceOf($persons, MaximumMortgageByIncomePersonParameter::class);
        Assertion::between(count($persons), 1, 2);

        $this->interestPercentage = $interestPercentage;
        $this->nhg = $nhg;
        $this->mortgageDurationInMonths = $mortgageDurationInMonths;
        $this->fixedRateTermDurationInMonths = $fixedRateTermDurationInMonths;
        $this->notDeductible = $notDeductible;
        $this->groundRent = $groundRent;

        /** @var MaximumMortgageByIncomePersonParameter $person */
        foreach ($persons as $person) {
            $this->serializePerson($person);
        }
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'nhg' => $this->nhg,
            'duration' => $this->mortgageDurationInMonths,
            'percentage' => $this->interestPercentage,
            'rateFixation' => round($this->fixedRateTermDurationInMonths / 12),
            'notDeductible' => $this->notDeductible,
            'groundRent' => $this->groundRent,
            'person[0][income]' => $this->personOneIncome,
            'person[0][age]' => $this->personOneAge,
            'person[0][alimony]' => $this->personOneAlimony,
            'person[0][loans]' => $this->personOneLoans,
            'person[0][studentLoans]' => $this->personOneStudentLoans,
            'person[1][income]' => $this->personTwoIncome,
            'person[1][age]' => $this->personTwoAge,
            'person[1][alimony]' => $this->personTwoAlimony,
            'person[1][loans]' => $this->personTwoLoans,
            'person[1][studentLoans]' => $this->personTwoStudentLoans,
        ];
    }

    /**
     * @param MaximumMortgageByIncomePersonParameter $person
     */
    private function serializePerson(MaximumMortgageByIncomePersonParameter $person)
    {
        if ($this->isFirstPerson()) {
            $this->personOneIncome = $person->getIncome();
            $this->personOneAge = $person->getAge();
            $this->personOneAlimony = $person->getAlimony();
            $this->personOneLoans = $person->getLoans();
            $this->personOneStudentLoans = $person->getStudentLoans();
            return;
        }

        $this->personTwoIncome = $person->getIncome();
        $this->personTwoAge = $person->getAge();
        $this->personTwoAlimony = $person->getAlimony();
        $this->personTwoLoans = $person->getLoans();
        $this->personTwoStudentLoans = $person->getStudentLoans();
    }

    /**
     * @return bool
     */
    private function isFirstPerson(): bool
    {
        return null === $this->personOneIncome;
    }

    /**
     * @return float
     */
    public function getInterestPercentage(): float
    {
        return $this->interestPercentage;
    }

    /**
     * @return boolean
     */
    public function isNhg(): bool
    {
        return $this->nhg;
    }

    /**
     * @return int
     */
    public function getMortgageDurationInMonths(): int
    {
        return $this->mortgageDurationInMonths;
    }

    /**
     * @return int
     */
    public function getpersonOneAge(): int
    {
        return $this->personOneAge;
    }

    /**
     * @return float
     */
    public function getpersonOneAlimony(): float
    {
        return $this->personOneAlimony;
    }

    /**
     * @return float
     */
    public function getpersonOneLoans(): float
    {
        return $this->personOneLoans;
    }

    /**
     * @return float
     */
    public function getpersonOneStudentLoans(): float
    {
        return $this->personOneStudentLoans;
    }

    /**
     * @return float
     */
    public function getpersonTwoIncome(): float
    {
        return $this->personTwoIncome;
    }

    /**
     * @return int
     */
    public function getpersonTwoAge(): int
    {
        return $this->personTwoAge;
    }

    /**
     * @return float
     */
    public function getpersonTwoAlimony(): float
    {
        return $this->personTwoAlimony;
    }

    /**
     * @return float
     */
    public function getpersonTwoLoans(): float
    {
        return $this->personTwoLoans;
    }

    /**
     * @return float
     */
    public function getpersonTwoStudentLoans(): float
    {
        return $this->personTwoStudentLoans;
    }

    /**
     * @return int
     */
    public function getFixedRateTermDurationInMonths(): int
    {
        return $this->fixedRateTermDurationInMonths;
    }

    /**
     * @return float
     */
    public function getNotDeductible(): float
    {
        return $this->notDeductible;
    }

    /**
     * @return float
     */
    public function getGroundRent(): float
    {
        return $this->groundRent;
    }

    /**
     * @return float
     */
    public function getpersonOneIncome(): float
    {
        return $this->personOneIncome;
    }
}