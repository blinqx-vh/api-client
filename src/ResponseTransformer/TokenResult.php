<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\ResponseTransformer;

use Dnhb\ApiClient\Exception\ApiClientUnexpectedResultException;

/**
 * Class TokenResult
 *
 * @package Dnhb\ApiClient\ResponseTransformer
 */
final class TokenResult implements TransformerInterface
{
    /**
     * @param array $response
     *
     * @return string
     * @throws ApiClientUnexpectedResultException
     */
    public function transform(array $response): string
    {
        if (!isset($response['data']['token'])) {
            throw new ApiClientUnexpectedResultException();
        }

        return $response['data']['token'];
    }
}