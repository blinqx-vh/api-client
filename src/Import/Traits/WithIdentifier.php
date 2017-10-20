<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import\Traits;

/**
 * Trait IdentifierTrait
 */
trait WithIdentifier
{
    /** @var string */
    private $identifier;

    /**
     * @param string $identifier
     */
    protected function setIdentifier(string $identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }
}