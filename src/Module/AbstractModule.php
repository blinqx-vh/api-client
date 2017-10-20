<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Module;

use Dnhb\ApiClient\Client;

/**
 * Class AbstractModule
 *
 * @package Dnhb\ApiClient\Module
 */
abstract class AbstractModule
{
    /**
     * @var  Client
     */
    protected $client;

    /**
     * AbstractModule constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}