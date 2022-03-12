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
    protected $rules = [];
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $query = $this->model::query();
        $items = $query->get();

        // json response
        return response()->json(['items' => $items]);
    }

    public function store(Request $request)
    {
        $query = $this->model::query();
        $validData = $this->validate($request, $this->rules);

        $item = $query->create($validData);

        // json response
        return response()->json(['item' => $item]);
    }
    public function update(Request $request, $id)
    {
        $query = $this->model::query();
        $validData = $this->validate($request, $this->rules);

        $item = $query->findOrFail($id);
        $item->update($validData);

        // json response
        return response()->json(['item' => $item]);
    }
}