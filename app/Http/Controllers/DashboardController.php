<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Meeting;
use App\Models\Survey;
use App\Models\Answer;
use App\Models\Email;
use App\Models\Mood;
use App\Models\User;

use Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Meetings = Meeting::where('uid', Auth::user()->id )->orWhere('participants', 'LIKE', '%'. Auth::user()->email .'%' )->orderby('begins', 'ASC')->paginate(20);
        $Surveys = Survey::where('uid', Auth::user()->id )->paginate(5);
        $Emails = Email::where('uid', Auth::user()->id )->paginate(5);

        $yesterday = date("Y-m-d", strtotime( '-1 days' ) );
        $MoodYesterday = Mood::whereDate('date', $yesterday )->get();
        $Mood = Mood::where('date', date('Y-m-d'))->get();

        $Answers = Answer::select( 
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
        )->get();
        $AnswersCount = Answer::count();
        
        $comparison = $this->moodComparison( $MoodYesterday, $Mood );
        $moodOfDay = $this->moodOfDay( $Mood );

        return view('pages.dashboard')
            ->with('Meetings', $Meetings )
            ->with('Surveys', $Surveys )
            ->with('Answers', $Answers )
            ->with('AnswersCount', $AnswersCount )
            ->with('Emails', $Emails )
            ->with('Mood', $this->moodOfDay( $Mood ) )
            ->with('Comparison', $comparison)
            ->with('moodGraph', $this->moodGraph( 10 ) )
            ->with('answersGraph', $this->answersGraph( $Answers ) );
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

    public function moodOfDay( $Mood )
    {

        $LOW = 30;
        $MID = 70;
        $moodPoints = 0;
        $moodCount = 0;

        foreach ( $Mood as $M ) {
            $moodPoints = $moodPoints + $M->points;
            $moodCount++;
        }

        if( $moodPoints > 0 ) {
            $moodSum = $moodPoints / $moodCount;
            $percent = round( $moodPoints * 100 / ( $moodCount * 100 ) );

            if( $moodSum < $LOW ) {
                $color = 'danger';
            } else if( $moodSum < $MID ) {
                $color = 'warning';
            } else {
                $color = 'success';
            }
        } else {
            $moodSum = false;
            $percent = false;
            $color = false;
        }

        return (object) [
            'points' => $moodPoints,
            'count' => $moodCount,
            'sum' => $moodSum,
            'percent' => $percent,
            'color' => $color,
            'lvlLow' => $LOW,
            'lvlMid' => $MID,
        ];
    }

    public function moodComparison( $yesterday, $today )
    {
        $today = $this->moodOfDay( $today );
        $yesterday = $this->moodOfDay( $yesterday );

        $todayPerc = $today->percent;
        $yesterdayPerc = $yesterday->percent;

        if( $todayPerc >= $yesterdayPerc )
        {   
            $cmp = $todayPerc - $yesterdayPerc;
            $comp = (object) [ 'status' => 'up', 'comp' => $cmp ];
        } else {
            $cmp = $yesterdayPerc - $todayPerc;
            $comp = (object) [ 'status' => 'down', 'comp' => $cmp ];
        }

        return $comp;
    }

    public function moodGraph( $days = 10 )
    {
    	$labels = Mood::select('date')->groupBy('date')->orderBy('date', 'DESC')->limit(10)->get();
    	$data = Mood::select( DB::raw( 'SUM(`points`) / COUNT(`points`) as p' ) )->groupBy('date')->orderBy('date', 'DESC')->limit(10)->get();

    	$labelArr = [];
    	foreach ( $labels as $key => $value ) {
    		$labelArr[] = substr( $value->date, -2, 2 );
     	}


     	$dataArr = [];
    	foreach ( $data as $key => $value ) {
    		$dataArr[] = round( $value->p );
     	}

     	return json_encode( [ 'labels' => array_reverse( $labelArr ), 'series' => [ array_reverse( $dataArr ) ] ] );

    }

    public function answersGraph( $Answers )
    {
        $Fields = [ 'REC', 'WRK', 'ADV', 'GTH', 'GFO', 'MIS', 'SMG', 'SPV', 'CWR', 'SAL', 'BEN', 'VAL', 'SAT', 'TRN' ];
        $data = [];

        foreach ( $Fields as $F ) {
            $data[] = round( $Answers[0]->$F, 2);
        }

        return json_encode( [ 'labels' => $Fields, 'series' => [ $data ] ] );
    }

    public function answers()
    {
        $Answers = Answer::all();

        // dd( $Answers );

        return $Answers;
    }
}
