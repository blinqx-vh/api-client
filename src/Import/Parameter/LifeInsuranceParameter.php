<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import\Parameter;

use DateTime;
use Dnhb\ApiClient\Data\LifeInsuranceCoverageType;
use Dnhb\ApiClient\Data\PaymentPeriod;
use Dnhb\ApiClient\Import\AbstractImportParameter;
use Dnhb\ApiClient\Import\Assert\Assertion;
use Dnhb\ApiClient\Import\Manager\ValidationManager;
use Dnhb\ApiClient\Import\Scope;
use Dnhb\ApiClient\Import\Traits\WithSerialize;

/**
 * Class LifeInsuranceParameter
 */
final class LifeInsuranceParameter extends AbstractImportParameter
{
    use WithSerialize;
    /** @var DateTime */
    private $startDate;
    /** @var int */
    private $insuranceCompanyId;
    /** @var float */
    private $premium;
    /** @var PaymentPeriod */
    private $premiumPeriod;
    /** @var int */
    private $premiumDuration;
    /** @var float */
    private $coverage;
    /** @var LifeInsuranceCoverageType */
    private $coverageType;
    /** @var DateTime */
    private $endDate;

    /**
     *
     */
    const TYPE = 'LifeInsurance';

    /**
     * BaseImportParameter constructor.
     *
     * @param string $identifier
     * @param Scope  $scope
     */
    public function __construct(string $identifier, Scope $scope)
    {
        parent::__construct($identifier, $scope);

        $this->setRequiredProperties(
            [
                'startDate',
                'insuranceCompanyId',
                'premium',
                'premiumPeriod',
            ]
        );
    }

    /**
     * @param ValidationManager $validationManager
     */
    public function validate(ValidationManager $validationManager)
    {
        $this->validateRequiredProperties($validationManager, get_object_vars($this));
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return self::TYPE;
    }

    /**
     * @param DateTime $startDate
     *
     * @return LifeInsuranceParameter
     * @throws \Assert\AssertionFailedException
     */
    public function setStartDate(DateTime $startDate): LifeInsuranceParameter
    {
        if ($this->endDate instanceof DateTime) {
            Assertion::lessThan($startDate, $this->endDate);
        }

        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @param int $insuranceCompanyId
     *
     * @return LifeInsuranceParameter
     * @throws \Assert\AssertionFailedException
     */
    public function setInsuranceCompanyId(int $insuranceCompanyId): LifeInsuranceParameter
    {
        Assertion::min($insuranceCompanyId, 1);

        $this->insuranceCompanyId = $insuranceCompanyId;

        return $this;
    }

    /**
     * @param float $premium
     *
     * @return LifeInsuranceParameter
     * @throws \Assert\AssertionFailedException
     */
    public function setPremium(float $premium): LifeInsuranceParameter
    {
        Assertion::min($premium, 0);

        $this->premium = $premium;

        return $this;
    }

    /**
     * @param PaymentPeriod $paymentPeriod
     *
     * @return LifeInsuranceParameter
     */
    public function setPaymentPeriod(PaymentPeriod $paymentPeriod): LifeInsuranceParameter
    {
        $this->premiumPeriod = $paymentPeriod;

        return $this;
    }

    /**
     * @param int $premiumDuration
     *
     * @return LifeInsuranceParameter
     * @throws \Assert\AssertionFailedException
     */
    public function setPremiumDuration(int $premiumDuration): LifeInsuranceParameter
    {
        Assertion::min($premiumDuration, 1);
        Assertion::max($premiumDuration, 720);

        $this->premiumDuration = $premiumDuration;

        return $this;
    }

    /**
     * @param float $coverage
     *
     * @return LifeInsuranceParameter
     * @throws \Assert\AssertionFailedException
     */
    public function setCoverage(float $coverage): LifeInsuranceParameter
    {
        Assertion::min($coverage, 0);

        $this->coverage = $coverage;

        return $this;
    }

    /**
     * @param LifeInsuranceCoverageType $coverageType
     *
     * @return LifeInsuranceParameter
     */
    public function setCoverageType(LifeInsuranceCoverageType $coverageType): LifeInsuranceParameter
    {
        $this->coverageType = $coverageType;

        return $this;
    }

    /**
     * @param DateTime $endDate
     *
     * @return LifeInsuranceParameter
     * @throws \Assert\AssertionFailedException
     */
    public function setEndDate(DateTime $endDate): LifeInsuranceParameter
    {
        if ($this->startDate instanceof DateTime) {
            Assertion::greaterThan($endDate, $this->startDate);
        }

        $this->endDate = $endDate;

        return $this;
    }
}
