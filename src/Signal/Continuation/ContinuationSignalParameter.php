<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Signal\Continuation;

use DateTime;
use Dnhb\ApiClient\Contract\GetParameterInterface;

/**
 * Class ContinuationSignalParameter
 */
final class ContinuationSignalParameter implements GetParameterInterface
{

    /** @var DateTime */
    private $newSince;

    /** @var DateTime */
    private $updatedSince;

    /** @var int */
    private $page;

    /** @var int */
    private $limit;

    /**
     * ContinuationSignalParameter constructor.
     *
     * @param DateTime $newSince
     * @param DateTime $updatedSince
     * @param int $page
     * @param int $limit
     */
    public function __construct(
        DateTime $newSince = null,
        DateTime $updatedSince = null,
        int $page = 0,
        int $limit = 25
    )
    {

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

        return $data;
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
