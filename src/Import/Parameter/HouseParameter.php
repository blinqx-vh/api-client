<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Import\Parameter;

use Dnhb\ApiClient\Import\AbstractImportParameter;
use Dnhb\ApiClient\Import\Assert\Assertion;
use Dnhb\ApiClient\Import\Manager\ValidationManager;
use Dnhb\ApiClient\Import\Scope;
use Dnhb\ApiClient\Import\Traits\WithSerialize;

/**
 * Class HouseParameter
 *
 * @package Dnhb\ApiClient\Import\Parameter
 */
final class HouseParameter extends AbstractImportParameter
{
    use WithSerialize;

    /** */
    const TYPE = 'House';

    /** @var  string */
    protected $hasAddress;
    /** @var  float */
    protected $woz;

    /**
     * @return string
     */
    public function getType(): string
    {
        return self::TYPE;
    }

    /**
     * BaseImportParameter constructor.
     *
     * @param string $identifier
     * @param Scope  $scope
     */
    public function __construct($identifier, Scope $scope)
    {
        parent::__construct($identifier, $scope);

        $this->setRequiredProperties(
            [
                'hasAddress',
            ]
        );
    }

    /**
     * @param ValidationManager $validationManager
     */
    public function validate(ValidationManager $validationManager)
    {
        $this->validateRequiredProperties($validationManager, get_object_vars($this));
    }

    /**
     * @param AddressParameter $address
     *
     * @return HouseParameter
     */
    public function addAddress(AddressParameter $address): HouseParameter
    {
        Assertion::null($this->hasAddress, 'Address already set');

        if (!$this->getScope()->has($address)) {
            $this->getScope()->add($address);
        }

        $this->hasAddress = $address->getIdentifier();

        return $this;
    }

    /**
     * @param string $identifier
     *
     * @return AddressParameter
     */
    public function createAddress(string $identifier): AddressParameter
    {
        $address = new AddressParameter($identifier, $this->getScope());
        $this->addAddress($address);

        return $address;
    }

    /**
     * @param float $woz
     *
     * @return HouseParameter
     */
    public function setWoz(float $woz): HouseParameter
    {
        Assertion::greaterOrEqualThan($woz, 0.0, 'WOZ should be higher or equals to zero');

        $this->woz = $woz;

        return $this;
    }
}