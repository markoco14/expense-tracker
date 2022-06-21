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

    public function getAll($userid) {
        $salary = UserSalary::where('user_id', $userid)
        ->where('salary_status', 'CURRENT')
        ->get();
        return json_encode($salary);
    }

    public function create($userid, $name, $amount) {
        // return ['response' => 'You landed in the create function of the salary controller'];
        $salary = new UserSalary;
        $salary->user_id = $userid;
        $salary->salary_name = $name;
        $salary->salary_amount = $amount;
        $salary->salary_status = 'CURRENT';
        $salary->job_category = 'NULL';
        $salary->job_title = 'NULL';
        $salary->month = Carbon::now()->month;
        $salary->save();
        return ['status' => 201];
    }

    public function update($userid, $id, $name, $amount) {
        UserSalary::where('user_id', $userid)
        ->where('id', $id)
        ->update(['salary_name' => $name, 'salary_amount' => $amount]);
        return ['success' => 201];
    }

    public function getUpdatedSalary($userid, $name) {
        $salary = UserSalary::where('user_id', $userid)
        ->where('salary_status', 'CURRENT')
        ->get();
        return json_encode($salary);
    }

    // update with salary param later
    public function delete($user_id, $salary_id) {
        UserSalary::where('user_id', $user_id)
        ->where('id', $salary_id)
        ->update(['salary_status' => 'OOD']);
    }
}