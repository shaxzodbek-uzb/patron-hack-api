<?php

namespace App\Http\Controllers;

use App\Models\BusinessProcess;
use App\Models\Classification;
use App\Models\Rule;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    protected $model = Rule::class;
    protected $rules = ['name' => 'required', 'classification_group_id' => 'required', 'classifications' => 'required|array', 'result' => 'required'];

    public function store(Request $request)
    {
        $query = $this->model::query();
        $validData = $this->validate($request, $this->rules);
        $classifications = [];
        foreach ($validData['classifications'] as $classification) {
            $classifications[] = [
                'id' => $classification['id'],
                'state' => $classification['state']
            ];
        }
        $validData['classifications'] = $classifications;
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
        $classifications = [];
        foreach ($item['classifications'] as $classification) {
            $c = Classification::find($classification['id']);
            $c['state'] = $classification['state'];
            $classifications[] = $c;
        }
        $item['classifications'] = $classifications;
        // json response
        return response()->json(['item' => $item->load($this->list_attach_relations)]);
    }
    public function propersForBusinessProcess($business_process_id)
    {
        // get business process by id
        $business_process = BusinessProcess::find($business_process_id)->load('classifications');
        $classifications_zipped = [];
        foreach ($business_process->classifications as $classification) {
            $rate = ($classification->pivot->time_rate + $classification->pivot->quality_rate) / 2;
            $state = 0;

            if ($rate < $classification->low_rate) {
                $state = -2;
            }
            if ($rate >= $classification->low_rate && $rate < $classification->middle_rate) {
                $state = -1;
            }
            if ($rate > $classification->middle_rate && $rate <= $classification->high_rate) {
                $state = 1;
            }
            if ($rate > $classification->high_rate) {
                $state = 2;
            }
            $classifications_zipped[] = [
                'id' => $classification->id,
                'state' => $state
            ];
        }
        $rules_query = $this->model::where('classification_group_id', $business_process->classification_group_id);
        $rules = $rules_query->get();
        if (count($rules) == 0) {
            return response()->json(['rule' => null]);
        }
        foreach ($rules as $rule) {
            $business_process_result_mini = $this->getKeyByIdList($classifications_zipped);
            $rule_mini = $this->getKeyByIdList($rule->classifications);
            $proper = true;
            foreach ($business_process_result_mini as $id => $state) {
                if ($state != $rule_mini[$id]) {
                    $proper = false;
                    break;
                }
            }
            if ($proper) {
                return response()->json(['rule' => $rule]);
            }
        }

        return response()->json(['rule' => null]);
    }
    public function getKeyByIdList(array $list)
    {
        $result = [];
        foreach ($list as $item) {
            $result[$item['id']] = $item['state'];
        }
        return $result;
    }
}