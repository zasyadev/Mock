<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('employees') ) {
            Schema::create('employees', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('first_name', 50);
                $table->string('last_name', 50);
                $table->unsignedBigInteger('company_id');
                $table->foreign('company_id')->references('id')->on('companies');
                $table->string('email');
                $table->string('phone');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
