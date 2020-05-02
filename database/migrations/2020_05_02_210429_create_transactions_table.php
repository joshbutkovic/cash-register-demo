<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('due', 9, 2);
            $table->decimal('provided', 9, 2);
            $table->integer('hundreds')->nullable();
            $table->integer('fifties')->nullable();
            $table->integer('twenties')->nullable();
            $table->integer('fives')->nullable();
            $table->integer('ones')->nullable();
            $table->integer('quarters')->nullable();
            $table->integer('dimes')->nullable();
            $table->integer('nickels')->nullable();
            $table->integer('pennies')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
