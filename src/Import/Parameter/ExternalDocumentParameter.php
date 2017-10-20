<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import\Parameter;

use Dnhb\ApiClient\Import\AbstractImportParameter;
use Dnhb\ApiClient\Import\Assert\Assertion;
use Dnhb\ApiClient\Import\Manager\ValidationManager;
use Dnhb\ApiClient\Import\Scope;
use Dnhb\ApiClient\Import\Traits\WithSerialize;

/**
 * Class ExternalDocumentParameter
 *
 * @package Dnhb\ApiClient\Import\Parameter
 */
final class ExternalDocumentParameter extends AbstractImportParameter
{
    use WithSerialize;

    /** */
    const TYPE = 'ExternalDocument';

    /** @var string */
    protected $url;
    /** @var string */
    protected $description;

    /**
     * @return string
     */
    public function getType(): string
    {
        return self::TYPE;
    }

    /**
     * ExternalDocumentParameter constructor.
     *
     * @param string $identifier
     * @param Scope  $scope
     */
    public function __construct($identifier, Scope $scope)
    {
        parent::__construct($identifier, $scope);

        $this->setRequiredProperties(['url']);
    }

    /**
     * @param ValidationManager $validationManager
     */
    public function validate(ValidationManager $validationManager)
    {
        $this->validateRequiredProperties($validationManager, get_object_vars($this));
    }

    /**
     * @param string $value
     *
     * @return ExternalDocumentParameter
     */
    public function setUrl(string $value): ExternalDocumentParameter
    {
        Assertion::notEmpty($value, 'Url cannot be empty');

        $this->url = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return ExternalDocumentParameter
     */
    public function setDescription(string $value): ExternalDocumentParameter
    {
        Assertion::notEmpty($value, 'Description cannot be empty');

        $this->description = $value;

        return $this;
    }
}