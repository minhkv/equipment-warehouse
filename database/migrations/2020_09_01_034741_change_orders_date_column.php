<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeOrdersDateColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dateTime('date_approved', 0)->change();
            $table->dateTime('date_output', 0)->change();
            $table->dateTime('date_received', 0)->change();
            $table->dateTime('date_completed', 0)->change();
            $table->dateTime('due_date', 0)->change();
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
            $table->dateTime('date_approved')->nullable()->change();
            $table->dateTime('date_output')->nullable()->change();
            $table->dateTime('date_received')->nullable()->change();
            $table->dateTime('date_completed')->nullable()->change();
            $table->dateTime('due_date')->nullable()->change();
        });
    }
}
