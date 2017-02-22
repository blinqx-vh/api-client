<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Import;

use Dnhb\ApiClient\Exception\ScopesNotMatchException;
use Dnhb\ApiClient\Import\Contract\ImportParameter;
use Dnhb\ApiClient\Import\Contract\Validatable;
use Dnhb\ApiClient\Import\Manager\ValidationManager;
use Dnhb\ApiClient\Import\Parameter\DossierParameter;
use Dnhb\ApiClient\Import\Traits\WithIdentifier;
use InvalidArgumentException;
use stdClass;

/**
 * Class Scope
 *
 * @package Dnhb\ApiClient\Import\Parameter
 */
final class Scope implements Validatable
{
    use WithIdentifier;

    /** @var array */
    private $items = [];

    /** @var array */
    private $lookup = [];

    /**
     * Scope constructor.
     * @param string $identifier
     */
    public function __construct(string $identifier)
    {
        $this->setIdentifier($identifier);
    }

    /**
     * @param ImportParameter $parameter
     * @return bool
     */
    public function has(ImportParameter $parameter): bool
    {
        return array_key_exists($parameter->getIdentifier(), $this->items);
    }

    /**
     * @param string $identifier
     * @return ImportParameter
     */
    public function get(string $identifier): ImportParameter
    {
        if (!array_key_exists($identifier, $this->items)) {
            throw new InvalidArgumentException(sprintf('Item with identifier %s doesn\'t exist', $identifier));
        }

        return $this->items[$identifier];
    }

    /**
     * @param ImportParameter $parameter
     * @throws ScopesNotMatchException
     */
    public function add(ImportParameter $parameter)
    {
        if (!$this->isSameScope($parameter->getScope())) {
            throw new ScopesNotMatchException(
                sprintf('%s cant be added to this scope, scopes dont match', $parameter->getIdentifier())
            );
        }

        if ($this->has($parameter)) {
            throw new InvalidArgumentException(sprintf(
                'Identifier \'%s\' already found in this scope',
                $parameter->getIdentifier()
            ));
        }

        if ($parameter->getType() === DossierParameter::TYPE && $this->hasType(DossierParameter::TYPE)) {
            throw new InvalidArgumentException('Only one DossierParameter is allowed per scope');
        }

        $this->lookup[$parameter->getType()][] = $parameter->getIdentifier();
        $this->items[$parameter->getIdentifier()] = $parameter;
    }

    /**
     * @return stdClass
     */
    public function serialize(): stdClass
    {
        $serializedItems = [];

        foreach ($this->items as $identifier => $item) {
            $serializedItems[$identifier] = $item->serialize();
        }

        return (object)$serializedItems;
    }

    /**
     * @param ValidationManager $validationManager
     */
    public function validate(ValidationManager $validationManager)
    {
        if ($this->countItemsOfType(DossierParameter::TYPE) !== 1) {
            $validationManager->addFailure('There should be exactly one dossier in the scope');
        }

        foreach ($this->items as $identifier => $item) {
            $item->validate($validationManager);
        }
    }

    /**
     * @param string $type
     * @return bool
     */
    private function hasType(string $type)
    {
        return array_key_exists($type, $this->lookup);
    }

    /**
     * @param string $type
     * @return int
     */
    private function countItemsOfType(string $type): int
    {
        if (!$this->hasType($type)) {
            return 0;
        }

        return count($this->lookup[$type]);
    }

    /**
     * @param Scope $scope
     * @return bool
     */
    private function isSameScope(Scope $scope)
    {
        return $this === $scope;
    }
}