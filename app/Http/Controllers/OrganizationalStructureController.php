<?php

namespace App\Http\Controllers;

use App\Models\OrganizationalStructure;
use Illuminate\Http\Request;

class OrganizationalStructureController extends Controller
{
    protected $model = OrganizationalStructure::class;
    protected $rules = ['name' => 'required', 'parent_id' => 'sometimes', 'classification_group_ids' => 'array'];
    protected $list_attach_relations = ['parent', 'classification_groups'];

    public function store(Request $request)
    {
        $query = $this->model::query();
        $validData = $this->validate($request, $this->rules);
        $classification_group_ids = $validData['classification_group_ids'] ?? [];
        unset($validData['classification_group_ids']);
        $item = $query->create($validData);
        $item->classification_groups()->sync($classification_group_ids);

        // json response
        return response()->json(['item' => $item->load($this->list_attach_relations)]);
    }
    public function update(Request $request, $id)
    {
        $query = $this->model::query();
        $validData = $this->validate($request, $this->rules);
        $classification_group_ids = $validData['classification_group_ids'] ?? [];
        unset($validData['classification_group_ids']);
        $item = $query->findOrFail($id);
        $item->update($validData);
        $item->classification_groups()->sync($classification_group_ids);

        // json response
        return response()->json(['item' => $item->load($this->list_attach_relations)]);
    }
    public function treeView()
    {
        $organizational_structures = OrganizationalStructure::with('children.children.children', 'employee_positions.employees', 'children.employee_positions.employees', 'children.children.employee_positions.employees')->whereNull('parent_id')->get();
        return response()->json(['items' => $organizational_structures]);
    }
}