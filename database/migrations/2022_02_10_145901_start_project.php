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
        //  статусы
        Schema::create('statuses', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('type')->comment('1 - проект, 2 - товар в счете, 3 - заявка');
            $table->timestamps();
        });

        // счета
        Schema::create('bills', function(Blueprint $table) {
            $table->id();
            $table->integer('projectID');
            $table->string('name');
            $table->timestamps();
        });

        // позиции в счете
        Schema::create('billGoods', function(Blueprint $table) {
            $table->id();
            $table->integer('goodID');
            $table->integer('billID');
            $table->integer('value');
            $table->dateTime('date');
            $table->text('comment');
            $table->integer('managerID');
            $table->integer('statusID');
            $table->dateTime('deliveryPlan');
            $table->dateTime('deliveryFact');
            $table->timestamps();
        });

        // проекты
        Schema::create('projects', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('comment');
            $table->integer('statusID');
            $table->integer('authorID');
            $table->timestamps();
        });

        // заявки
        Schema::create('requests', function(Blueprint $table) {
            $table->id();
            $table->integer('projectID');
            $table->string('name');
            $table->timestamps();
        });

        // позиции в заявки
        Schema::create('requestGoods', function(Blueprint $table) {
            $table->id();
            $table->integer('goodID');
            $table->integer('requestID');
            $table->integer('value');
            $table->dateTime('date');
            $table->text('comment');
            $table->integer('managerID');
            $table->integer('statusID');
            $table->dateTime('deliveryPlan');
            $table->dateTime('deliveryFact');
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
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('bills');
        Schema::dropIfExists('billGoods');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('requests');
        Schema::dropIfExists('requestGoods');
    }
};
