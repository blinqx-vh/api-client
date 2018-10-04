<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Module;

use DateTime;
use Dnhb\ApiClient\Data\ForSaleStatus;
use Dnhb\ApiClient\Signal\ClientDossierCompleteness\ClientDossierCompletenessSignalParameter;
use Dnhb\ApiClient\Signal\ClientDossierCompleteness\ClientDossierCompletenessSignalRequest;
use Dnhb\ApiClient\Signal\Continuation\ContinuationSignalParameter;
use Dnhb\ApiClient\Signal\Continuation\ContinuationSignalRequest;
use Dnhb\ApiClient\Signal\ForRent\ForRentSignalParameter;
use Dnhb\ApiClient\Signal\ForRent\ForRentSignalRequest;
use Dnhb\ApiClient\Signal\ForSale\ForSaleSignalParameter;
use Dnhb\ApiClient\Signal\ForSale\ForSaleSignalRequest;
use Dnhb\ApiClient\Signal\LifeInsurance\LifeInsuranceSignalParameter;
use Dnhb\ApiClient\Signal\LifeInsurance\LifeInsuranceSignalRequest;
use Dnhb\ApiClient\Signal\Refinancing\RefinancingSignalParameter;
use Dnhb\ApiClient\Signal\Refinancing\RefinancingSignalRequest;
use Dnhb\ApiClient\Signal\RiskClassReduction\RiskClassReductionSignalParameter;
use Dnhb\ApiClient\Signal\RiskClassReduction\RiskClassReductionSignalRequest;
use Dnhb\ApiClient\Signal\SavingsBasedMortgageRefinancing\SavingsBasedMortgageRefinancingSignalParameter;
use Dnhb\ApiClient\Signal\SavingsBasedMortgageRefinancing\SavingsBasedMortgageRefinancingSignalRequest;

/**
 * Class Signal
 */
final class Signal extends AbstractModule
{
    /**
     * @param DateTime|null $newSince
     * @param DateTime|null $updatedSince
     * @param int $page
     * @param int $limit
     *
     * @return array
     *
     * @throws \Dnhb\ApiClient\Exception\ApiClientConnectException
     * @throws \Dnhb\ApiClient\Exception\ApiClientResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRefinancingSignals(
        DateTime $newSince = null,
        DateTime $updatedSince = null,
        int $page = 0,
        int $limit = 25
    ): array {
        $parameter = new RefinancingSignalParameter(
            $newSince,
            $updatedSince,
            $page,
            $limit
        );
        return $this->client->send(new RefinancingSignalRequest($parameter));
    }

    /**
     * @param DateTime|null $newSince
     * @param DateTime|null $updatedSince
     * @param int $page
     * @param int $limit
     *
     * @return array
     *
     * @throws \Dnhb\ApiClient\Exception\ApiClientConnectException
     * @throws \Dnhb\ApiClient\Exception\ApiClientResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getConinuationSignals(
        DateTime $newSince = null,
        DateTime $updatedSince = null,
        int $page = 0,
        int $limit = 25
    ): array
    {
        $parameter = new ContinuationSignalParameter(
            $newSince,
            $updatedSince,
            $page,
            $limit
        );
        return $this->client->send(new ContinuationSignalRequest($parameter));
    }

    /**
     * @param DateTime|null $newSince
     * @param DateTime|null $updatedSince
     * @param int $page
     * @param int $limit
     *
     * @return array
     *
     * @throws \Dnhb\ApiClient\Exception\ApiClientConnectException
     * @throws \Dnhb\ApiClient\Exception\ApiClientResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLifeInsurenaceSignals(
        DateTime $newSince = null,
        DateTime $updatedSince = null,
        int $page = 0,
        int $limit = 25
    ): array
    {
        $parameter = new LifeInsuranceSignalParameter(
            $newSince,
            $updatedSince,
            $page,
            $limit
        );
        return $this->client->send(new LifeInsuranceSignalRequest($parameter));
    }

    /**
     * @param DateTime|null $newSince
     * @param DateTime|null $updatedSince
     * @param int $page
     * @param int $limit
     *
     * @return array
     *
     * @throws \Dnhb\ApiClient\Exception\ApiClientConnectException
     * @throws \Dnhb\ApiClient\Exception\ApiClientResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSavingsBasedMortgageRefinancingSignals(
        DateTime $newSince = null,
        DateTime $updatedSince = null,
        int $page = 0,
        int $limit = 25
    ): array
    {
        $parameter = new SavingsBasedMortgageRefinancingSignalParameter(
            $newSince,
            $updatedSince,
            $page,
            $limit
        );
        return $this->client->send(new SavingsBasedMortgageRefinancingSignalRequest($parameter));
    }

    /**
     * @param bool|null $offline
     * @param DateTime|null $newSince
     * @param DateTime|null $updatedSince
     * @param int $page
     * @param int $limit
     *
     * @return array
     *
     * @throws \Dnhb\ApiClient\Exception\ApiClientConnectException
     * @throws \Dnhb\ApiClient\Exception\ApiClientResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getForRentSignals(
        bool $offline = null,
        DateTime $newSince = null,
        DateTime $updatedSince = null,
        int $page = 0,
        int $limit = 25
    ): array
    {
        $parameter = new ForRentSignalParameter(
            $offline,
            $newSince,
            $updatedSince,
            $page,
            $limit
        );
        return $this->client->send(new ForRentSignalRequest($parameter));
    }

    /**
     * @param ForSaleStatus|null $status
     * @param DateTime|null $newSince
     * @param DateTime|null $updatedSince
     * @param int $page
     * @param int $limit
     *
     * @return array
     *
     * @throws \Dnhb\ApiClient\Exception\ApiClientConnectException
     * @throws \Dnhb\ApiClient\Exception\ApiClientInvalidArgumentException
     * @throws \Dnhb\ApiClient\Exception\ApiClientResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getForSaleSignals(
        ForSaleStatus $status = null,
        DateTime $newSince = null,
        DateTime $updatedSince = null,
        int $page = 0,
        int $limit = 25
    ): array
    {
        $parameter = new ForSaleSignalParameter(
            $status,
            $newSince,
            $updatedSince,
            $page,
            $limit
        );
        return $this->client->send(new ForSaleSignalRequest($parameter));
    }

    /**
     * @param DateTime|null $newSince
     * @param DateTime|null $updatedSince
     * @param int $page
     * @param int $limit
     *
     * @return array
     *
     * @throws \Dnhb\ApiClient\Exception\ApiClientConnectException
     * @throws \Dnhb\ApiClient\Exception\ApiClientResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRiskClassReductionSignals(
        DateTime $newSince = null,
        DateTime $updatedSince = null,
        int $page = 0,
        int $limit = 25
    ): array
    {
        $parameter = new RiskClassReductionSignalParameter(
            $newSince,
            $updatedSince,
            $page,
            $limit
        );
        return $this->client->send(new RiskClassReductionSignalRequest($parameter));
    }

    /**
     * @param DateTime|null $newSince
     * @param DateTime|null $updatedSince
     * @param int $page
     * @param int $limit
     *
     * @return array
     *
     * @throws \Dnhb\ApiClient\Exception\ApiClientConnectException
     * @throws \Dnhb\ApiClient\Exception\ApiClientResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getClientDossierCompletenessSignals(
        DateTime $newSince = null,
        DateTime $updatedSince = null,
        int $page = 0,
        int $limit = 25
    ): array
    {
        $parameter = new ClientDossierCompletenessSignalParameter(
            $newSince,
            $updatedSince,
            $page,
            $limit
        );
        return $this->client->send(new ClientDossierCompletenessSignalRequest($parameter));
    }
}
