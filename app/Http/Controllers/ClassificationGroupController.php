<?php

namespace App\Http\Controllers;

use App\Models\ClassificationGroup;

class ClassificationGroupController extends Controller
{
    protected $model = ClassificationGroup::class;
    protected $rules = [
        'name' => 'required',
        'code' => 'required'
    ];
}