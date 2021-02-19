<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();

            $table->char('type', 255)->nullable();
            $table->char('year', 14)->nullable();
            $table->char('number', 14)->nullable();
            $table->char('author', 255)->nullable();
            $table->char('name', 255)->nullable();
            $table->char('n_confirm', 255)->nullable();
            $table->char('quantity', 255)->nullable();
            $table->timestamp('date_machine')->nullable();
            $table->char('customer', 255)->nullable();
            $table->longText('note')->nullable();
            $table->longText('json')->nullable();

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
        Schema::dropIfExists('machines');
    }
}
