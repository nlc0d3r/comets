<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Notification;
use App\Notifications\MeetingAdded;

use App\Models\User;
use App\Models\Meeting;

use Auth;

class MeetingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Users = User::all();
        $Meetings = Meeting::where('uid', Auth::user()->id )->orWhere('participants', 'LIKE', '%'. Auth::user()->email .'%' )->orderby('begins', 'ASC')->paginate(20);

        return view('pages.meetings')
            ->with('Users', $Users)
            ->with('Meetings', $Meetings );
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

        $Meeting = New Meeting();
        $Meeting->uid = Auth::user()->id;
        $Meeting->subject = $request->subject;
        $Meeting->begins = $request->begins;
        $Meeting->ends = $request->ends;
        $Meeting->link = $request->link;
        $Meeting->participants = $request->participants;
        $Meeting->description = $request->description;
        $Meeting->save();

        $MeetingID = $Meeting->id;

        Notification::send( $this->getUserId( $request->participants ), new MeetingAdded( $MeetingID ) );

        return redirect()->route( 'meetings.show', $MeetingID );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Users = User::all();
        $Meeting = Meeting::find( $id );

        return view('pages.meetings-show')
            ->with('Users', $Users)
            ->with( 'Meeting', $Meeting );
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
        $Meeting = Meeting::find($id);
        $Meeting->uid = Auth::user()->id;
        $Meeting->subject = $request->subject;
        $Meeting->begins = $request->begins;
        $Meeting->ends = $request->ends;
        $Meeting->link = $request->link;
        $Meeting->participants = $request->participants;
        $Meeting->description = $request->description;
        $Meeting->save();

        $MeetingID = $Meeting->id;

        Notification::send( $this->getUserId( $request->participants ), new MeetingAdded( $MeetingID ) );
        
        return redirect()->route( 'meetings.show', $MeetingID );
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

    private function getUserId( $participants )
    {
        $participants = explode( ',', $participants );

        $users = [];
        foreach ( $participants as $value ) {
            $getID = User::select('id as id')->where( 'email', $value )->get();
            $users[] = $getID[0]->id;
        }

        return User::findMany( $users );
    }
}
