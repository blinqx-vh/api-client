<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Request;

use Dnhb\ApiClient\Contract\ApiRequestInterface;
use Dnhb\ApiClient\ResponseTransformer\TransformerInterface;

/**
 * Class WithResponseTransformer
 *
 * @package Dnhb\ApiClient\Request
 */
trait WithResponseTransformer
{
    /** @var TransformerInterface */
    protected $responseTransformer;

    /**
     * @param TransformerInterface $responseTransformer
     *
     * @return $this|ApiRequestInterface
     */
    public function setResponseTransformer(TransformerInterface $responseTransformer): ApiRequestInterface
    {
        $this->responseTransformer = $responseTransformer;

        return $this;
    }
}
