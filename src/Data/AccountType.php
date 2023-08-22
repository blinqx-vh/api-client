<?php
declare(strict_types = 1);

namespace Dnhb\ApiClient\Data;

use MyCLabs\Enum\Enum;

class AccountType extends Enum
{
    public const SPAARLOON_ACCOUNT = 1;

    public const PREMIUM_SAVINGS_ACCOUNT = 2;

    public const LIVE_COURES_ACCOUNT = 3;

    public const INVESTOR_ACCOUNT = 5;

    public const SAVINGS_ACCOUNT = 6;

    public const PAYMENT_ACCOUNT = 7;
}
