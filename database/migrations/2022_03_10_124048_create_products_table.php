<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('subsubcategory_id');
            $table->string('product_name_en');
            $table->string('product_name_ban');
            $table->string('product_slug_en');
            $table->string('product_slug-ban');
            $table->string('product_code');
            $table->string('product_qty');
            $table->string('product_tag_en');
            $table->string('product_tag_ban');
            $table->string('product_size_en')->nullable();
            $table->string('product_size_ban')->nullable();
            $table->string('product_color_en');
            $table->string('product_color_ban');
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->string('short_des_en');
            $table->string('short_des_ban');
            $table->string('long_des_en')->nullable();
            $table->string('long_des_ban')->nullable();
            $table->string('product_thumbnail');
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('products');
    }
};
