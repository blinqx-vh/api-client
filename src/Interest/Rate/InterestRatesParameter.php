<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Interest\Rate;

use Dnhb\ApiClient\Contract\GetParameterInterface;
use Dnhb\ApiClient\Data\AvailableForType;
use Dnhb\ApiClient\Data\SortDirectionType;
use Dnhb\ApiClient\Data\SortInterestRatesByType;
use Dnhb\ApiClient\Exception\ApiClientInvalidArgumentException;
use Dnhb\ApiClient\Import\Assert\Assertion;

/**
 * Class InterestRatesParameter
 *
 * @package Dnhb\ApiClient\Interest\Rate
 */
final class InterestRatesParameter implements GetParameterInterface
{

    /**
     * @var array 
     */
    private $supportedAvailablilityTypes = [
        AvailableForType::TYPE_ARRANGEMENT,
        AvailableForType::TYPE_CONTINUATION
    ];

    /**
     * @var array 
     */
    private $supportedSortDirections = [
        SortDirectionType::DIRECTION_ASC,
        SortDirectionType::DIRECTION_DESC
    ];

    /**
     * @var array
     */
    private $supportedSortBys = [
        SortInterestRatesByType::INTEREST_RATES_SORT_TYPE_PERCENTAGE
    ];

    /**
     * @var int 
     */
    private $mortgageProviderId;
    /**
     * @var int 
     */
    private $labelId;
    /**
     * @var int 
     */
    private $productId;
    /**
     * @var AvailableForType
     */
    private $availableFor;
    /**
     * @var boolean 
     */
    private $nhg;
    /**
     * @var double 
     */
    private $loanToValuePercentage;
    /**
     * @var boolean 
     */
    private $bestInterestOnly;
    /**
     * @var integer 
     */
    private $period;
    /**
     * @var boolean 
     */
    private $onlyUseIncludedLabels;
    /**
     * @var SortInterestRatesByType
     */
    private $sortBy;
    /**
     * @var SortDirectionType
     */
    private $sortDirection;
    /**
     * @var integer 
     */
    private $page;
    /**
     * @var integer 
     */
    private $limit;

    /**
     * InterestRatesParameter constructor.
     *
     * @param  int                          $mortgageProviderId
     * @param  int|null                     $labelId
     * @param  int|null                     $productId
     * @param  AvailableForType             $availableFor
     * @param  bool                         $nhg
     * @param  int|null                     $loanToValuePercentage
     * @param  bool                         $bestInterestOnly
     * @param  int                          $period
     * @param  bool                         $onlyUseIncludedLabels
     * @param  SortInterestRatesByType      $sortBy
     * @param  SortDirectionType            $sortDirection
     * @param  int                          $page
     * @param  int                          $limit
     * @throws ApiClientInvalidArgumentException
     */
    public function __construct(
        int $mortgageProviderId,
        int $labelId = null,
        int $productId = null,
        AvailableForType $availableFor,
        bool $nhg,
        int $loanToValuePercentage = null,
        bool $bestInterestOnly,
        int $period = null,
        bool $onlyUseIncludedLabels,
        SortInterestRatesByType $sortBy,
        SortDirectionType $sortDirection,
        int $page = 0,
        int $limit = 25
    ) {
        if (!in_array($availableFor->getValue(), $this->supportedAvailablilityTypes, true)) {
            throw new ApiClientInvalidArgumentException(
                sprintf(
                    'Only %s availability types are supported for interest rate calculations',
                    implode(', ', $this->supportedAvailablilityTypes)
                )
            );
        }

        if (!in_array($sortDirection->getValue(), $this->supportedSortDirections, true)) {
            throw new ApiClientInvalidArgumentException(
                sprintf(
                    'Only %s direction sorting types are supported for interest rate calculations',
                    implode(', ', $this->supportedSortDirections)
                )
            );
        }

        if (!in_array($sortBy->getValue(), $this->supportedSortBys, true)) {
            throw new ApiClientInvalidArgumentException(
                sprintf(
                    'Only %s sort by\'s are supported for interest rate calculations',
                    implode(', ', $this->supportedSortBys)
                )
            );
        }

        if (null !== $loanToValuePercentage) {
            Assertion::greaterOrEqualThan($loanToValuePercentage, 0);
        }

        $this->mortgageProviderId = $mortgageProviderId;
        $this->labelId = $labelId;
        $this->productId = $productId;
        $this->availableFor = $availableFor;
        $this->nhg = $nhg;
        $this->loanToValuePercentage = $loanToValuePercentage;
        $this->bestInterestOnly = $bestInterestOnly;
        $this->period = $period;
        $this->onlyUseIncludedLabels = $onlyUseIncludedLabels;
        $this->sortBy = $sortBy;
        $this->sortDirection = $sortDirection;
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
        return [
            'mortgageProviderId' => $this->mortgageProviderId,
            'labelId' => $this->labelId,
            'productId' => $this->productId,
            'availableFor' => $this->availableFor->getValue(),
            'nhg' => $this->nhg ? 'true' : 'false',
            'loanToValuePercentage' => $this->loanToValuePercentage,
            'bestInterestOnly' => $this->bestInterestOnly ? 'true' : 'false',
            'period' => $this->period,
            'onlyUseIncludedLabels' => $this->onlyUseIncludedLabels ? 'true' : 'false',
            'sortBy' => $this->sortBy->getValue(),
            'sortDirection' => $this->sortDirection->getValue(),
            'page' => $this->page,
            'limit' => $this->limit
        ];
    }

    /**
     * @return array
     */
    public function getSupportedAvailablilityTypes(): array
    {
        return $this->supportedAvailablilityTypes;
    }

    /**
     * @return array
     */
    public function getSupportedSortDirections(): array
    {
        return $this->supportedSortDirections;
    }

    /**
     * @return array
     */
    public function getSupportedSortBys(): array
    {
        return $this->supportedSortBys;
    }

    /**
     * @return int
     */
    public function getMortgageProviderId(): int
    {
        return $this->mortgageProviderId;
    }

    /**
     * @return int
     */
    public function getLabelId(): int
    {
        return $this->labelId;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @return AvailableForType
     */
    public function getAvailableFor(): AvailableForType
    {
        return $this->availableFor;
    }

    /**
     * @return bool
     */
    public function isNhg(): bool
    {
        return $this->nhg;
    }

    /**
     * @return float
     */
    public function getLoanToValuePercentage(): float
    {
        return $this->loanToValuePercentage;
    }

    /**
     * @return bool
     */
    public function isBestInterestOnly(): bool
    {
        return $this->bestInterestOnly;
    }

    /**
     * @return int
     */
    public function getPeriod(): int
    {
        return $this->period;
    }

    /**
     * @return bool
     */
    public function isOnlyUseIncludedLabels(): bool
    {
        return $this->onlyUseIncludedLabels;
    }

    /**
     * @return SortInterestRatesByType
     */
    public function getSortBy(): SortInterestRatesByType
    {
        return $this->sortBy;
    }

    /**
     * @return SortDirectionType
     */
    public function getSortDirection(): SortDirectionType
    {
        return $this->sortDirection;
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