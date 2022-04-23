<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMonthToUserDeductions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_deductions', function (Blueprint $table) {
            $table->addColumn('integer', 'month')->after('deduction_amount');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_deductions', function (Blueprint $table) {
            $table->dropColumn('month');
        });
    }
}
