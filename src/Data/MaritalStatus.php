<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Data;

use MyCLabs\Enum\Enum;

/**
 * Class MaritalStatus
 *
 * @package Dnhb\ApiClient\Data
 */
final class MaritalStatus extends Enum
{
    /** */
    const SINGLE = 1;

    /** */
    const DIVORCED = 2;

    /** */
    const COHABITATION_CONTRACT = 3;

    /** */
    const COHABITATION = 4;

    /** */
    const MARRIED_JOINT_ESTATE = 5;

    /** */
    const MARRIED_PRENUPTIAL_AGREEMENT = 6;

    /** */
    const REGISTERED_PARTNER_JOINT_ESTATE = 7;

    /** */
    const REGISTERED_PARTNER_CONDITIONAL = 8;

    /** */
    const WIDOW_WIDOWER = 9;
}