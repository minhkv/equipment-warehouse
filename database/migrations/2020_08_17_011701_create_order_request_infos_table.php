<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderRequestInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_request_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('template_id');
            $table->unsignedInteger('amount');
            $table->unsignedInteger('borrowed_amount')->default(0);
            $table->timestamps();
        });
        Schema::table('order_request_infos', function(Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('template_id')->references('id')->on('equipment_templates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_request_infos', function (Blueprint $table) {
            $table->dropForeign('order_info_order_id_foreign');
            $table->dropForeign('order_info_template_id_foreign');
        });
        Schema::dropIfExists('order_request_infos');
    }
}
