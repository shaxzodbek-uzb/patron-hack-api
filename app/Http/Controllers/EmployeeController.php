<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class EmployeeController extends Controller
{
    protected $model = Employee::class;
    protected $rules = ['full_name' => 'required'];
}