<?php
declare(strict_types=1);

namespace Dnhb\ApiClient;


use Dnhb\ApiClient\Module\Calculation;

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
}