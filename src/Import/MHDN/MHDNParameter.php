<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import\MHDN;

use Dnhb\ApiClient\Contract\XmlablePostParameter;
use Dnhb\ApiClient\Exception\ApiClientInvalidArgumentException;
use Exception;
use SimpleXMLElement;

/**
 * Class MHDNParameter
 *
 * @package Dnhb\ApiClient\Import\MHDN
 */
final class MHDNParameter implements XmlablePostParameter
{
    /** @var SimpleXMLElement */
    private $message;

    /**
     * MHDNParameter constructor.
     *
     * @param SimpleXMLElement $message
     */
    private function __construct(SimpleXMLElement $message)
    {
        $this->message = $message;
    }

    /**
     * @param string $message
     *
     * @return MHDNParameter
     */
    public static function fromString(string $message): MHDNParameter
    {
        try {
            $xml = new SimpleXMLElement($message);
        } catch (Exception $exception) {
            throw new ApiClientInvalidArgumentException(
                $exception->getMessage(),
                $exception->getCode(),
                $exception
            );
        }

        return new static($xml);
    }

    /**
     * @return string
     */
    public function asXml(): string
    {
        return $this->message->asXML();
    }
}