<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Data;

use MyCLabs\Enum\Enum;

/**
 * Class Gender
 *
 * @package Dnhb\ApiClient\Data
 */
final class Gender extends Enum
{
    /** Male */
    const MALE = 'MALE';

    /** Female */
    const FEMALE = 'FEMALE';
}