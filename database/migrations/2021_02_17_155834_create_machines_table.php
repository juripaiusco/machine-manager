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

            $table->char('cod', 14);

            $table->char('year', 14);
            $table->char('number', 14);
            $table->char('author', 255);
            $table->char('name', 255);
            $table->char('n_confirm', 255);
            $table->char('quantity', 255);
            $table->timestamp('date_machine');
            $table->char('customer', 255);
            $table->longText('note');
            $table->longText('json');

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
