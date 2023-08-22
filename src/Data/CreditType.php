<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Data;

use MyCLabs\Enum\Enum;

/**
 * @method bool equalsFinancialLease
 * @method bool equalsLeasePurchases
 * @method bool equalsPartnerAlimony
 * @method bool equalsPersonalLoan
 * @method bool equalsRevolvingCredit
 * @method bool equalsStudentDebt
 * @method bool equalsStudyAdvance
 * @method bool isFinancialLease
 * @method bool isLeasePurchases
 * @method bool isPartnerAlimony
 * @method bool isPersonalLoan
 * @method bool isRevolvingCredit
 * @method bool isStudentDebt
 * @method bool isStudyAdvance
 * @method static CreditType FINANCIAL_LEASE()
 * @method static CreditType LEASE_PURCHASES()
 * @method static CreditType PARTNER_ALIMONY()
 * @method static CreditType PERSONAL_LOAN()
 * @method static CreditType REVOLVING_CREDIT()
 * @method static CreditType STUDENT_DEBT()
 * @method static CreditType STUDY_ADVANCE()
 */
class CreditType extends Enum
{
    public const REVOLVING_CREDIT = 1;

    public const PERSONAL_LOAN = 2;

    public const LEASE_PURCHASES = 3;

    public const FINANCIAL_LEASE = 4;

    public const STUDENT_DEBT = 5;

    public const STUDY_ADVANCE = 6;

    public const PARTNER_ALIMONY = 7;
}
