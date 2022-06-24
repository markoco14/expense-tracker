<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSalaryNameToUserSalaries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_salaries', function (Blueprint $table) {
            $table->addColumn('text', 'salary_name')
            ->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_salaries', function (Blueprint $table) {
            $table->dropColumn('salary_name');
        });
    }
}
