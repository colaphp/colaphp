<?php

namespace App\Enums;

enum AuthType
{
    case ADMIN;
    case SUPPLIER;
    case SELLER;
    case USER;
}
