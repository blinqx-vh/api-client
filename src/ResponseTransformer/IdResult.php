<?php
declare(strict_types=1);


namespace Dnhb\ApiClient\ResponseTransformer;

use Dnhb\ApiClient\Exception\ApiClientUnexpectedResultException;


/**
 * Class IdResult
 *
 * @package Dnhb\ApiClient\ResponseTransformer
 */
final class IdResult implements TransformerInterface
{
    /**
     * @param array $response
     * @return int
     * @throws ApiClientUnexpectedResultException
     */
    public function transform(array $response): int
    {
        if (!isset($response['data']['id'])) {
            throw new ApiClientUnexpectedResultException();
        }

        return $response['data']['id'];
    }
}