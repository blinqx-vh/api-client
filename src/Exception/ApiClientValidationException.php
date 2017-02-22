<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Exception;

use Exception;


/**
 * Class ApiClientValidationException
 *
 * @package Dnhb\ApiClient\Exception
 */
class ApiClientValidationException extends ApiClientException
{
    /**
     * ApiClientValidationException constructor.
     * @param string    $message
     * @param Exception $previous
     */
    public function __construct($message, Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}