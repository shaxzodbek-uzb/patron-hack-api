<?php

namespace App\Http\Controllers;

use App\Models\OrganizationalStructure;

class OrganizationalStructureController extends Controller
{
    protected $model = OrganizationalStructure::class;
    protected $rules = ['name' => 'required', 'parent_id' => 'sometimes'];
    protected $list_attach_relations = ['parent'];

    public function treeView()
    {
        $organizational_structures = OrganizationalStructure::with('children.children.children')->whereNull('parent_id')->get();
        return response()->json(['items' => $organizational_structures]);
    }
}