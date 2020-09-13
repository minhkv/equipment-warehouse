<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('template_id');
            $table->string('price')->nullable();
            $table->unsignedBigInteger('supplier_id')->default('1');
            $table->string('size')->nullable();
            $table->string('location')->nullable();
            $table->integer('status')->default(1); // 0: losing, 1: available, 2: working
            $table->integer('condition');
            $table->text('note')->nullable();
            $table->dateTime('input_date')->nullable();
            $table->dateTime('warranty')->nullable();
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
        Schema::dropIfExists('equipments');
    }
}
