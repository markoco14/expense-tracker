<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_deductions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('deduction_name');
            $table->string('deduction_type');
            $table->string('deduction_status');
            $table->integer('deduction_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_deductions');
    }
}
