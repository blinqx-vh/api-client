<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Data;

use MyCLabs\Enum\Enum;

/**
 * Class AvailableForType
 *
 * @package Dnhb\ApiClient\Data
 */
final class AvailableForType extends Enum
{
    /** */
    const TYPE_CONTINUATION = 'CONTINUATION';

    /** */
    const TYPE_ARRANGEMENT = 'ARRANGEMENT';

    /** */
    const TYPE_BOTH = 'BOTH';
}