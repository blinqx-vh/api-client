<?php
declare(strict_types=1);


namespace Dnhb\ApiClient\Request;


use Dnhb\ApiClient\ResponseTransformer\FloatResult;
use Dnhb\ApiClient\ResponseTransformer\TransformerInterface;

/**
 * Class WithFloatResult
 *
 * @package Dnhb\ApiClient\Request
 */
trait WithFloatResult
{
    /**
     * @return FloatResult|TransformerInterface
     */
    public function getResponseTransformer(): TransformerInterface
    {
        return new FloatResult();
    }
}