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
            $table->increments('id');
            $table->timestamps();
            $table->string('player1')->nullable();
            $table->string('player2')->nullable();
            $table->string('api_text')->nullable();
            $table->string('p1_text')->nullable();
            $table->string('p2_text')->nullable();
            $table->integer('p1_completion')->nullable();
            $table->integer('p2_completion')->nullable();
            $table->integer('p1_speed')->nullable();
            $table->integer('p2_speed')->nullable(); 
            $table->integer('time')->nullable();
            $table->boolean('tracking')->nullable();
            $table->boolean('p1_again')->nullable();
            $table->boolean('p2_again')->nullable();
        });

        DB::statement("ALTER TABLE games AUTO_INCREMENT = 10000;");
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
