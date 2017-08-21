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
    const INTEREST_ONLY = 'interest-only';
    /** */
    const SAVING = 'saving';
    /** */
    const LIFE = 'life';
    /** */
    const HYBRID = 'hybrid';
    /** */
    const INVESTMENT = 'investment';
    /** */
    const ANNUITY = 'annuity';
    /** */
    const LINEAR = 'linear';
    /** */
    const CREDIT = 'credit';
    /** */
    const BANKSAVING = 'banksaving';
    /** */
    const BRIDGING_LOAN = 'bridging-loan';

}