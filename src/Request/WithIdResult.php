<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Request;

use Dnhb\ApiClient\ResponseTransformer\IdResult;
use Dnhb\ApiClient\ResponseTransformer\TransformerInterface;

/**
 * Class WithIdResult
 *
 * @package Dnhb\ApiClient\Request
 */
trait WithIdResult
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

        return new IdResult();
    }
}
