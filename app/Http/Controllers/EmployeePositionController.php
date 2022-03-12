<?php

namespace App\Http\Controllers;

use App\Models\EmployeePosition;

class EmployeePositionController extends Controller
{
    protected $model = EmployeePosition::class;
    protected $rules = ['name' => 'required'];
}