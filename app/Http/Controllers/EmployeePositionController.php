<?php

namespace App\Http\Controllers;

use App\Models\EmployeePosition;

class EmployeePositionController extends Controller
{
    protected $model = EmployeePosition::class;
    protected $rules = ['name' => 'required', 'salary' => 'required', 'organizational_structure_id' => 'sometimes'];
    protected $list_attach_relations = ['organizational_structure'];
}