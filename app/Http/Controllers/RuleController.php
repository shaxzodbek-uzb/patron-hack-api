<?php

namespace App\Http\Controllers;

use App\Models\Rule;

class RuleController extends Controller
{
    protected $model = Rule::class;
    protected $rules = ['name' => 'required'];
}
