<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\ResponseTransformer;

use Dnhb\ApiClient\Exception\ApiClientUnexpectedResultException;

/**
 * Class FloatResult
 *
 * @package Dnhb\ApiClient\ResponseTransformer
 */
final class FloatResult implements TransformerInterface
{
    /**
     * @param array $response
     *
     * @return float
     * @throws ApiClientUnexpectedResultException
     */
    public function transform(array $response): float
    {
        if (!isset($response['data']['result'])) {
            throw new ApiClientUnexpectedResultException();
        }

        return $response['data']['result'];
    }
}