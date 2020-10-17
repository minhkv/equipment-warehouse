<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupplierFieldsTableRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_request_infos', function (Blueprint $table) {
            $table->string('supplier_name')->nullable()->after('template_id');
            $table->unsignedBigInteger('supplier_id')->nullable()->after('supplier_name');
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
        Schema::table('order_request_infos', function (Blueprint $table) {
            $table->dropForeign('order_request_infos_supplier_id_foreign');
            $table->dropColumn('supplier_name');
            $table->dropColumn('supplier_id');
        });
    }
}
