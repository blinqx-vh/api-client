<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Request;

use Dnhb\ApiClient\ResponseTransformer\ArrayResult;
use Dnhb\ApiClient\ResponseTransformer\TransformerInterface;

/**
 * Class WithArrayResult
 *
 * @package Dnhb\ApiClient\Request
 */
trait WithArrayResult
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

        return new ArrayResult();
    }
}
