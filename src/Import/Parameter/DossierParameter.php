<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import\Parameter;

use Dnhb\ApiClient\Data\ClientStatus;
use Dnhb\ApiClient\Data\MaritalStatus;
use Dnhb\ApiClient\Exception\ValueNotSetException;
use Dnhb\ApiClient\Import\AbstractImportParameter;
use Dnhb\ApiClient\Import\Assert\Assertion;
use Dnhb\ApiClient\Import\Manager\ValidationManager;
use Dnhb\ApiClient\Import\Scope;
use Dnhb\ApiClient\Import\Traits\WithSerialize;

/**
 * Class DossierParameter
 *
 * @package Dnhb\ApiClient\Import\Parameter
 */
final class DossierParameter extends AbstractImportParameter
{
    use WithSerialize;

    /** */
    const TYPE = 'Dossier';

    /** */
    const MIN_PERSONS_PER_DOSSIER = 1;

    /** */
    const MAX_PERSONS_PER_DOSSIER = 2;

    /** */
    const MAX_HOUSES_PER_DOSSIER = 1;

    /** */
    const MAX_LENGTH_LABEL = 255;

    /** @var array */
    protected $hasPersons;
    /** @var array */
    protected $hasHouses;
    /** @var array */
    protected $hasExternalDocuments;
    /** @var string */
    protected $hasCorrespondenceAddress;
    /** @var MaritalStatus|null */
    protected $maritalStatus;
    /** @var ClientStatus|null */
    protected $clientStatus;
    /** @var string */
    protected $note;
    /** @var array */
    protected $labels;

    /**
     * DossierParameter constructor.
     *
     * @param string $identifier
     * @param Scope  $scope
     */
    public function __construct($identifier, Scope $scope)
    {
        parent::__construct($identifier, $scope);

        $this->setClientStatus(new ClientStatus(ClientStatus::PROSPECT));
        $this->setRequiredProperties(['clientStatus']);
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

        if (count($this->hasPersons) < self::MIN_PERSONS_PER_DOSSIER) {
            $validationManager->addFailure('There are no persons added to the DossierParameter');

            return; // Cant check persons, so return before foreach statement
        }

        $hasPrimaryContact = false;
        foreach ($this->hasPersons as $identifier) {
            $personParameter = $this->getScope()->get($identifier);

            if (!$personParameter instanceof PersonParameter) {
                throw new \LogicException(
                    sprintf(
                        'An unexpected error occured, found a %s when a %s was expected',
                        get_class($personParameter),
                        PersonParameter::class
                    )
                );
            }

            try {
                $isPrimaryContact = $personParameter->isPrimaryContact();

                if ($isPrimaryContact === true) {
                    if ($hasPrimaryContact === true) {
                        $validationManager->addFailure('Only one primary contact per dossier is allowed');
                    }

                    $hasPrimaryContact = true;
                }
            } catch (ValueNotSetException $e) {
                // Do nothing
            }
        }
    }

    /**
     * @param PersonParameter $personParameter
     *
     * @return DossierParameter
     */
    public function addPerson(PersonParameter $personParameter): DossierParameter
    {
        Assertion::lessThan(
            count($this->hasPersons),
            self::MAX_PERSONS_PER_DOSSIER,
            sprintf('A maximum of %s persons per dossier is allowed', self::MAX_PERSONS_PER_DOSSIER)
        );

        if (!$this->getScope()->has($personParameter)) {
            $this->getScope()->add($personParameter);
        }

        $this->hasPersons[] = $personParameter->getIdentifier();

        return $this;
    }

    /**
     * @param string $identifier
     *
     * @return PersonParameter
     */
    public function createPerson(string $identifier): PersonParameter
    {
        $personParameter = new PersonParameter($identifier, $this->getScope());
        $this->addPerson($personParameter);

        return $personParameter;
    }

    /**
     * @param AddressParameter $address
     *
     * @return DossierParameter
     */
    public function addCorrespondenceAddress(AddressParameter $address): DossierParameter
    {
        Assertion::null($this->hasCorrespondenceAddress, 'Correspondence address already set');

        if (!$this->getScope()->has($address)) {
            $this->getScope()->add($address);
        }

        $this->hasCorrespondenceAddress = $address->getIdentifier();

        return $this;
    }

    /**
     * @param string $identifier
     *
     * @return AddressParameter
     */
    public function createCorrespondenceAddress(string $identifier): AddressParameter
    {
        $address = new AddressParameter($identifier, $this->getScope());
        $this->addCorrespondenceAddress($address);

        return $address;
    }

    /**
     * @param HouseParameter $house
     *
     * @return DossierParameter
     */
    public function addHouse(HouseParameter $house): DossierParameter
    {
        Assertion::lessThan(
            count($this->hasHouses),
            self::MAX_HOUSES_PER_DOSSIER,
            sprintf('A maximum of %s houses per dossier is allowed', self::MAX_HOUSES_PER_DOSSIER)
        );

        if (!$this->getScope()->has($house)) {
            $this->getScope()->add($house);
        }

        $this->hasHouses[] = $house->getIdentifier();

        return $this;
    }

    /**
     * @param string $identifier
     *
     * @return HouseParameter
     */
    public function createHouse(string $identifier): HouseParameter
    {
        $address = new HouseParameter($identifier, $this->getScope());
        $this->addHouse($address);

        return $address;
    }

    /**
     * @param ExternalDocumentParameter $externalDocument
     *
     * @return DossierParameter
     */
    public function addExternalDocument(ExternalDocumentParameter $externalDocument): DossierParameter
    {
        if (!$this->getScope()->has($externalDocument)) {
            $this->getScope()->add($externalDocument);
        }

        $this->hasExternalDocuments[] = $externalDocument->getIdentifier();

        return $this;
    }

    /**
     * @param string $identifier
     *
     * @return ExternalDocumentParameter
     */
    public function createExternalDocument(string $identifier): ExternalDocumentParameter
    {
        $externalDocument = new ExternalDocumentParameter($identifier, $this->getScope());
        $this->addExternalDocument($externalDocument);

        return $externalDocument;
    }

    /**
     * @param MaritalStatus $maritalStatus
     *
     * @return DossierParameter
     */
    public function setMaritalStatus(MaritalStatus $maritalStatus): DossierParameter
    {
        $this->maritalStatus = $maritalStatus->getKey();

        return $this;
    }

    /**
     * @param ClientStatus $clientStatus
     *
     * @return DossierParameter
     */
    public function setClientStatus(ClientStatus $clientStatus): DossierParameter
    {
        $this->clientStatus = $clientStatus->getKey();

        return $this;
    }

    /**
     * @param string $value
     *
     * @return DossierParameter
     */
    public function setNote(string $value): DossierParameter
    {
        $this->note = $value;

        return $this;
    }

    /**
     * @param string $label
     *
     * @return DossierParameter
     */
    public function addLabel(string $label): DossierParameter
    {
        Assertion::notEmpty($label, 'A label cannot be empty');
        Assertion::maxLength(
            $label,
            static::MAX_LENGTH_LABEL,
            sprintf(
                'A label cannot contain more than %s characters',
                static::MAX_LENGTH_LABEL
            )
        );

        $this->labels[] = $label;

        return $this;
    }
}