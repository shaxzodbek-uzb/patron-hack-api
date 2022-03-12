<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;

class PaymentTypeController extends Controller
{
    protected $model = PaymentType::class;
    protected $rules = ['name' => 'required'];
}