<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uid')->constrained('users');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        DB::table('surveys')->insert([
            ['uid' =>'1', 'title' => 'Technology-based communication', 'description' => '<p>This is a survey for my P.h.D. thesis research, it is anonymous and will be used only for the research purposes. The aim of this research is to investigate technology-based communication’s effect on the quality of relationships within the company and which are the factors affecting it and also the effect on motivation and job satisfaction of employees. Thank you for taking your time to answer these questions.</p><p>Best regrds,</p><p>Madara Pauga<br>Vidzeme University of Applied Sciences, Latvia</p>']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surveys');
    }
}
