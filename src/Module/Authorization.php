<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Module;

use Dnhb\ApiClient\Authorization\Token\TokenRequest;

/**
 * Class Auth
 *
 * @package Dnhb\ApiClient\Module
 */
final class Authorization extends AbstractModule
{
    /**
     * @return string
     */
    public function token(): string
    {
        return $this->client->send(new TokenRequest());
    }
}