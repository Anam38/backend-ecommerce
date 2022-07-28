<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductsTable extends Migration
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
          $table->string('name');
          $table->string('category_code_master');
          $table->string('category_code_child');
          $table->string('img');
          $table->bigInteger('weight');
          $table->bigInteger('price');
          $table->bigInteger('stock');
          $table->string('size')->nullable();
          $table->string('variant')->nullable();
          $table->string('is_new')->nullable();
          $table->string('discount')->nullable();
          $table->string('is_popular')->nullable();
          $table->text('description');
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
}
