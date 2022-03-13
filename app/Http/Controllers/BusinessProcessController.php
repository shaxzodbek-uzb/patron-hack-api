<?php

namespace App\Http\Controllers;

use App\Models\BusinessProcess;

class BusinessProcessController extends Controller
{
    protected $model = BusinessProcess::class;
    protected $rules = [
        'name' => 'required',
        'payment_detail' => 'required',
        'payment_amount' => 'required',
        'classification_group_id' => 'required'
    ];
}