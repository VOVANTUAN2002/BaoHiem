<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->string('contract');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('description');
            $table->string('contract_package');
            $table->double('total');
            $table->string('unit');
            $table->string('paid_and_unpaid_amount');
            $table->date('insurance_start_date')->nullable();
            $table->date('insurance_open_date_Paid')->nullable();
            $table->date('insurance_start_date_payment')->nullable();
            $table->string('photo_contract')->nullable();
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
        Schema::dropIfExists('insurances');
    }
};
