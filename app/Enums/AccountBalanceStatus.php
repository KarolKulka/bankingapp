<?php

namespace App\Enums;

enum AccountBalanceStatus: string
{
    case Debt = "debt";

    case Afloat = 'afloat';
}
