<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Request;

use Dnhb\ApiClient\ResponseTransformer\DateResult;
use Dnhb\ApiClient\ResponseTransformer\TransformerInterface;

/**
 * Class WithDateResult
 *
 * @package Dnhb\ApiClient\Request
 */
trait WithDateResult
{
    /**
     * @return DateResult|TransformerInterface
     */
    public function getResponseTransformer(): TransformerInterface
    {
        return new DateResult();
    }
}