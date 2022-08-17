<?php

namespace App\Http\Controllers;

use App\Models\UserSaving;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    public function index() {
        $attributes = request()->validate([
            'savings' => ['required']
        ]);
        $saving = new UserSaving;
        $saving->user_id = auth()->user()->id;
        $saving->savings_name = 'monthly';
        $saving->savings_status = 'CURRENT';
        $saving->savings_amount = $attributes['savings'];
        $saving->save();
        return redirect('profile');

    }

    public function getAll() {
        $userId = auth()->user()->id;
        $savingsCollection = UserSaving::where('user_id', $userId)
        ->where('savings_status', 'CURRENT')
        ->get();
        $savings = $savingsCollection->toArray();
        return json_encode($savings);
    }

    public function create($userid, $label, $amount) {
        $saving = new UserSaving;
        $saving->user_id = $userid;
        $saving->savings_name = $label;
        $saving->savings_status = 'CURRENT';
        $saving->savings_amount = $amount;
        $saving->save();
        return [ "status" => 201 ];
    }

    public function update($userid, $new_name, $amount, $old_name) {
        UserSaving::where('user_id', $userid)
        ->where('savings_status', 'CURRENT')
        ->where('savings_name', $old_name)
        ->update(['savings_amount' => $amount]);
        return ['status' => 201];
    }

    public function delete($userid, $saving_id) {
        UserSaving::where('user_id', $userid)
        ->where('id', $saving_id)
        ->update(['savings_status' => 'OOD']);
    }
}
