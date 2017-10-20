<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import\Traits;

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
            if ($value !== null) {
                $array[$key] = $value;
            }
        }

        return $array;
    }
}