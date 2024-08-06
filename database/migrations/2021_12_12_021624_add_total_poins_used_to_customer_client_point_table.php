<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalPoinsUsedToCustomerClientPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_client_point', function (Blueprint $table) {
            //
            $table->bigInteger('total_points_used')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_client_point', function (Blueprint $table) {
            //
            $table->bigInteger('total_points_used')->nullable();
        });
    }
}
