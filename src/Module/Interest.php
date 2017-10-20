<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Module;

use Dnhb\ApiClient\Data\AvailableForType;
use Dnhb\ApiClient\Data\MortgageType;
use Dnhb\ApiClient\Data\SortDirectionType;
use Dnhb\ApiClient\Data\SortInterestRatesByType;
use Dnhb\ApiClient\Exception\ApiClientAuthException;
use Dnhb\ApiClient\Exception\ApiClientInvalidArgumentException;
use Dnhb\ApiClient\Exception\ApiClientResponseException;
use Dnhb\ApiClient\Interest\Label\BankLabelsParameter;
use Dnhb\ApiClient\Interest\Label\BankLabelsRequest;
use Dnhb\ApiClient\Interest\Label\InterestLabelParameter;
use Dnhb\ApiClient\Interest\MortageProvider\MortgageProvidersParameter;
use Dnhb\ApiClient\Interest\MortageProvider\MortgageProvidersRequest;
use Dnhb\ApiClient\Interest\Rate\InterestRatesParameter;
use Dnhb\ApiClient\Interest\Rate\InterestRatesRequest;

/**
 * Class Interest
 *
 * @package Dnhb\ApiClient\Module
 */
final class Interest extends AbstractModule
{
    /**
     * Get interest rates
     *
     * @param int                     $mortgageProviderId
     * @param int|null                $labelId
     * @param int|null                $productId
     * @param AvailableForType        $availableFor
     * @param bool                    $nhg
     * @param int|null                $loanToValuePercentage
     * @param bool                    $bestInterestOnly
     * @param int                     $period
     * @param bool                    $onlyUseIncludedLabels
     * @param SortInterestRatesByType $sortBy
     * @param SortDirectionType       $sortDirection
     * @param int                     $page
     * @param int                     $limit
     *
     * @throws ApiClientInvalidArgumentException
     * @throws ApiClientResponseException
     * @throws ApiClientAuthException
     *
     * @return array
     */
    public function getInterestRates(
        int $mortgageProviderId,
        int $labelId = null,
        int $productId = null,
        AvailableForType $availableFor,
        bool $nhg,
        int $loanToValuePercentage = null,
        bool $bestInterestOnly,
        $period,
        bool $onlyUseIncludedLabels,
        SortInterestRatesByType $sortBy,
        SortDirectionType $sortDirection,
        int $page = 0,
        int $limit = 25
    ): array {
        $parameter = new InterestRatesParameter(
            $mortgageProviderId,
            $labelId,
            $productId,
            $availableFor,
            $nhg,
            $loanToValuePercentage,
            $bestInterestOnly,
            $period,
            $onlyUseIncludedLabels,
            $sortBy,
            $sortDirection,
            $page,
            $limit
        );

        return $this->client->send(new InterestRatesRequest($parameter));
    }

    /**
     * Get bank labels.
     *
     * @param int|null              $mortgageProvider
     * @param int|null              $product
     * @param MortgageType|null     $mortgageType
     * @param AvailableForType|null $availableFor
     * @param bool|null             $nhg
     * @param float|null            $ltv
     * @param int|null              $period
     * @param bool|null             $onlyUseIncludedLabels
     * @param float|null            $maxLtv
     * @param int                   $page
     * @param int                   $limit
     *
     * @throws ApiClientInvalidArgumentException
     * @throws ApiClientAuthException
     * @throws ApiClientResponseException
     *
     * @return array
     */
    public function getBankLabels(
        int $mortgageProvider = null,
        int $product = null,
        MortgageType $mortgageType = null,
        AvailableForType $availableFor = null,
        bool $nhg = null,
        float $ltv = null,
        int $period = null,
        bool $onlyUseIncludedLabels = null,
        float $maxLtv = null,
        int $page = 0,
        int $limit = 25
    ): array {
        $parameter = new BankLabelsParameter(
            $mortgageProvider,
            $product,
            $mortgageType,
            $availableFor,
            $nhg,
            $ltv,
            $period,
            $onlyUseIncludedLabels,
            $maxLtv,
            $page,
            $limit
        );

        return $this->client->send(new BankLabelsRequest($parameter));
    }

    /**
     * Get mortgage providers.
     *
     * @param int|null              $mortgageProviderId
     * @param int|null              $labelId
     * @param int|null              $productId
     * @param MortgageType|null     $mortgageType
     * @param AvailableForType|null $availableFor
     * @param bool|null             $nhg
     * @param float|null            $ltv
     * @param int|null              $period
     * @param bool|null             $onlyUseIncludedLabels
     * @param int                   $page
     * @param int                   $limit
     *
     * @throws ApiClientInvalidArgumentException
     * @throws ApiClientAuthException
     * @throws ApiClientResponseException
     *
     * @return array
     */
    public function getMortgageProviders(
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
    ): array {
        $parameter = new MortgageProvidersParameter(
            $mortgageProviderId,
            $labelId,
            $productId,
            $mortgageType,
            $availableFor,
            $nhg,
            $ltv,
            $period,
            $onlyUseIncludedLabels,
            $page,
            $limit
        );

        return $this->client->send(new MortgageProvidersRequest($parameter));
    }
}