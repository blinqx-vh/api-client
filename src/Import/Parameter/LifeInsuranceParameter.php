<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import\Parameter;

use Assert\AssertionFailedException;
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
    /** @var DateTime|null */
    private $startDate;
    /** @var int|null */
    private $insuranceCompanyId;
    /** @var float|null */
    private $premium;
    /** @var PaymentPeriod|null */
    private $premiumPeriod;
    /** @var int|null */
    private $premiumDuration;
    /** @var float|null */
    private $coverage;
    /** @var LifeInsuranceCoverageType|null */
    private $coverageType;
    /** @var DateTime|null */
    private $endDate;

    const TYPE = 'LifeInsurance';

    public function __construct(string $identifier, Scope $scope)
    {
        parent::__construct($identifier, $scope);

        $this->setRequiredProperties(
            [
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
     * @throws AssertionFailedException
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
     * @throws AssertionFailedException
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
     * @throws AssertionFailedException
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
     * @throws AssertionFailedException
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
     * @throws AssertionFailedException
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
     * @throws AssertionFailedException
     */
    public function setEndDate(DateTime $endDate): LifeInsuranceParameter
    {
        if ($this->startDate instanceof DateTime) {
            Assertion::greaterThan($endDate, $this->startDate);
        }

        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getStartDate(): ?DateTime
    {
        return $this->startDate;
    }

    /**
     * @return int|null
     */
    public function getInsuranceCompanyId(): ?int
    {
        return $this->insuranceCompanyId;
    }

    /**
     * @return float|null
     */
    public function getPremium(): ?float
    {
        return $this->premium;
    }

    /**
     * @return PaymentPeriod|null
     */
    public function getPremiumPeriod(): ?PaymentPeriod
    {
        return $this->premiumPeriod;
    }

    /**
     * @return int|null
     */
    public function getPremiumDuration(): ?int
    {
        return $this->premiumDuration;
    }

    /**
     * @return float|null
     */
    public function getCoverage(): ?float
    {
        return $this->coverage;
    }

    /**
     * @return DateTime|null
     */
    public function getEndDate(): ?DateTime
    {
        return $this->endDate;
    }
}
