<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Surveys;
use App\Models\Questions;
use App\Models\Answer;

use App\Exports\AnswersExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\DB;

class SurveysAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Users = User::paginate(20);

        // $Users = User::leftJoin('answers', 'users.id', '=', 'answers.uid')
        //     ->select('answers.uid','answers.created_at')
        //     ->orderBy('answers.created_at', 'DESC')
        //     ->paginate(20);

        return view('pages.Admin.Surveys')
            ->with( 'Users', $Users );
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public static function hasAnsvers( $user )
    {
        return Answer::where( 'user', $user )->count();
    }

    public static function getLastSurveyDate( $user )
    {
        $Answer = Answer::select('created_at')->where( 'user', $user )->orderBy('created_at', 'DESC')->first();
        if( isset( $Answer->created_at ) )
        {
            return $Answer->created_at->format('Y.m.d H:i');
        } else {
            return false;
        }
    }

    public function getAnswers( Request $request )
    {
        $user = User::find( $request->user );
        $fileName = $request->user .'.xlsx';
        return Excel::download( new AnswersExport( $request->user ), $fileName );
    }

    public static function answerDataSum( $user )
    {

        return Answer::select( 
            DB::raw("AVG(REC_MID) AS REC"),
            DB::raw("AVG(WRK_MID) AS WRK"),
            DB::raw("AVG(ADV_MID) AS ADV"),
            DB::raw("AVG(GTH_MID) AS GTH"),
            DB::raw("AVG(GFO_MID) AS GFO"),
            DB::raw("AVG(MIS_MID) AS MIS"),
            DB::raw("AVG(SMG_MID) AS SMG"),
            DB::raw("AVG(SPV_MID) AS SPV"),
            DB::raw("AVG(CWR_MID) AS CWR"),
            DB::raw("AVG(SAL_MID) AS SAL"),
            DB::raw("AVG(BEN_MID) AS BEN"),
            DB::raw("AVG(VAL_MID) AS VAL"),
            DB::raw("AVG(SAT_MID) AS SAT"),
            DB::raw("AVG(TRN_MID) AS TRN"),
            DB::raw("AVG(SATISFACTION) AS SATISFACTION"),
        )->where( 'user', $user )->get();

    }

    public function csv( $csv )
    {
        $file = fopen( 'php://output', 'w' );
        foreach ($csv as $key => $value) {
            fputcsv( $file, $value, ',', '"' );
        }
        fclose( $file );
    }
}
