<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeTableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('long_term')->default(false);
            $table->string('guest_name');
            $table->string('department');
            $table->dateTime('date_borrowed')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('date_return')->nullable();
            $table->unsignedBigInteger('guest_id')->nullable()->change();
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
            $table->dropColumn('long_term');
            $table->dropColumn('guest_name');
            $table->dropColumn('department');
            $table->dropColumn('date_borrowed');
            $table->dropColumn('date_return');
            $table->unsignedBigInteger('guest_id')->change();
        });
    }
}
