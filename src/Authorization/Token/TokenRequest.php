<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Authorization\Token;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\ResponseTransformer\TokenResult;
use Dnhb\ApiClient\ResponseTransformer\TransformerInterface;

/**
 * Class TokenRequest
 *
 * @package Dnhb\ApiClient\Authorization\Token
 */
final class TokenRequest extends AbstractGetApiRequest
{
    /** @var string */
    protected $baseUrl = 'auth/v1/token';

    /**
     * @return TransformerInterface
     */
    public function getResponseTransformer(): TransformerInterface
    {
        return new TokenResult();
    }
}