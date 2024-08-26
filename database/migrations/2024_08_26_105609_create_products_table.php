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
            $table->string('short_name');
            $table->string('name');
            $table->string('product_id');
            $table->string('unit_1')->nullable();
            $table->string('unit_2')->nullable();
            $table->integer('factor_1')->default(0);
            $table->string('unit_3')->nullable();
            $table->integer('factor_2')->default(0);
            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->decimal('declared_price', 10, 2)->nullable();
            $table->decimal('cost_goods_sold', 10, 2)->nullable();
            $table->decimal('list_price', 10, 2)->nullable();
            $table->decimal('specific_cost', 10, 2)->nullable();
            $table->decimal('hapu_price', 10, 2)->nullable();
            $table->date('hapu_price_update_date')->nullable();
            $table->decimal('min_sale_price', 10, 2)->nullable();
            $table->decimal('max_sale_price', 10, 2)->nullable();
            $table->string('quality_registration_number')->nullable();
            $table->string('specification')->nullable();
            $table->string('storage_code')->nullable();
            $table->string('storage_location')->nullable();
            $table->string('position')->nullable();
            $table->string('product_type')->nullable();
            $table->string('classification')->nullable();
            $table->string('product_group')->nullable();
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
