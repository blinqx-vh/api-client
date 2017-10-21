<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\ResponseTransformer;

use DateTime;
use Dnhb\ApiClient\Exception\ApiClientResponseException;
use Dnhb\ApiClient\Exception\ApiClientUnexpectedResultException;

/**
 * Class DateResult
 *
 * @package Dnhb\ApiClient\ResponseTransformer
 */
final class DateResult implements TransformerInterface
{
    /**
     * @param array $response
     * @return DateTime
     * @throws ApiClientResponseException
     * @throws ApiClientUnexpectedResultException
     */
    public function transform(array $response): DateTime
    {
        if (!isset($response['data']['result'])) {
            throw new ApiClientUnexpectedResultException();
        }

        $dateResponse =  DateTime::createFromFormat(
            '!Y-m-d',
            (string) $response['data']['result']
        );

        if(!DateTime::getLastErrors()['warning_count'] === 0){
            throw new ApiClientResponseException('The used date is not valid');
        }

        return $dateResponse;
    }
}