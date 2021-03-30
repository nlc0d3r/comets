<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mood;
use Lang;
use Auth;

class MoodController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
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

		switch ( $request->m ) {
			case 'negative':
				$points = 0;
				break;
			case 'neutral':
				$points = 50;
				break;
            case 'positive':
                $points = 100;
                break;
		}

		$Mood = new Mood();
		$Mood->pid = Auth::user()->parentid;
		$Mood->uid = Auth::user()->id;
		$Mood->mood = $request->m;
		$Mood->points = $points;
		$Mood->date = date('Y-m-d');
		$Mood->save();

		return back()
			->with( 'msg', true )
			->with( 'msgtxt', Lang::get('app.moodpu-wasset') )
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
}
