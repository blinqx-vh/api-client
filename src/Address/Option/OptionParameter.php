<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Address\Option;

use Dnhb\ApiClient\Contract\GetParameterInterface;
use Dnhb\ApiClient\Data\FieldType;
use Dnhb\ApiClient\Exception\ApiClientInvalidArgumentException;

/**
 * Class OptionParameter
 */
class OptionParameter implements GetParameterInterface
{
    /**
     * @var array
     */
    private $fieldOptions = [
        FieldType::FIELD_STREET,
        FieldType::FIELD_HOUSE_NUMBER,
        FieldType::FIELD_CITY,
        FieldType::FIELD_POSTALCODE,
        FieldType::FIELD_HOUSE_NUMBER_ADDITION,
        FieldType::FIELD_MUNICIPALITY
    ];

    /**
     * @var string|null
     */
    private $street;
    /**
     * @var string|null
     */
    private $city;
    /**
     * @var string|null
     */
    private $postalcode;
    /**
     * @var string|null
     */
    private $houseNumber;
    /**
     * @var string
     */
    private $field;
    /**
     * @var int
     */
    private $page;
    /**
     * @var int
     */
    private $limit;

    /**
     * OptionParameter constructor.
     *
     * @param null|string $street
     * @param null|string $city
     * @param null|string $postalcode
     * @param null|string $houseNumber
     * @param string      $field
     * @param int         $page
     * @param int         $limit
     *
     * @throws ApiClientInvalidArgumentException
     */
    public function __construct(
        string $street = null,
        string $city = null,
        string $postalcode = null,
        string $houseNumber = null,
        string $field,
        int $page = 0,
        int $limit = 25
    ) {

        if (!in_array($field, $this->fieldOptions, true)) {
            throw new ApiClientInvalidArgumentException(
                sprintf(
                    'Only %s field types are supported for address options',
                    implode(', ', $this->fieldOptions)
                )
            );
        }

        $this->street = $street;
        $this->city = $city;
        $this->postalcode = $postalcode;
        $this->houseNumber = $houseNumber;
        $this->field = $field;
        $this->page = $page;
        $this->limit = $limit;
    }

    /**
     * Return serialized data.
     *
     * @return array
     */
    public function serialize(): array
    {
        return [
            'street' => $this->street,
            'city' => $this->city,
            'postalcode' => $this->postalcode,
            'houseNumber' => $this->houseNumber,
            'field' => $this->field,
            'page' => $this->page,
            'limit' => $this->limit
        ];
    }

    /**
     * @return null|string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return null|string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return null|string
     */
    public function getPostalcode()
    {
        return $this->postalcode;
    }

    /**
     * @return null|string
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }
}