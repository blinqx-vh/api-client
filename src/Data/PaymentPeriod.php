<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Data;

use MyCLabs\Enum\Enum;

/**
 * Class PaymentPeriod
 */
final class PaymentPeriod extends Enum
{
    /**
     *
     */
    const MONTH = 'MONTH';

    /**
     *
     */
    const QUARTER = 'QUARTER';

    /**
     *
     */
    const SIX_MONTHS = 'SIX_MONTHS';

    /**
     *
     */
    const YEAR = 'YEAR';
}
