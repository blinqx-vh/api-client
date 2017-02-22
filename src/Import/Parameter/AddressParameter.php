<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Import\Parameter;

use Dnhb\ApiClient\Import\AbstractImportParameter;
use Dnhb\ApiClient\Import\Assert\Assertion;
use Dnhb\ApiClient\Import\Manager\ValidationManager;
use Dnhb\ApiClient\Import\Scope;
use Dnhb\ApiClient\Import\Traits\WithSerialize;

/**
 * Class AddressParameter
 *
 * @package Dnhb\ApiClient\Import\Parameter
 */
final class AddressParameter extends AbstractImportParameter
{
    use WithSerialize;

    /** */
    const TYPE = 'Address';

    /** @var string */
    protected $postalCode;
    /** @var string */
    protected $houseNumber;
    /** @var string */
    protected $addition;
    /** @var string */
    protected $street;
    /** @var string */
    protected $city;

    /**
     * AddressParameter constructor.
     * @param string $identifier
     * @param Scope  $scope
     */
    public function __construct($identifier, Scope $scope)
    {
        parent::__construct($identifier, $scope);

        $this->setRequiredProperties([
            'postalCode',
            'houseNumber',
            'street',
            'city'
        ]);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return self::TYPE;
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
     * @return AddressParameter
     */
    public function setPostalCode(string $value): AddressParameter
    {
        Assertion::notEmpty($value, 'Postal code cannot be empty');
        Assertion::postalcode($value, 'Postal code should be of valid format (1000AA)');

        $this->postalCode = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return AddressParameter
     */
    public function setHouseNumber(string $value): AddressParameter
    {
        Assertion::notEmpty($value, 'House number cannot be empty');
        Assertion::numeric($value, 'House number should be numeric');

        $this->houseNumber = $value;
        return $this;
    }

    /**
     * @param string $addition
     * @return AddressParameter
     */
    public function setAddition(string $addition): AddressParameter
    {
        $this->addition = $addition;
        return $this;
    }

    /**
     * @param string $value
     * @return AddressParameter
     */
    public function setStreet(string $value): AddressParameter
    {
        Assertion::notEmpty($value, 'Street cannot be empty');

        $this->street = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return AddressParameter
     */
    public function setCity(string $value): AddressParameter
    {
        Assertion::notEmpty($value, 'City cannot be empty');

        $this->city = $value;
        return $this;
    }
}