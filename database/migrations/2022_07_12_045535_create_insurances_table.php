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
            $table->double('amount_of_money');
            $table->double('total');
            $table->string('paid');
            $table->string('unpaid_amount');
            $table->string('insurance_start_date');
            $table->string('insurance_start_date_payment');
            $table->string('photo_contract');
            $table->string('photo_CMND');
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
