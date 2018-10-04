<?php
declare(strict_types=1);


namespace Dnhb\ApiClient\Data;

use MyCLabs\Enum\Enum;

/**
 * Class ForSaleStatus
 */
final class ForSaleStatus extends Enum
{
    /** @var string */
    const FOR_SALE              = 'FOR_SALE';

    /** @var string */
    const SOLD_SUBJECT          = 'SOLD_SUBJECT';

    /** @var string */
    const SOLD                  = 'SOLD';

    /** @var string */
    const NO_LONGER_FOR_SALE    = 'NO_LONGER_FOR_SALE';
}
