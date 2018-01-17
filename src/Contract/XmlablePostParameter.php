<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Contract;

/**
 * Interface XmlablePostParameter
 *
 * @package Dnhb\ApiClient\Contract
 */
interface XmlablePostParameter
{
    /**
     * @return string
     */
    public function asXml(): string;
}