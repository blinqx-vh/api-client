<?php
declare(strict_types=1);


namespace Dnhb\ApiClient\ResponseTransformer;

use Dnhb\ApiClient\Exception\ApiClientUnexcpectedResultException;


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
     * @throws ApiClientUnexcpectedResultException
     */
    public function transform(array $response): int
    {
        if (!isset($response['data']['id'])) {
            throw new ApiClientUnexcpectedResultException();
        }

        return $response['data']['id'];
    }
}