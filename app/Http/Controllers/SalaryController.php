<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSalary;
use Carbon\Carbon;

class SalaryController extends Controller
{
    public function index() {
        $attributes = request()->validate([
            'salary' => ['required']
        ]);
        $salary = new UserSalary;
        $salary->user_id = auth()->user()->id;
        $salary->salary_amount = $attributes['salary'];
        $salary->salary_status = 'CURRENT';
        $salary->job_category = 'NULL';
        $salary->job_title = 'NULL';
        $salary->month = Carbon::now()->month;
        $salary->save();
        return redirect('profile');
    }
    // update with salary param later
    public function delete($userid) {
        UserSalary::where('user_id', $userid)
        ->where('salary_status', 'CURRENT')
        ->update(['salary_status' => 'OOD']);
    }
}