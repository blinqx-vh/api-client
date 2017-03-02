<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Import\Parameter;

use DateTime;
use Dnhb\ApiClient\Data\Gender;
use Dnhb\ApiClient\Exception\ValueNotSetException;
use Dnhb\ApiClient\Import\AbstractImportParameter;
use Dnhb\ApiClient\Import\Assert\Assertion;
use Dnhb\ApiClient\Import\Manager\ValidationManager;
use Dnhb\ApiClient\Import\Scope;
use Dnhb\ApiClient\Import\Traits\WithSerialize;

/**
 * Class PersonParameter
 *
 * @package Dnhb\ApiClient\Import\Parameter
 */
final class PersonParameter extends AbstractImportParameter
{
    use WithSerialize;

    /** */
    const TYPE = 'Person';

    /** @var bool */
    protected $isPrimaryContact;
    /** @var string */
    protected $lastName;
    /** @var string|null */
    protected $firstName;
    /** @var string|null */
    protected $initials;
    /** @var string|null */
    protected $lastNamePrefix;
    /** @var string|null */
    protected $email;
    /** @var string|null */
    protected $dateOfBirth;
    /** @var string|null */
    protected $gender;
    /** @var string|null */
    protected $privatePhoneNumber;
    /** @var string|null */
    protected $mobilePhoneNumber;

    /**
     * PersonParameter constructor.
     * @param string $identifier
     * @param Scope  $scope
     */
    public function __construct($identifier, Scope $scope)
    {
        parent::__construct($identifier, $scope);

        $this->setRequiredProperties([
            'isPrimaryContact',
            'lastName'
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

        if ($this->isPrimaryContact === false && $this->privatePhoneNumber !== null) {
            $validationManager->addFailure('privatePhoneNumber could only be set on a primary contact');
        }
    }

    /**
     * @return bool
     * @throws ValueNotSetException
     */
    public function isPrimaryContact(): bool
    {
        if ($this->isPrimaryContact === null) {
            throw new ValueNotSetException('Value isPrimaryContact must be set before accessing it');
        }

        return $this->isPrimaryContact;
    }

    /**
     * @param boolean $value
     * @return PersonParameter
     */
    public function setIsPrimaryContact(bool $value): PersonParameter
    {
        $this->isPrimaryContact = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return PersonParameter
     */
    public function setLastName(string $value): PersonParameter
    {
        Assertion::notEmpty($value, 'LastName cannot be empty');

        $this->lastName = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return PersonParameter
     */
    public function setInitials(string $value): PersonParameter
    {
        $this->initials = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return PersonParameter
     */
    public function setFirstName(string $value): PersonParameter
    {
        $this->firstName = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return PersonParameter
     */
    public function setLastNamePrefix(string $value): PersonParameter
    {
        $this->lastNamePrefix = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return PersonParameter
     */
    public function setEmail(string $value): PersonParameter
    {
        Assertion::email($value, 'Email should contain a valid email address');

        $this->email = $value;
        return $this;
    }

    /**
     * @param DateTime $value
     * @return PersonParameter
     */
    public function setDateOfBirth(DateTime $value): PersonParameter
    {
        Assertion::lessOrEqualThan($value, new DateTime(), 'Date of Birth should be in the past');

        $this->dateOfBirth = $value->format('Y-m-d');
        return $this;
    }

    /**
     * @param Gender $value
     * @return PersonParameter
     */
    public function setGender(Gender $value): PersonParameter
    {
        $this->gender = $value->getKey();
        return $this;
    }

    /**
     * @param string $value
     * @return PersonParameter
     */
    public function setPrivatePhoneNumber(string $value): PersonParameter
    {
        if (null !== $this->isPrimaryContact) {
            Assertion::true($this->isPrimaryContact(), 'Private phone number can only be set on primaryContact');
        }
        Assertion::phonenumber($value, 'Private phone number should contain a valid phone number');

        $this->privatePhoneNumber = $value;
        return $this;
    }

    /**
     * @param string $value
     * @return PersonParameter
     */
    public function setMobilePhoneNumber(string $value): PersonParameter
    {
        Assertion::phonenumber($value, 'Mobile phone number should contain a valid phone number');

        $this->mobilePhoneNumber = $value;
        return $this;
    }
}