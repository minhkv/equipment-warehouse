<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsTableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('supplier_name')->nullable()->after('guest_id');
            $table->unsignedBigInteger('supplier_id')->nullable()->after('supplier_name');
            $table->dateTime('date_input')->nullable()->after('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('supplier_name');
            $table->dropColumn('supplier_id');
            $table->dropColumn('date_input');
        });
    }
}
