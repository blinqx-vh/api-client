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
    use WithResponseTransformer;

    /**
     * @return TransformerInterface
     */
    public function getResponseTransformer(): TransformerInterface
    {
        if ($this->responseTransformer !== null) {
            return $this->responseTransformer;
        }

        return new DateResult();
    }
}
