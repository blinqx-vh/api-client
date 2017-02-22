<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Calculation\Mortgage\MaximumByValue;


use Dnhb\ApiClient\Contract\GetParameterInterface;

/**
 * Class MaximumMortgageByValueParameter
 *
 * @package Dnhb\ApiClient\Calculation\Mortgage\MaximumByValue
 */
final class MaximumMortgageByValueParameter implements GetParameterInterface
{
    /** @var float */
    private $objectValue;

    /**
     * MaximumMortgageByValueParameter constructor.
     * @param float $objectValue
     */
    public function __construct(float $objectValue)
    {
        $this->objectValue = $objectValue;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'objectvalue' => $this->objectValue
        ];
    }

    /**
     * @return float
     */
    public function getObjectValue(): float
    {
        return $this->objectValue;
    }
}