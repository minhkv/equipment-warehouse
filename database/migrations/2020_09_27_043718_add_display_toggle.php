<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDisplayToggle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->tinyInteger('display')->default(1);
        });
        Schema::table('equipment_templates', function (Blueprint $table) {
            $table->tinyInteger('display')->default(1);
        });
        Schema::table('equipments', function (Blueprint $table) {
            $table->tinyInteger('display')->default(1);
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
            $table->dropIfExists('display');
        });
        Schema::table('equipment_templates', function (Blueprint $table) {
            $table->dropIfExists('display');
        });
        Schema::table('equipments', function (Blueprint $table) {
            $table->dropIfExists('display');
        });
    }
}
