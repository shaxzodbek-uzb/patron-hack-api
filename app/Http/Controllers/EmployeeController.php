<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class EmployeeController extends Controller
{
    protected $model = Employee::class;
    protected $list_attach_relations = ['employee_position'];
    protected $rules = ['full_name' => 'required', 'employee_position_id' => 'required'];
}