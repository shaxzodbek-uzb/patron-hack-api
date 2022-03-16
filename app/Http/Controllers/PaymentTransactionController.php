<?php

namespace App\Http\Controllers;

use App\Models\PaymentTransaction;

class PaymentTransactionController extends Controller
{
    protected $model = PaymentTransaction::class;
    protected $rules = [
        'payment_detail' => 'required',
        'amount' => 'required',
        'business_process_id' => 'required',
        'payment_type_id' => 'required',
        'date' => 'required',
        'payment_status'  => 'required'
    ];
}