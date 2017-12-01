<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Address\Address;

use Dnhb\ApiClient\Contract\GetParameterInterface;

/**
 * Class AddressParameter
 */
class AddressParameter implements GetParameterInterface
{
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
     * @var int
     */
    private $page;
    /**
     * @var int
     */
    private $limit;

    /**
     * AddressParameter constructor.
     *
     * @param null|string $street
     * @param null|string $city
     * @param null|string $postalcode
     * @param null|string $houseNumber
     * @param int         $page
     * @param int         $limit
     */
    public function __construct(
        string $street = null,
        string $city = null,
        string $postalcode = null,
        string $houseNumber = null,
        int $page = 0,
        int $limit = 25
    ) {
        $this->street = $street;
        $this->city = $city;
        $this->postalcode = $postalcode;
        $this->houseNumber = $houseNumber;
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
            'street'      => $this->street,
            'city'        => $this->city,
            'postalcode'  => $this->postalcode,
            'houseNumber' => $this->houseNumber,
            'page'        => $this->page,
            'limit'       => $this->limit,
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