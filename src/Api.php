<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient;

use Dnhb\ApiClient\Module\Calculation;
use Dnhb\ApiClient\Module\Import;
use Dnhb\ApiClient\Module\Interest;

/**
 * Class Api
 *
 * @package Dnhb\ApiClient
 */
final class Api
{
    /** @var  Client */
    private $client;

    /**
     * Api constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Calculation
     */
    public function calculation(): Calculation
    {
        return new Calculation($this->client);
    }

    /**
     * Interest api module
     *
     * @return Interest
     */
    public function interest(): Interest
    {
        return new Interest($this->client);
    }

    /**
     * @return Import
     */
    public function import(): Import
    {
        return new Import($this->client);
    }
}