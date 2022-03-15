<?php

namespace App\Http\Controllers;

use App\Models\BusinessProcess;
use Illuminate\Http\Request;

class BusinessProcessController extends Controller
{
    protected $model = BusinessProcess::class;

    protected $list_attach_relations = ['classification_group'];
    protected $rules = [
        'name' => 'required',
        'payment_detail' => 'required',
        'payment_amount' => 'required',
        'classification_group_id' => 'required',
        'classifications' => 'required|array'
    ];

    public function store(Request $request)
    {
        $query = $this->model::query();
        $validData = $this->validate($request, $this->rules);
        $classifications = $request->get('classifications');

        unset($validData['classifications']);
        $item = $query->create($validData);
        foreach ($classifications as $classification) {
            if ($classification['checked'] ?? false) {
                $item->classifications()->attach($classification['id'], [
                    'date_start' => $classification['date_start'] ?? now(),
                    'date_finish' => $classification['date_finish'] ?? now()->addDay(),
                ]);
            }
        }
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
        return response()->json(['item' => $item->load(['classifications', ...$this->list_attach_relations])]);
    }

    public function completeClassification()
    {
        $validData = $this->validate(request(), [
            'classification_id' => 'required',
            'business_process_id' => 'required',
            'time_rate' => 'required',
            'quality_rate' => 'required',
        ]);
        $business_process = BusinessProcess::findOrFail($validData['business_process_id']);
        $business_process->classifications()->updateExistingPivot($validData['classification_id'], [
            'done' => true,
            'time_rate' => $validData['time_rate'],
            'quality_rate' => $validData['quality_rate'],
        ]);

        // count not done classifications
        $not_done_classifications = $business_process->classifications()->wherePivot('done', false)->count();
        $done = false;
        if (!$not_done_classifications) {
            $done = true;
            $business_process->update(['status' => 'done']);
        }


        return response()->json(['success' => true, 'done' => $done]);
    }
}