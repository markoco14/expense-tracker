<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSalary;

class SalaryController extends Controller
{
    // update with salary param later
    public function delete($userid) {
        UserSalary::where('user_id', $userid)
        ->where('salary_status', 'CURRENT')
        ->update(['salary_status' => 'OOD']);
    }
}