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

    /** */
    const INTEREST_ONLY_VARIATION = 'INTEREST_ONLY';
    /** */
    const SAVING_VARIATION = 'SAVING';
    /** */
    const LIFE_VARIATION = 'LIFE';
    /** */
    const HYBRID_VARIATION = 'HYBRID';
    /** */
    const INVESTMENT_VARIATION = 'INVESTMENT';
    /** */
    const ANNUITY_VARIATION = 'ANNUITY';
    /** */
    const LINEAR_VARIATION = 'LINEAR';
    /** */
    const CREDIT_VARIATION = 'CREDIT';
    /** */
    const BANKSAVING_VARIATION = 'BANKSAVING';
    /** */
    const BRIDGING_LOAN_VARIATION = 'BRIDGING_LOAN';

}