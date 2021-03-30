<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;

use Auth;

class ChatController extends Controller
{

    public static $EMOJI_SRC = [ ':)', ':(', ':/', ':0', 'XD' ];
    public static $EMOJI_IMG = [ '&#128512', '&#128577', '&#128528', '&#128558', '&#128518' ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( $request->input('uid') > 0 )
        {
            $UID = $request->input('uid');
        } else {
            $UID = 0;
        }

        // SELECT * FROM `chats` WHERE `from` = '1' AND `to` = '3' OR `from` = '3' AND `to` = '1' 

        $Chat = Chat::where([ [ 'from', Auth::user()->id ], [ 'to', $UID ] ])->orwhere([ [ 'from', $UID ], [ 'to', Auth::user()->id ] ])->get();
        $Users = User::where( 'id', '!=', Auth::user()->id )->get();

        $showAllEmojies = $this->showAllEmojies();

        return view('pages.chat')
            ->with('Chat', $Chat )
            ->with('Users', $Users )
            ->with('uid', $UID )
            ->with('showAllEmojies', $showAllEmojies );
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
        $Chat = new Chat();
        $Chat->from = Auth::user()->id;
        $Chat->to = $request->uid;
        $Chat->message = $request->message;
        $Chat->status = 'unread';
        $Chat->datetime = date('Y-m-d H:i:s');
        $Chat->save();

        return redirect()->route( 'chat', [ 'uid' => $request->uid ] );
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

    public static function emoticons( $msg )
    {
        return str_replace( static::$EMOJI_SRC, static::$EMOJI_IMG, $msg );
    }

    public static function showAllEmojies()
    {
        
        $output = '';

        foreach( static::$EMOJI_IMG as $v )
        {
            $output .= '<span class="btn btn-light setEmoji" id="'. $v .'">'. $v .'</span>';
        }

        return $output;
    }
}
