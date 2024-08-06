<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_gifts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('urbox_id');
            $table->string('cart_detail_id')->nullable();
            $table->string('code_display')->nullable();
            $table->string('code')->nullable();
            $table->text('link')->nullable();
            $table->text('code_image')->nullable();
            $table->text('gift_value')->nullable();
            $table->text('expired')->nullable();
            $table->string('transaction')->nullable();
            $table->string('edition_params')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_gifts');
    }
}