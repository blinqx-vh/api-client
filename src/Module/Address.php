<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Module;

use Dnhb\ApiClient\Address\Address\AddressParameter;
use Dnhb\ApiClient\Address\Address\AddressRequest;
use Dnhb\ApiClient\Address\Option\AddressOptionParameter;
use Dnhb\ApiClient\Address\Option\AddressOptionRequest;

/**
 * Class Address
 * acts as a facade to the actual requests.
 *
 * @package Dnhb\ApiClient\Module
 */
final class Address extends AbstractModule
{
    /**
     * Get address details.
     *
     * @param string|null $street
     * @param string|null $city
     * @param string|null $postalcode
     * @param string|null $houseNumber
     * @param int|null    $page
     * @param int|null    $limit
     *
     * @return mixed
     * @throws \Dnhb\ApiClient\Exception\ApiClientAuthException
     * @throws \Dnhb\ApiClient\Exception\ApiClientResponseException
     */
    public function getAddress(
        string $street = null,
        string $city = null,
        string $postalcode = null,
        string $houseNumber = null,
        int $page = null,
        int $limit = null
    ) {
        $addressParameter = new AddressParameter(
            $street,
            $city,
            $postalcode,
            $houseNumber,
            $page,
            $limit
        );

        return $this->client->send(new AddressRequest($addressParameter));
    }

    /**
     * Get address option details.
     *
     * @param string|null $street
     * @param string|null $city
     * @param string|null $postalcode
     * @param string|null $houseNumber
     * @param string      $field
     * @param int|null    $page
     * @param int|null    $limit
     *
     * @return mixed
     * @throws \Dnhb\ApiClient\Exception\ApiClientAuthException
     * @throws \Dnhb\ApiClient\Exception\ApiClientResponseException
     */
    public function getAddressOptions(
        string $street = null,
        string $city = null,
        string $postalcode = null,
        string $houseNumber = null,
        string $field,
        int $page = null,
        int $limit = null
    ) {
        $addressOptionParameter = new AddressOptionParameter(
            $street,
            $city,
            $postalcode,
            $houseNumber,
            $field,
            $page,
            $limit
        );

        return $this->client->send(new AddressOptionRequest($addressOptionParameter));
    }
}