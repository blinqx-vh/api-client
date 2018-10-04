<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Signal\ForSale;

use DateTime;
use Dnhb\ApiClient\Contract\GetParameterInterface;
use Dnhb\ApiClient\Data\ForSaleStatus;
use Dnhb\ApiClient\Exception\ApiClientInvalidArgumentException;

/**
 * Class ForSaleSignalParameter
 */
final class ForSaleSignalParameter implements GetParameterInterface
{
    /** @var array */
    private $supportedStatuses = [
        ForSaleStatus::FOR_SALE,
        ForSaleStatus::NO_LONGER_FOR_SALE,
        ForSaleStatus::SOLD,
        ForSaleStatus::SOLD_SUBJECT
    ];

    /** @var ForSaleStatus|null */
    private $status;

    /** @var DateTime */
    private $newSince;

    /** @var DateTime */
    private $updatedSince;

    /** @var int */
    private $page;

    /** @var int */
    private $limit;

    /**
     * ForSaleSignalParameter constructor.
     *
     * @param ForSaleStatus|null $status
     * @param DateTime $newSince
     * @param DateTime $updatedSince
     * @param int $page
     * @param int $limit
     *
     * @throws ApiClientInvalidArgumentException
     */
    public function __construct(
        ForSaleStatus $status = null,
        DateTime $newSince = null,
        DateTime $updatedSince = null,
        int $page = 0,
        int $limit = 25
    )
    {
        if (null !== $status && !in_array($status->getValue(), $this->supportedStatuses, true)) {
            throw new ApiClientInvalidArgumentException(
                sprintf(
                    'Only %s mortgage types are supported for interest label lookup',
                    implode(', ', $this->supportedStatuses)
                )
            );
        }

        $this->status = $status;
        $this->newSince = $newSince;
        $this->updatedSince = $updatedSince;
        $this->page = $page;
        $this->limit = $limit;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        $data = [
            'page'          => $this->getPage(),
            'limit'         => $this->getLimit()
        ];

        if ($this->getNewSince() instanceof DateTime) {
           $data['new-since'] = $this->getNewSince()->format(DateTime::ATOM);
        }

        if ($this->getUpdatedSince() instanceof DateTime) {
            $data['updated-since'] = $this->getUpdatedSince()->format(DateTime::ATOM);
        }

        if ($this->getStatus() instanceof ForSaleStatus) {
            $data['status'] = $this->getStatus()->getValue();
        }

        return $data;
    }

    /**
     * @return ForSaleStatus|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return DateTime|null
     */
    public function getNewSince()
    {
        return $this->newSince;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedSince()
    {
        return $this->updatedSince;
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
