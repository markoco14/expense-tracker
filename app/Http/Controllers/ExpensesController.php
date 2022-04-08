<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Client\Request;

// use Illuminate\Support\Facades\DB;

// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Routing\Controller as BaseController;

class ExpensesController extends Controller
{
    public function index() {
        return view('tracking');
    }

    public function store() {

        $attributes = request()->validate([
            'amount' => ['required'],
            'what' => ['required'],
            'where' => ['required'],
            // 'username' => 'Markoco14'
        ]);

        // dd($attributes['amount'], $attributes['what'], $attributes['where']);

        $expense = new Expense;
        $expense->amount = $attributes['amount'];
        $expense->what = $attributes['what'];
        $expense->where = $attributes['where'];
        $expense->username = auth()->user()->username;

        $expense->save();
        // dd($expense);

        // Expense::create($attributes);
        // DB::table('expenses')->insert([
        //     'username'=>'Markoco14',
        //     'amount'=>$attributes['amount'],
        //     'what'=>$attributes['what'],
        //     'where'=>$attributes['where'],
        // ]);

        session()->flash('success', 'Your data has been stored.');

        return redirect('tracking');
        // dd('You sent some data.');
    }
}
