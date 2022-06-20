<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDeduction;
use App\Services\DeductionCalculatorService;
use Carbon\Carbon;

class DeductionController extends Controller
{
    public function index() {
        $rules = [];
        foreach(request()->input() as $key => $value) {
            if ($key === '_token' || $key === 'submit') {
                continue;
            } else {
                $rules[$key] = 'required';
            }
        }
        $attributes = request()->validate($rules);

        foreach ($attributes as $key => $value) {
            $deduction = new UserDeduction;
            $deduction->user_id = auth()->user()->id;
            $deduction->deduction_name = $key;
            $deduction->deduction_amount = $value;
            $deduction->deduction_status = 'CURRENT';
            $deduction->deduction_type = 'deduction';
            $deduction->month = Carbon::now()->month;
            // dd($deduction);
            $deduction->save();
            // TODO: change the type later (employment, necessities, etc)
        }
        return redirect('profile');
    }

    public function create($userid, $name, $amount) {
        $deduction = new UserDeduction;
            $deduction->user_id = $userid;
            $deduction->deduction_name = $name;
            $deduction->deduction_amount = $amount;
            $deduction->deduction_status = 'CURRENT';
            $deduction->deduction_type = 'deduction';
            $deduction->month = Carbon::now()->month;
            $deduction->save();
        return ["status" => 201];
    }

    public function getAll($userid) {
        $deductionsCollection = UserDeduction::where('user_id', $userid)
        ->where('deduction_status', 'CURRENT')
        ->get();
        $deductions = $deductionsCollection->toArray();
        return json_encode($deductions);
    }
    
    public function getUpdatedDeduction($userid, $name) {
        $deduction = UserDeduction::where('user_id', $userid)
        ->where('deduction_name', $name)
        ->where('deduction_status', 'CURRENT')
        ->get();
        return json_encode($deduction);
    }

    public function update($userid, $deduction, $amount, $original) {
        UserDeduction::where('user_id', $userid)
        ->where('deduction_name', $original)
        ->where('deduction_status', 'CURRENT')
        ->update(['deduction_name' => $deduction, 'deduction_amount' => $amount]);
        return [
            'user_id' => $userid, 
            'deduction' => $deduction, 
            'amount' => $amount,
            'original' => $original
        ];
    }

    public function delete($userid, $deduction) {
        UserDeduction::where('user_id', $userid)
        ->where('id', $deduction)
        ->where('deduction_status', 'CURRENT')
        ->update(['deduction_status' => 'OOD']);
    }
}
