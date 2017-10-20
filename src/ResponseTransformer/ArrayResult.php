<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\ResponseTransformer;

use Dnhb\ApiClient\Exception\ApiClientUnexpectedResultException;

/**
 * Class ArrayResult
 *
 * @package Dnhb\ApiClient\ResponseTransformer
 */
final class ArrayResult implements TransformerInterface
{
    /**
     * @param array $response
     *
     * @return array
     * @throws ApiClientUnexpectedResultException
     */
    public function transform(array $response): array
    {
        if (!isset($response['data'])) {
            throw new ApiClientUnexpectedResultException();
        }

        return $response['data'];
    }
}