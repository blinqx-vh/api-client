<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Data;

use MyCLabs\Enum\Enum;

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
