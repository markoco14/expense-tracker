<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDeduction;
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

    public function delete($userid, $deduction) {
        UserDeduction::where('user_id', $userid)
        ->where('deduction_name', $deduction)
        ->where('deduction_status', 'CURRENT')
        ->update(['deduction_status' => 'OOD']);
    }
}
