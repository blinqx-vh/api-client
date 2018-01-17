<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Contract;

use Dnhb\ApiClient\Request\Method;

/**
 * Class AbstractPostApiRequest
 *
 * @package Dnhb\ApiClient\Contract
 */
abstract class AbstractPostApiRequest extends AbstractApiRequest implements PostApiRequestInterface
{
    /**
     * @return string
     */
    public function getMethod(): string
    {
        return Method::POST;
    }
}