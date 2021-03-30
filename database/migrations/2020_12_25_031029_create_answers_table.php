<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sid')->constrained('surveys');
            $table->string('user');
            $table->integer('REC_1');
            $table->integer('REC_2');
            $table->integer('REC_3');
            $table->integer('REC_4');
            $table->integer('REC_5');

            $table->integer('WRK_1');
            $table->integer('WRK_2');
            $table->integer('WRK_3');
            $table->integer('WRK_4');

            $table->integer('ADV_1');
            $table->integer('ADV_2');
            $table->integer('ADV_3');
            $table->integer('ADV_4');

            $table->integer('GTH_1');
            $table->integer('GTH_2');
            $table->integer('GTH_3');
            $table->integer('GTH_4');
            $table->integer('GTH_5');

            $table->integer('GFO_1');
            $table->integer('GFO_2');
            $table->integer('GFO_3');
            $table->integer('GFO_4');
            $table->integer('GFO_5');

            $table->integer('MIS_1');
            $table->integer('MIS_2');
            $table->integer('MIS_3');
            $table->integer('MIS_4');
            $table->integer('MIS_5');
            $table->integer('MIS_6');

            $table->integer('SMG_1');
            $table->integer('SMG_2');
            $table->integer('SMG_3');

            $table->integer('SPV_1');
            $table->integer('SPV_2');
            $table->integer('SPV_3');
            $table->integer('SPV_4');
            $table->integer('SPV_5');
            $table->integer('SPV_6');
            $table->integer('SPV_7');
            $table->integer('SPV_8');
            $table->integer('SPV_9');
            $table->integer('SPV_10');
            $table->integer('SPV_11');
            $table->integer('SPV_12');
            $table->integer('SPV_13');
            $table->integer('SPV_14');
            $table->integer('SPV_15');

            $table->integer('CWR_1');
            $table->integer('CWR_2');
            $table->integer('CWR_3');
            $table->integer('CWR_4');
            $table->integer('CWR_5');
            $table->integer('CWR_6');
            $table->integer('CWR_7');
            $table->integer('CWR_8');

            $table->integer('SAL_1');
            $table->integer('SAL_2');
            $table->integer('SAL_3');
            $table->integer('SAL_4');

            $table->integer('BEN_1');
            $table->integer('BEN_2');
            $table->integer('BEN_3');
            $table->integer('BEN_4');

            $table->integer('VAL_1');
            $table->integer('VAL_2');
            $table->integer('VAL_3');

            $table->integer('SAT_1');
            $table->integer('SAT_2');
            $table->integer('SAT_3');

            $table->integer('TRN_1');
            $table->integer('TRN_2');
            $table->integer('TRN_3');
            $table->integer('TRN_4');

            $table->double('REC_MID');
            $table->double('WRK_MID');
            $table->double('ADV_MID');
            $table->double('GTH_MID');
            $table->double('GFO_MID');
            $table->double('MIS_MID');
            $table->double('SMG_MID');
            $table->double('SPV_MID');
            $table->double('CWR_MID');
            $table->double('SAL_MID');
            $table->double('BEN_MID');
            $table->double('VAL_MID');
            $table->double('SAT_MID');
            $table->double('TRN_MID');
            
            $table->double('SATISFACTION');
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
        Schema::dropIfExists('answers');
    }
}
