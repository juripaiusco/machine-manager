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
            $table->id();

            $table->char('cod', 14);
            $table->char('name', 255);
            $table->longText('desc')->nullable();
            $table->float('price')->nullable();
            $table->longText('json')->nullable();
            /*$table->char('conn_element_name', 255)->nullable();
            $table->char('conn_element_search_code', 255)->nullable();*/

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
