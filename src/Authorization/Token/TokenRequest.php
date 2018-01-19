<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Authorization\Token;

use Dnhb\ApiClient\Contract\AbstractGetApiRequest;
use Dnhb\ApiClient\Request\WithResponseTransformer;
use Dnhb\ApiClient\ResponseTransformer\TokenResult;
use Dnhb\ApiClient\ResponseTransformer\TransformerInterface;

/**
 * Class TokenRequest
 *
 * @package Dnhb\ApiClient\Authorization\Token
 */
final class TokenRequest extends AbstractGetApiRequest
{
    use WithResponseTransformer;
    /** @var string */
    protected $baseUrl = 'auth/v1/token';

    /**
     * @return TransformerInterface
     */
    public function getResponseTransformer(): TransformerInterface
    {
        if ($this->responseTransformer !== null) {
            return $this->responseTransformer;
        }

        return new TokenResult();
    }
}
