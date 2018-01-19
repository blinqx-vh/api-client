<?php
declare(strict_types = 1);

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
    use WithResponseTransformer;

    /**
     * @return TransformerInterface
     */
    public function getResponseTransformer(): TransformerInterface
    {
        if ($this->responseTransformer !== null) {
            return $this->responseTransformer;
        }

        return new FloatResult();
    }
}
