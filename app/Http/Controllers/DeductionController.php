<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDeduction;

class DeductionController extends Controller
{
    public function delete($userid, $deduction) {
        UserDeduction::where('user_id', $userid)
        ->where('deduction_name', $deduction)
        ->where('deduction_status', 'CURRENT')
        ->update(['deduction_status' => 'OOD']);
    }
}
