<?php
declare(strict_types=1);


namespace Dnhb\ApiClient\ResponseTransformer;


/**
 * Interface TransformerInterface
 *
 * @package Dnhb\ApiClient\ResponseTransformer
 */
interface TransformerInterface
{
    /**
     * @param array $response
     * @return mixed
     */
    public function transform(array $response);
}