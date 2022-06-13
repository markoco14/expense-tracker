<?php

namespace App\Http\Controllers;

use App\Models\UserSaving;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    public function delete($userid) {
        // return 'You have landed in the delete saving api endpoint';
        UserSaving::where('user_id', $userid)
        ->where('savings_status', 'CURRENT')
        ->update(['savings_status' => 'OOD']);
    }
}
