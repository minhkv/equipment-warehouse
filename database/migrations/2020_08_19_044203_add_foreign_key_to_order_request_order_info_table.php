<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToOrderRequestOrderInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_info', function (Blueprint $table) {
            $table->foreign('request_id')->references('id')->on('order_request_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_info', function (Blueprint $table) {
            $table->dropForeign('order_info_request_id_foreign');
        });
    }
}
