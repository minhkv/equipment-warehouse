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
            $table->string('type');
            $table->unsignedBigInteger('stocker_id');
            $table->unsignedBigInteger('guest_id');
            $table->dateTime('date_created');
            $table->dateTime('date_approved');
            $table->dateTime('date_completed');
            $table->dateTime('due_date');
            $table->string('reason');
            $table->string('status');
            $table->string('comment');
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
