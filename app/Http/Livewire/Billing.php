<?php

namespace App\Http\Livewire;

use App\Enums\PaymentType;
use App\Models\Payment;
use Livewire\Component;

class Billing extends Component
{
    public function render()
    {
        return view('livewire.billing', [
            'billings' => request()->user()->payments()->whereStatus(PaymentType::Paid)->latest()->paginate(10, ['*'], 'billing'),
            'quotes' => request()->user()->payments()->whereStatus(PaymentType::Unpaid)->latest()->paginate(10, ['*'], 'quote'),
        ]);
    }
}
