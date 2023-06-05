<?php

namespace App\Enums;

enum UserStatus: string
{
    case New = 'new';
    case Verified = 'verified';
    case Blocked = 'blocked';
}
