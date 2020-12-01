<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Teams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->integer('id_pok');
            $table->timestamps();
        });
        Schema::table('teams', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('id_pok')->references('id_pok')->on('pokedex');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
