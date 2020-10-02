<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsTableOrderRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_request_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('price')->nullable()->after('borrowed_amount');
            $table->dateTime('warranty')->nullable()->after('price');
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
            $table->dropColumn('price');
            $table->dropColumn('warranty');
        });
    }
}
