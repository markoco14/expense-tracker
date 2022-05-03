<?php

namespace App\Services;

use App\Models\UserDeduction;

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
        $savings = UserDeduction::where('user_id', auth()->user()->id)
            ->where('deduction_name', 'savings')
            ->pluck('deduction_amount');
        return $savings;
    }


}