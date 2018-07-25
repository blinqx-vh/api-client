<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Data;

use MyCLabs\Enum\Enum;

/**
 * Class LifeInsuranceCoverageType
 */
final class LifeInsuranceCoverageType extends Enum
{
    /**
     *
     */
    const CONSTANT = 'CONSTANT';

    /**
     *
     */
    const LINEAIR_DESC = 'LINEAIR_DESC';

    /**
     *
     */
    const ANNUITY_DESC = 'ANNUITY_DESC';
}
