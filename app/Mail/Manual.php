<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

use App\Models\Email;
use Auth;

class Manual extends Mailable
{
    use Queueable, SerializesModels;

    public $EmailID;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($EmailID)
    {
        $this->EmailID = $EmailID;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $Email = Email::find( $this->EmailID );

        if( !empty( $Email->attachment ) )
        {
	        return $this
	        	// ->from( ['address' => Auth::user()->email, 'name' => Auth::user()->name .' '. Auth::user()->surname ] )
	            ->subject( $Email->subject )
	            ->attach( Storage::path( 'public/'. $Email->attachment ), ['as' => $Email->attachmentname ])
	            ->markdown('emails.manual')
	            ->with('Email', $Email)
	            ->with('User', Auth::user());
        } else {
	        return $this
	            ->subject( $Email->subject )
	            ->markdown('emails.manual')
	            ->with('Email', $Email)
	            ->with('User', Auth::user());
        }
    }
}
