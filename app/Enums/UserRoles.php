<?php

namespace App\Enums;

abstract class UserRoles
{
    const SuperAdmin     = 1;
    const SupportAdmin   = 2;
    const StaffAdmin     = 3;
    const SupportStaff   = 4;
    const AccountAdmin   = 5;
    const SupportAccount = 6;
    const Company        = 7;
}
