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
        Schema::table('bills', function (Blueprint $table) {
           $table->integer('requestID');
           $table->integer('companyID');
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('billID');
            $table->integer('projectID');
            $table->dateTime('payDate');
            $table->float('sumVal');
            $table->integer('statusID');
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
        Schema::table('bills', function (Blueprint $table) {
           $table->removeColumn('requestID');
           $table->removeColumn('companyID');
        });

        Schema::dropIfExists('payments');
    }
};
