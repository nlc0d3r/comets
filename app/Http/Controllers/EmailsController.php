<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

use App\Models\Email;
use App\Models\User;

use App\Mail\Manual;

use Auth;

class EmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Users = User::all();
        $Emails = Email::where('uid', Auth::user()->id )->paginate(10);

        return view('pages.emails')
            ->with('Users', $Users)
            ->with('Emails', $Emails);
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
        $specialChars = array(' ', '\r', '\n', '\r');

        $Email = New Email();
        $Email->uid = Auth::user()->id;
        $Email->status = ( isset( $request->sendMail ) ) ? 'sent' : 'draft';
        $Email->format = $request->format;
        $Email->priority = $request->priority;
        $Email->subject = $request->subject;
        $Email->to = json_encode( explode( ',', str_replace( $specialChars, '', $request->to ) ) );
        $Email->body = $request->body;
        $Email->save();

        $EmailID = $Email->id;

        // Upload attachment file
        $this->fileUpload( $EmailID, $request );

        // Send e-mail
        if( isset( $request->sendMail ) )
        {
            $this->send( $EmailID );
        }

        return redirect()->route( 'emails.show', $EmailID );
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
        $Email = Email::find( $id );

        //Storage::size( '/var/www/devpage/storage/app/public/attachments/1hbmIXeQRIWNS5ibhDajPdBinyeY28pPKSlOtta1.jpeg' );

        return view('pages.emails-show')
            ->with( 'Users', $Users )
            ->with( 'Email', $Email );
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
        $specialChars = array(' ', '\r', '\n', '\r');

        $Email = Email::find( $id );
        $Email->uid = Auth::user()->id;
        $Email->status = ( isset( $request->sendMail ) ) ? 'sent' : 'draft';
        $Email->format = $request->format;
        $Email->priority = $request->priority;
        $Email->subject = $request->subject;
        $Email->to = json_encode( explode( ',', str_replace( $specialChars, '', $request->to ) ) );
        $Email->body = $request->body;
        $Email->save();

        $EmailID = $Email->id;

        // Upload attachment file
        $this->fileUpload( $EmailID, $request );

        // Send e-mail
        if( isset( $request->sendMail ) )
        {
            $this->send( $EmailID );
        }

        return redirect()->route( 'emails.show', $EmailID );
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

    public function send( $id )
    {
        $Email = Email::find( $id );
        $to = json_decode( $Email->to );

        Mail::to( $to )->send( new Manual($id) );
        return redirect()->route( 'emails.show', $id );
    }

    public function fileUpload( $id, Request $request ){
        if( !empty( $request->attachment ) )
        {
            $Email = Email::find( $id );

            if( !empty( $Email->attachment ) )
            {
                $file = storage_path() . '/app/public/'. $Email->attachment;
                $rmfile = unlink( $file );
            }

            $path = $request->attachment->store( 'public/attachments' );

            $Email->attachment = ltrim( $path , '/public/' );
            $Email->attachmentname = $request->attachment->getClientOriginalName();
            $Email->save();
        }
    }

    public static function showToEmails( $emails ){
        return implode( ', ', json_decode( $emails ) );
    }
}
