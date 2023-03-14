<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('shop_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('subcategory_id')->unsigned()->nullable();
            $table->integer('childcategory_id')->unsigned()->nullable();
            $table->string('sku');
            $table->string('slug');
            $table->string('name');
            $table->integer('price');
            $table->integer('old_price')->nullable();
            $table->integer('stock');
            $table->text('short_description');
            $table->longText('description');
            $table->text('attributes')->nullable();
            $table->text('thumbnail')->nullable();
            $table->boolean('status')->default(1);
            $table->enum('condition',['new','used'])->nullable();
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_bestSeller')->default(0);
            $table->boolean('is_topRated')->default(0);
            $table->boolean('is_bestDeals')->default(0);
            $table->boolean('is_hot')->default(0);
            $table->boolean('is_new')->default(0);
            $table->boolean('is_trending')->default(0);
            $table->boolean('is_sale')->default(0);
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
        Schema::dropIfExists('products');
    }
}
