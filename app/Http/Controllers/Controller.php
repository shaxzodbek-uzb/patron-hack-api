<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $model;
    protected $list_attach_relations = [];
    protected $rules = [];
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $query = $this->model::query();
        $items = $query->with($this->list_attach_relations)->orderBy('id')->get();

        // json response
        return response()->json(['items' => $items]);
    }

    public function store(Request $request)
    {
        $query = $this->model::query();
        $validData = $this->validate($request, $this->rules);

        $item = $query->create($validData);

        // json response
        return response()->json(['item' => $item->load($this->list_attach_relations)]);
    }
    public function update(Request $request, $id)
    {
        $query = $this->model::query();
        $validData = $this->validate($request, $this->rules);

        $item = $query->findOrFail($id);
        $item->update($validData);

        // json response
        return response()->json(['item' => $item->load($this->list_attach_relations)]);
    }
    //show
    public function show($id)
    {
        $query = $this->model::query();
        $item = $query->findOrFail($id);

        // json response
        return response()->json(['item' => $item->load($this->list_attach_relations)]);
    }
    // destroy
    public function destroy($id)
    {
        $query = $this->model::query();
        $item = $query->findOrFail($id);
        $item->delete();

        // json response
        return response()->json(['success' => true]);
    }

    function uploadFile($file)
    {
        $new_name = rand() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('files'), $new_name);
        $file_path = 'files/' . $new_name;
        return $file_path;
    }
}