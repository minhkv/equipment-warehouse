<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeyForComboInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('combo_info', function (Blueprint $table) {
            $table->foreign('template_id')->references('id')->on('equipment_templates')->onDelete('cascade');
            $table->foreign('combo_id')->references('id')->on('combo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('combo_info', function (Blueprint $table) {
            $table->dropForeign('combo_info_template_id_foreign');
            $table->dropForeign('combo_info_combo_id_foreign');            
        });
    }
}
