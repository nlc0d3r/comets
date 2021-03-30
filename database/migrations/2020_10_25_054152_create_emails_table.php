<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uid')->constrained('users');
            $table->enum('status', ['draft', 'sent'])->default('draft');
            $table->enum('format', ['formal', 'casual'])->default('formal');
            $table->enum('type', ['normal', 'survey'])->default('normal');
            $table->enum('priority', ['normal', 'low', 'high'])->default('normal');
            $table->string('subject')->nullable();
            $table->string('to')->nullable();
            $table->text('body')->nullable();
            $table->string('attachment')->nullable();
            $table->string('attachmentname')->nullable();
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
        Schema::dropIfExists('emails');
    }
}
