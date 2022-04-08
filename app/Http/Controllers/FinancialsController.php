<?php

namespace App\Http\Controllers;

use App\Models\UserSalary;
use App\Models\UserDeduction;
use Illuminate\Http\Client\Request;

// use Illuminate\Support\Facades\DB;

// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Routing\Controller as BaseController;

class FinancialsController extends Controller
{
    public function index() {
        return view('profile');
    }

    public function store() {

        // dd('connection to controller established');

        $attributes = request()->validate([
            'salary' => ['required'],
            'li' => ['required'],
            'nhi' => ['required'],
            'rent' => ['required'],
            'utilities' => ['required'],
            'savings' => ['required'],
        ]);

        foreach ($attributes as $key => $value) {
            if ($key === 'salary') {
                $salary = new UserSalary;
                $salary->user_id = auth()->user()->id;
                $salary->salary_amount = $value;
                $salary->salary_status = 'ACTIVE';
                $salary->job_category = 'NULL';
                $salary->job_title = 'NULL';
                // dd($salary);
                $salary->save();
            }
            else {
                $deduction = new UserDeduction;
                $deduction->user_id = auth()->user()->id;
                $deduction->deduction_name = $key;
                $deduction->deduction_amount = $value;
                $deduction->deduction_status = 'ACTIVE';
                $deduction->deduction_type = 'deduction';
                // dd($deduction);
                $deduction->save();
                // TODO: change the type later (employment, necessities, etc)
            }
        }
        


        // store both

        // then return a view



        // dd($attributes['amount'], $attributes['what'], $attributes['where']);

        // $expense = new Expense;
        // $expense->amount = $attributes['amount'];
        // $expense->what = $attributes['what'];
        // $expense->where = $attributes['where'];
        // $expense->username = auth()->user()->username;

        // $expense->save();
        // dd($expense);

        // Expense::create($attributes);
        // DB::table('expenses')->insert([
        //     'username'=>'Markoco14',
        //     'amount'=>$attributes['amount'],
        //     'what'=>$attributes['what'],
        //     'where'=>$attributes['where'],
        // ]);

        // session()->flash('success', 'Your data has been stored.');

        return redirect('profile');
        // dd('You sent some data.');
    }
}
