<?php
declare(strict_types=1);


namespace Dnhb\ApiClient\Data;


use MyCLabs\Enum\Enum;

/**
 * Class MortgageType
 *
 * @package Dnhb\ApiClient\Data
 */
final class MortgageType extends Enum
{
    /** */
    const INTEREST_ONLY = 'INTEREST_ONLY';
    /** */
    const SAVING = 'SAVING';
    /** */
    const LIFE = 'LIFE';
    /** */
    const HYBRID = 'HYBRID';
    /** */
    const INVESTMENT = 'INVESTMENT';
    /** */
    const ANNUITY = 'ANNUITY';
    /** */
    const LINEAR = 'LINEAR';
    /** */
    const CREDIT = 'CREDIT';
    /** */
    const BANKSAVING = 'BANKSAVING';
    /** */
    const BRIDGING_LOAN = 'BRIDGING_LOAN';

}