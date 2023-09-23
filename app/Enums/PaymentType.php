<?php

namespace App\Enums;

abstract class PaymentType
{
    const Package      = 'package';
    const Quote        = 'quote';
    const TierUpgrade  = 'tier_upgrade';

    const Paid     = 'paid';
    const Unpaid   = 'unpaid';
}
