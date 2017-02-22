<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Contract;

use Dnhb\ApiClient\Request\Method;

/**
 * Class AbstractGetApiRequest
 *
 * @package Dnhb\ApiClient\Contract
 */
abstract class AbstractGetApiRequest extends AbstractApiRequest implements GetApiRequestInterface
{
    /**
     * @return string
     */
    public function getMethod(): string
    {
        return Method::GET;
    }
}