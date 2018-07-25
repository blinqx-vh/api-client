<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import\Traits;

use InvalidArgumentException;
use MyCLabs\Enum\Enum;
use stdClass;

/**
 * Trait WithSerialize
 */
trait WithSerialize
{
    /**
     * @return string
     */
    abstract public function getType(): string;

    /**
     * @return stdClass
     */
    public function serialize(): stdClass
    {
        return (object) $this->propertiesToArray(get_object_vars($this));
    }

    /**
     * @param array $properties
     *
     * @return array
     */
    private function propertiesToArray(array $properties): array
    {
        $array = ['@type' => $this->getType()];

        foreach ($properties as $key => $value) {
            if ($value === null) {
                continue;
            }

            if (is_object($value)) {
                $value = $this->stringify($value);
            }

            $array[$key] = $value;
        }

        return $array;
    }

    /**
     * Converts an object to a string
     *
     * @param $value
     *
     * @return string
     */
    private function stringify($value): string
    {
        if ($value instanceof \DateTime) {
            return $value->format('Y-m-d');
        }

        if (method_exists($value, '__toString')) {
            return (string) $value;
        }

        throw new InvalidArgumentException('Cannot stringify ' . get_class($value));
    }
}
