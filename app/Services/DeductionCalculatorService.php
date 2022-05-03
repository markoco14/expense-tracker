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
        return $rent;
    }

    public function getUtilities() {
        $utilities = UserDeduction::where('user_id', auth()->user()->id)
            ->where('deduction_name', 'utilities')
            ->pluck('deduction_amount');
        return $utilities;
    }

    public function getSavings() {
        $savings = UserSaving::where('user_id', auth()->user()->id)
            ->where('savings_status', 'CURRENT')
            ->pluck('savings_amount');
        return $savings;
    }
    public function getDailyBudget() {
        $budget = UserBudget::where('user_id', auth()->user()->id)
            ->where('budget_status', 'CURRENT')
            ->pluck('budget_amount');
        return $budget;
    }


}