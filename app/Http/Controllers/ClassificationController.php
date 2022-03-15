<?php

namespace App\Http\Controllers;

use App\Models\Classification;

class ClassificationController extends Controller
{
    protected $model = Classification::class;
    protected $rules = [
        'name' => 'required',
        'code' => 'required',
        'classification_group_id' => 'required',
        'min_rate' => 'required',
        'max_rate' => 'required',
        'high_rate' => 'required',
        'low_rate' => 'required',
        'middle_rate' => 'required',
    ];
    protected $list_attach_relations = ['classification_group'];


    public function index()
    {
        $query = $this->model::query()->orderBy('code');
        $items = $query->with($this->list_attach_relations)->orderBy('id');
        if (request()->has('classification_group_id')) {
            $items = $items->where('classification_group_id', request()->get('classification_group_id'));
        }
        $items = $items->get();
        // json response
        return response()->json(['items' => $items]);
    }
}