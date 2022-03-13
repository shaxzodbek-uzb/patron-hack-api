<?php

namespace App\Http\Controllers;

use App\Models\Classification;

class ClassificationController extends Controller
{
    protected $model = Classification::class;
    protected $rules = [
        'name' => 'required',
        'code' => 'required',
        'classification_group_id' => 'required'
    ];
}
