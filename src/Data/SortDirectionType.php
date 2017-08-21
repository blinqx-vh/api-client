<?php
declare(strict_types=1);

namespace Dnhb\ApiClient\Data;


use MyCLabs\Enum\Enum;

/**
 * Class SortDirectionType
 *
 * @package Dnhb\ApiClient\Data
 */
final class SortDirectionType extends Enum
{
    /**  */
    const DIRECTION_ASC = 'ASC';
    /**  */
    const DIRECTION_DESC = 'DESC';
}