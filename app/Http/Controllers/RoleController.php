<?php

namespace App\Http\Controllers;

use App\Models\Role;

class RoleController extends Controller
{
    protected $model = Role::class;
    protected $rules = ['name' => 'required'];
}