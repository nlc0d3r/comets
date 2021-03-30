<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Survey;
use App\Models\Question;
use App\Models\Answer;
use Lang;
use Auth;

class SurveysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Surveys = Survey::all();
        $Answers = Answer::where('user', hash( 'SHA256', Auth::user()->id ) )->paginate(10);

        return view('pages.surveys')
            ->with('Surveys', $Surveys)
            ->with('Answers', $Answers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $Answers = new Answer();
        $Answers->sid = $request->_sid;
        $Answers->user = hash( 'SHA256', Auth::user()->id );
        $Answers->REC_1 = $request->REC_1;
        $Answers->REC_2 = $request->REC_2;
        $Answers->REC_3 = $request->REC_3;
        $Answers->REC_4 = $request->REC_4;
        $Answers->REC_5 = $request->REC_5;

        $Answers->WRK_1 = $request->WRK_1;
        $Answers->WRK_2 = $request->WRK_2;
        $Answers->WRK_3 = $request->WRK_3;
        $Answers->WRK_4 = $request->WRK_4;

        $Answers->ADV_1 = $request->ADV_1;
        $Answers->ADV_2 = $request->ADV_2;
        $Answers->ADV_3 = $request->ADV_3;
        $Answers->ADV_4 = $request->ADV_4;

        $Answers->GTH_1 = $request->GTH_1;
        $Answers->GTH_2 = $request->GTH_2;
        $Answers->GTH_3 = $request->GTH_3;
        $Answers->GTH_4 = $request->GTH_4;
        $Answers->GTH_5 = $request->GTH_5;

        $Answers->GFO_1 = $request->GFO_1;
        $Answers->GFO_2 = $request->GFO_2;
        $Answers->GFO_3 = $request->GFO_3;
        $Answers->GFO_4 = $request->GFO_4;
        $Answers->GFO_5 = $request->GFO_5;

        $Answers->MIS_1 = $request->MIS_1;
        $Answers->MIS_2 = $request->MIS_2;
        $Answers->MIS_3 = $request->MIS_3;
        $Answers->MIS_4 = $request->MIS_4;
        $Answers->MIS_5 = $request->MIS_5;
        $Answers->MIS_6 = $request->MIS_6;

        $Answers->SMG_1 = $request->SMG_1;
        $Answers->SMG_2 = $request->SMG_2;
        $Answers->SMG_3 = $request->SMG_3;

        $Answers->SPV_1 = $request->SPV_1;
        $Answers->SPV_2 = $request->SPV_2;
        $Answers->SPV_3 = $request->SPV_3;
        $Answers->SPV_4 = $request->SPV_4;
        $Answers->SPV_5 = $request->SPV_5;
        $Answers->SPV_6 = $request->SPV_6;
        $Answers->SPV_7 = $request->SPV_7;
        $Answers->SPV_8 = $request->SPV_8;
        $Answers->SPV_9 = $request->SPV_9;
        $Answers->SPV_10 = $request->SPV_10;
        $Answers->SPV_11 = $request->SPV_11;
        $Answers->SPV_12 = $request->SPV_12;
        $Answers->SPV_13 = $request->SPV_13;
        $Answers->SPV_14 = $request->SPV_14;
        $Answers->SPV_15 = $request->SPV_15;

        $Answers->CWR_1 = $request->CWR_1;
        $Answers->CWR_2 = $request->CWR_2;
        $Answers->CWR_3 = $request->CWR_3;
        $Answers->CWR_4 = $request->CWR_4;
        $Answers->CWR_5 = $request->CWR_5;
        $Answers->CWR_6 = $request->CWR_6;
        $Answers->CWR_7 = $request->CWR_7;
        $Answers->CWR_8 = $request->CWR_8;

        $Answers->SAL_1 = $request->SAL_1;
        $Answers->SAL_2 = $request->SAL_2;
        $Answers->SAL_3 = $request->SAL_3;
        $Answers->SAL_4 = $request->SAL_4;

        $Answers->BEN_1 = $request->BEN_1;
        $Answers->BEN_2 = $request->BEN_2;
        $Answers->BEN_3 = $request->BEN_3;
        $Answers->BEN_4 = $request->BEN_4;

        $Answers->VAL_1 = $request->VAL_1;
        $Answers->VAL_2 = $request->VAL_2;
        $Answers->VAL_3 = $request->VAL_3;

        $Answers->SAT_1 = $request->SAT_1;
        $Answers->SAT_2 = $request->SAT_2;
        $Answers->SAT_3 = $request->SAT_3;

        $Answers->TRN_1 = $request->TRN_1;
        $Answers->TRN_2 = $request->TRN_2;
        $Answers->TRN_3 = $request->TRN_3;
        $Answers->TRN_4 = $request->TRN_4;

        $Answers->REC_MID = ( $request->REC_1 + $request->REC_2 + $request->REC_3 + $request->REC_4 + $request->REC_5 ) / 5;
        $Answers->WRK_MID = ( $request->WRK_1 + $request->WRK_2 + $request->WRK_3 + $request->WRK_4 ) / 4;
        $Answers->ADV_MID = ( $request->ADV_1 + $request->ADV_2 + $request->ADV_3 + $request->ADV_4 ) / 4;
        $Answers->GTH_MID = ( $request->GTH_1 + $request->GTH_2 + $request->GTH_3 + $request->GTH_4 + $request->GTH_5 ) / 5;
        $Answers->GFO_MID = ( $request->GFO_1 + $request->GFO_2 + $request->GFO_3 + $request->GFO_4 + $request->GFO_5 ) / 5;
        $Answers->MIS_MID = ( $request->MIS_1 + $request->MIS_2 + $request->MIS_3 + $request->MIS_4 + $request->MIS_5 + $request->MIS_6 ) / 6;
        $Answers->SMG_MID = ( $request->SMG_1 + $request->SMG_2 + $request->SMG_3 ) / 3;
        $Answers->SPV_MID = ( $request->SPV_1 + $request->SPV_2 + $request->SPV_3 + $request->SPV_4 + $request->SPV_5 + $request->SPV_6 + $request->SPV_7 + $request->SPV_8 + $request->SPV_9 + $request->SPV_10 + $request->SPV_11 + $request->SPV_12 + $request->SPV_13 + $request->SPV_14 + $request->SPV_15 ) / 15;
        $Answers->CWR_MID = ( $request->CWR_1 + $request->CWR_2 + $request->CWR_3 + $request->CWR_4 + $request->CWR_5 + $request->CWR_6 + $request->CWR_7 + $request->CWR_8 ) / 8;
        $Answers->SAL_MID = ( $request->SAL_1 + $request->SAL_2 + $request->SAL_3 + $request->SAL_4 ) / 4;
        $Answers->BEN_MID = ( $request->BEN_1 + $request->BEN_2 + $request->BEN_3 + $request->BEN_4 ) / 4;
        $Answers->VAL_MID = ( $request->VAL_1 + $request->VAL_2 + $request->VAL_3 ) / 3;
        $Answers->SAT_MID = ( $request->SAT_1 + $request->SAT_2 + $request->SAT_3 ) / 3;
        $Answers->TRN_MID = ( $request->TRN_1 + $request->TRN_2 + $request->TRN_3 + $request->TRN_4 ) / 4;

        $Answers->SATISFACTION = array_sum( $request->except( [ '_sid', '_token' ] ) ) / 73;
        $Answers->save();

        return redirect()->route( 'surveys' )
            ->with( 'msg', true )
            ->with( 'msgtxt', Lang::get('app.srv_done') )
            ->with( 'msgtype', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Survey = Survey::find($id);
        $Questions = Question::where('sid', $id)->get();

        return view('pages.surveys-show')
            ->with('Survey', $Survey)
            ->with('Questions', $Questions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public static function getSurveyTitle( $sid )
    {
        $Survey = Survey::find( $sid );

        return $Survey->title;
    }
}
