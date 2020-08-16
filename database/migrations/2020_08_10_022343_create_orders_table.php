<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->unsignedBigInteger('stocker_id');
            $table->unsignedBigInteger('guest_id');
            $table->dateTime('date_created');
            $table->dateTime('date_approved')->nullable();
            $table->dateTime('date_completed')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->string('reason');
            $table->string('status');
            $table->string('note')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
