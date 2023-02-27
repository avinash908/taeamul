<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('owner_name')->nullable();
            $table->string('shop_name')->nullable();
            $table->string('shop_number')->nullable();
            $table->string('shop_address')->nullable();
            $table->string('shop_activity')->nullable();
            $table->string('shop_details')->nullable();
            $table->string('shop_email')->nullable();
            $table->string('national_id')->nullable();
            $table->string('national_copy')->nullable();
            $table->string('comercial_reg_copy')->nullable();
            $table->string('comercial_reg_number')->nullable();
            $table->string('shop_district')->nullable();
            $table->string('shop_city')->nullable();
            $table->string('shop_street')->nullable();
            $table->string('shop_mail_box')->nullable();
            $table->string('shop_postal_code')->nullable();
            $table->unsignedBigInteger('current_balance')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
