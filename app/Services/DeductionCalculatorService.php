<?php

namespace App\Services;

use App\Models\UserBudget;
use App\Models\UserDeduction;
use App\Models\UserSaving;

class DeductionCalculatorService
{

    public function getLabourInsurance() {
        $labourInsurance = UserDeduction::where('user_id', auth()->user()->id)
                ->where('deduction_name', 'li')
                ->pluck('deduction_amount');

        if ($labourInsurance->isNotEmpty()){
            $labourInsurance = $labourInsurance->toArray()[0];
        } else {
            $labourInsurance = 0;
        }
        
        return $labourInsurance;
    } 

    public function getNationalHealthInsruance() {
        $nationalHealthInsurance = UserDeduction::where('user_id', auth()->user()->id)
        ->where('deduction_name', 'nhi')
        ->pluck('deduction_amount');
        
        if ($nationalHealthInsurance->isNotEmpty()) {
            $nationalHealthInsurance = $nationalHealthInsurance->toArray()[0];
        } else {
            $nationalHealthInsurance = 0;
        }

        return $nationalHealthInsurance;
    }

    public function getRent() {
        $rent = UserDeduction::where('user_id', auth()->user()->id)
            ->where('deduction_name', 'rent')
            ->pluck('deduction_amount');

            if ($rent->isNotEmpty()) {
                $rent = $rent->toArray()[0];
            } else {
                $rent = 0;
            }
        return $rent;
    }

    public function getUtilities() {
        $utilities = UserDeduction::where('user_id', auth()->user()->id)
            ->where('deduction_name', 'utilities')
            ->pluck('deduction_amount');
            if ($utilities->isNotEmpty()) {
                $utilities = $utilities->toArray()[0];
            } else {
                $utilities = 0;
            }
            
        return $utilities;
    }

    public function getDeductions() {
        $deductionsCollection = UserDeduction::where('user_id', auth()->user()->id)
        ->where('deduction_status', 'CURRENT')
        ->get();
        // $deductions = [];
        // foreach ($deductionsCollection as $key => $value) {
        //     $deductions[$key] = $value;
        // }
        $deductions = $deductionsCollection->toArray();
        // dd($deductions);
        return $deductions;

    }

    public function getSavings() {
        $savings = UserSaving::where('user_id', auth()->user()->id)
            ->where('savings_status', 'CURRENT')
            ->pluck('savings_amount');
            if ($savings->isNotEmpty()) {
                $savings = $savings->toArray()[0];
            } else {
                $savings = 0;
            }
            
        return $savings;
    }
    public function getDailyBudget() {
        $budget = UserBudget::where('user_id', auth()->user()->id)
            ->where('budget_status', 'CURRENT')
            ->pluck('budget_amount');

            if ($budget->isNotEmpty()) {
                $budget = $budget->toArray()[0];
            } else {
                $budget = 0;
            }
        return $budget;
    }


}