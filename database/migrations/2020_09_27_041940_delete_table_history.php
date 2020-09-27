<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteTableHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('borrowed_history');
        Schema::dropIfExists('usage_history');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('borrowed_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('equipment_id');
            $table->unsignedInteger('amount')->nullable();
            $table->integer('condition_received');
            $table->string('note')->nullable();
            $table->timestamps();
        });
        Schema::create('usage_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('equipment_id');
            $table->string('condition_received');
            $table->timestamps();
            
        });
    }
}
