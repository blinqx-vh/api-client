<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Calculation\Regulation\AOWDate;

use DateTime;
use Dnhb\ApiClient\Contract\GetParameterInterface;
use Dnhb\ApiClient\Import\Assert\Assertion;

/**
 * Class AOWDateParameter
 *
 * @package Dnhb\ApiClient\Calculation\Regulation\AOWDate
 */
final class AOWDateParameter implements GetParameterInterface
{
    /** @var DateTime */
    private $dateOfBirth;

    /**
     * AOWDateParameter constructor.
     *
     * @param DateTime $dateOfBirth
     */
    public function __construct(DateTime $dateOfBirth)
    {
        Assertion::lessOrEqualThan($dateOfBirth, new DateTime('now'));
        
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'dateOfBirth' => $this->dateOfBirth->format('Y-m-d'),
        ];
    }

    /**
     * @return DateTime
     */
    public function getDateOfBirth(): DateTime
    {
        return $this->dateOfBirth;
    }
}