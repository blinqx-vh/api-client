<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Interest\MortageProvider;


use Dnhb\ApiClient\Contract\GetParameterInterface;
use Dnhb\ApiClient\Data\AvailableForType;
use Dnhb\ApiClient\Data\MortgageType;
use Dnhb\ApiClient\Exception\ApiClientInvalidArgumentException;
use Dnhb\ApiClient\Import\Assert\Assertion;

/**
 * Class MortgageProvidersParameter
 */
class MortgageProvidersParameter implements GetParameterInterface
{

    /**
     * @var array
     */
    private $supportedMortgageTypes = [
        MortgageType::INTEREST_ONLY_VARIATION,
        MortgageType::ANNUITY_VARIATION,
        MortgageType::BANKSAVING_VARIATION,
        MortgageType::BRIDGING_LOAN_VARIATION,
        MortgageType::CREDIT_VARIATION,
        MortgageType::HYBRID_VARIATION,
        MortgageType::INVESTMENT_VARIATION,
        MortgageType::LIFE_VARIATION,
        MortgageType::LINEAR_VARIATION,
        MortgageType::SAVING_VARIATION,
    ];

    /**
     * @var array
     */
    private $supportedAvailabilityTypes = [
        AvailableForType::TYPE_ARRANGEMENT,
        AvailableForType::TYPE_CONTINUATION,
        AvailableForType::TYPE_BOTH
    ];

    /**
     * @var int|null $mortgageProviderId
     */
    private $mortgageProviderId;
    /**
     * @var int|null $labelId
     */
    private $labelId;
    /**
     * @var int|null $productId
     */
    private $productId;
    /**
     * @var MortgageType|null $mortgageType
     */
    private $mortgageType;
    /**
     * @var AvailableForType|null $availableFor
     */
    private $availableFor;
    /**
     * @var bool|null $nhg
     */
    private $nhg;
    /**
     * @var double|null $ltv
     */
    private $ltv;
    /**
     * @var int|null $period
     */
    private $period;
    /**
     * @var bool|null $onlyUseIncludedLabels
     */
    private $onlyUseIncludedLabels;
    /**
     * @var int $page
     */
    private $page;
    /**
     * @var int $limit
     */
    private $limit;

    /**
     * MortgageProvidersParameter constructor.
     * @param int|null $mortgageProviderId
     * @param int|null $labelId
     * @param int|null $productId
     * @param MortgageType|null $mortgageType
     * @param AvailableForType|null $availableFor
     * @param bool|null $nhg
     * @param float|null $ltv
     * @param int|null $period
     * @param bool|null $onlyUseIncludedLabels
     * @param int $page
     * @param int $limit
     *
     * @throws ApiClientInvalidArgumentException
     */
    public function __construct(
        int $mortgageProviderId = null,
        int $labelId = null,
        int $productId = null,
        MortgageType $mortgageType = null,
        AvailableForType $availableFor = null,
        bool $nhg = null,
        float $ltv = null,
        int $period = null,
        bool $onlyUseIncludedLabels = null,
        int $page = 0,
        int $limit = 25
    )
    {
        if (null !== $mortgageType) {
            if (!in_array($mortgageType->getValue(), $this->supportedMortgageTypes, true)) {
                throw new ApiClientInvalidArgumentException(
                    sprintf(
                        'Only %s mortgage types are supported for interest label lookup',
                        implode(', ', $this->supportedMortgageTypes)
                    )
                );
            }
        }

        if (null !== $availableFor) {
            if (!in_array($availableFor->getValue(), $this->supportedAvailabilityTypes, true)) {
                throw new ApiClientInvalidArgumentException(
                    sprintf(
                        'Only %s availability types are supported for interest rate calculations',
                        implode(', ', $this->supportedAvailabilityTypes)
                    )
                );
            }
        }

        if (null !== $ltv) {
            Assertion::greaterOrEqualThan($ltv, 0);
        }

        $this->mortgageProviderId = $mortgageProviderId;
        $this->labelId = $labelId;
        $this->productId = $productId;
        $this->mortgageType = $mortgageType;
        $this->availableFor = $availableFor;
        $this->nhg = $nhg;
        $this->ltv = $ltv;
        $this->period = $period;
        $this->onlyUseIncludedLabels = $onlyUseIncludedLabels;
        $this->page = $page;
        $this->limit = $limit;
    }

    /**
     * Return serialized data.
     *
     * @return array
     */
    public function serialize(): array
    {
        $onlyUseIncludedLabels = $this->onlyUseIncludedLabels;
        if (null !== $onlyUseIncludedLabels) {
            if ($onlyUseIncludedLabels) {
                $onlyUseIncludedLabels = 'true';
            } else {
                $onlyUseIncludedLabels = 'false';
            }
        }

        $nhg = $this->nhg;
        if (null !== $nhg) {
            if ($nhg) {
                $nhg = 'true';
            } else {
                $nhg = 'false';
            }
        }

        return [
            'mortgageProviderId' => $this->mortgageProviderId,
            'labelId' => $this->labelId,
            'productId' => $this->productId,
            'repaymentType' => null !== $this->mortgageType ? $this->mortgageType->getValue() : null,
            'availableFor' => null !== $this->availableFor ? $this->availableFor->getValue() : null,
            'nhg' => $nhg,
            'loanToValuePercentage' => $this->ltv,
            'period' => $this->period,
            'onlyUseIncludedLabels' => $onlyUseIncludedLabels,
            'page' => $this->page,
            'limit' => $this->limit
        ];
    }

    /**
     * @return int|null
     */
    public function getMortgageProviderId()
    {
        return $this->mortgageProviderId;
    }

    /**
     * @return int|null
     */
    public function getLabelId()
    {
        return $this->labelId;
    }

    /**
     * @return int|null
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return MortgageType|null
     */
    public function getMortgageType()
    {
        return $this->mortgageType;
    }

    /**
     * @return AvailableForType|null
     */
    public function getAvailableFor()
    {
        return $this->availableFor;
    }

    /**
     * @return bool|null
     */
    public function getNhg()
    {
        return $this->nhg;
    }

    /**
     * @return float|null
     */
    public function getLtv()
    {
        return $this->ltv;
    }

    /**
     * @return int|null
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @return bool|null
     */
    public function getOnlyUseIncludedLabels()
    {
        return $this->onlyUseIncludedLabels;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }
}