<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uid')->constrained('users');
            $table->enum('status', ['private', 'public', 'ended'])->default('public');
            $table->string('subject')->nullable();
            $table->dateTime('begins')->nullable();
            $table->dateTime('ends')->nullable();
            $table->string('link')->nullable();
            $table->text('participants')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('meetings');
    }
}
