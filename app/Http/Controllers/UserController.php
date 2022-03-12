<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    protected $model = User::class;
    protected $rules = ['full_name' => 'required'];
}