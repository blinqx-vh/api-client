<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient;

use Dnhb\ApiClient\Module\Address;
use Dnhb\ApiClient\Module\Authorization;
use Dnhb\ApiClient\Module\Calculation;
use Dnhb\ApiClient\Module\Import;
use Dnhb\ApiClient\Module\Interest;
use Dnhb\ApiClient\Module\Signal;

/**
 * Class Api
 *
 * @package Dnhb\ApiClient
 */
class Api
{
    /** @var  Client */
    protected $client;

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
     * @return Address
     */
    public function address(): Address
    {
        return new Address($this->client);
    }

    /**
     * @return Authorization
     */
    public function authorization(): Authorization
    {
        return new Authorization($this->client);
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

    /**
     * @return Signal
     */
    public function signal(): Signal
    {
        return new Signal($this->client);
    }
}
