<?php

namespace App\Exports;

use App\Models\Answer;
use App\Models\User;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;

use Illuminate\Support\Facades\DB;

class AnswersExport implements FromArray
{
	protected $user;

	function __construct( $user ) {
	    $this->user = $user;
	}

	public function array(): array
    {
		$Answers 	= Answer::select( DB::raw('DATE_FORMAT(created_at, "%m/%d/%Y %H:%i:%s") as Timestamp'), 'REC_1', 'REC_2', 'REC_3', 'REC_4', 'REC_5', 'WRK_1', 'WRK_2', 'WRK_3', 'WRK_4', 'ADV_1', 'ADV_2', 'ADV_3', 'ADV_4', 'GTH_1', 'GTH_2', 'GTH_3', 'GTH_4', 'GTH_5', 'GFO_1', 'GFO_2', 'GFO_3', 'GFO_4', 'GFO_5', 'MIS_1', 'MIS_2', 'MIS_3', 'MIS_4', 'MIS_5', 'MIS_6', 'SMG_1', 'SMG_2', 'SMG_3', 'SPV_1', 'SPV_2', 'SPV_3', 'SPV_4', 'SPV_5', 'SPV_6', 'SPV_7', 'SPV_8', 'SPV_9', 'SPV_10', 'SPV_11', 'SPV_12', 'SPV_13', 'SPV_14', 'SPV_15', 'CWR_1', 'CWR_2', 'CWR_3', 'CWR_4', 'CWR_5', 'CWR_6', 'CWR_7', 'CWR_8', 'SAL_1', 'SAL_2', 'SAL_3', 'SAL_4', 'BEN_1', 'BEN_2', 'BEN_3', 'BEN_4', 'VAL_1', 'VAL_2', 'VAL_3', 'SAT_1', 'SAT_2', 'SAT_3', 'TRN_1', 'TRN_2', 'TRN_3', 'TRN_4', 'SATISFACTION' )->where( 'user', $this->user )->get();
		$titles 	= array_keys( $Answers[0]->toArray() );
		// $titles[]	= 'What is your name? (not required)';
		// $titles[]	= 'GENDER';
		// $titles[]	= 'AGE';
		// $titles[]	= 'COUNTRY';
		// $titles[]	= 'RESIDENCE  COUNTRY';
		// $titles[]	= 'NATIONALITY';
		// $titles[]	= 'What is your job title?';
		// $titles[]	= 'What is your highest qualification?';
		// $titles[]	= 'GRS';
		$data 		= $Answers->toArray();

		// $count = 0; 
		// foreach ($data as $key => $value) {
		// 	$data[$count]['What is your name? (not required)']	= 'Anonymous';
		// 	$data[$count]['GENDER']	= 'Anonymous';
		// 	$data[$count]['AGE'] = '20';
		// 	$data[$count]['COUNTRY'] = 'Anonymous';
		// 	$data[$count]['RESIDENCE  COUNTRY']	= 'Anonymous';
		// 	$data[$count]['NATIONALITY'] = 'Anonymous';
		// 	$data[$count]['What is your job title?'] = 'Anonymous';
		// 	$data[$count]['What is your highest qualification?'] = 'Anonymous';
		// 	$data[$count]['GRS'] = '1-5';
		// 	$count++;
		// }

		$final = array_merge( [$titles], $data );

		return $final;
    }
}
