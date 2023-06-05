<?php

namespace App\Enums;

enum TransactionObjectType: string
{
    case Account = 'account';

    case Customer = 'customer';
}
