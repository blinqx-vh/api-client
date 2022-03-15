<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Address\HouseValue;

use Dnhb\ApiClient\Contract\GetParameterInterface;

final class EstimateHouseValueParameter implements GetParameterInterface
{
    /** @var string */
    private $postalcode;

    /** @var int */
    private $houseNumber;

    /** @var string|null */
    private $houseNumberAddition;

    public function __construct(string $postalcode, int $houseNumber, string $houseNumberAddition = null)
    {
        $this->postalcode = $postalcode;
        $this->houseNumber = $houseNumber;
        $this->houseNumberAddition = $houseNumberAddition;
    }

    public function serialize(): array
    {
        return [
            'postalcode' => $this->postalcode,
            'housenumber' => $this->houseNumber,
            'housenumber_addition' => $this->houseNumberAddition,
        ];
    }

    public function getPostalcode(): string
    {
        return $this->postalcode;
    }

    public function getHouseNumber(): int
    {
        return $this->houseNumber;
    }

    public function getHouseNumberAddition(): ?string
    {
        return $this->houseNumberAddition;
    }
}
