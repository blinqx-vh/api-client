<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Import\Traits;


use Dnhb\ApiClient\Import\Manager\ValidationManager;

/**
 * Class WithRequiredProperties
 */
trait WithRequiredProperties
{
    /** @var array */
    private $requiredProperties = [];

    /**
     * @param array $requiredProperties
     */
    protected function setRequiredProperties(array $requiredProperties)
    {
        $this->requiredProperties = $requiredProperties;
    }

    /**
     * @return array
     */
    public function getRequiredProperties()
    {
        return $this->requiredProperties;
    }

    /**
     * @param ValidationManager $validationHelper
     * @param array             $properties
     */
    protected function validateRequiredProperties(ValidationManager $validationHelper, array $properties)
    {
        foreach ($this->requiredProperties as $property) {
            if (null === $properties[$property]) {
                $validationHelper->addFailure(
                    sprintf('Property %s is required for %s', $property, $this->getType())
                );
            }
        }
    }

    /**
     * @return string
     */
    abstract public function getType(): string;
}