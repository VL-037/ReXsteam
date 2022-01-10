<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description_short');
            $table->string('description_long');
            $table->foreignId('category_id')->constrained('categories')->onUpdate('cascade')->onDelete('cascade');;
            $table->string('developer');
            $table->string('publisher');
            $table->integer('price');
            $table->string('cover');
            $table->string('trailer');
            $table->boolean('onlyAdult');
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
        Schema::dropIfExists('games');
    }
}
