<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mood', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pid')->constrained('users');
            $table->foreignId('uid')->constrained('users');
            $table->enum('mood', ['negative', 'neutral', 'positive'])->default('neutral'); // negative neutral positive
            $table->integer('points');
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mood');
    }
}
