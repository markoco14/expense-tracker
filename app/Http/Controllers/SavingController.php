<?php

namespace App\Http\Controllers;

use App\Models\UserSaving;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    public function index() {
        // dd('You hit the savings endpoint');
        $attributes = request()->validate([
            'savings' => ['required']
        ]);

        // dd($attributes);

        $saving = new UserSaving;
        $saving->user_id = auth()->user()->id;
        $saving->savings_name = 'monthly';
        $saving->savings_status = 'CURRENT';
        $saving->savings_amount = $attributes['savings'];
        // dd($saving);
        // $saving->month = Carbon::now()->month;
        // dd($saving);
        $saving->save();

        return redirect('profile');

    }

    public function delete($userid) {
        // return 'You have landed in the delete saving api endpoint';
        UserSaving::where('user_id', $userid)
        ->where('savings_status', 'CURRENT')
        ->update(['savings_status' => 'OOD']);
    }
}
