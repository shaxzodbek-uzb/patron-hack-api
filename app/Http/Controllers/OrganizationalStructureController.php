<?php

namespace App\Http\Controllers;

use App\Models\OrganizationalStructure;

class OrganizationalStructureController extends Controller
{
    protected $model = OrganizationalStructure::class;
    protected $rules = ['name' => 'required'];
}