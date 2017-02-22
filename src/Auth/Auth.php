<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Auth;


use Dnhb\ApiClient\Contract\AuthInterface;

/**
 * Class Auth
 *
 * @package Dnhb\ApiClient\Auth
 */
final class Auth implements AuthInterface
{
    /** @var string */
    private $key;
    /** @var string */
    private $value;

    /**
     * Auth constructor.
     *
     * @param string $key
     * @param string $value
     */
    private function __construct(string $key, string $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     *
     * @param string $apiKey
     * @return Auth
     */
    public static function apiKey(string $apiKey): Auth
    {
        return new self(self::TYPE_APIKEY, $apiKey);
    }

    /**
     * @param string $token
     * @return Auth
     */
    public static function token(string $token): Auth
    {
        return new self(self::TYPE_JWT, $token);
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}