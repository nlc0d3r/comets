<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mood;
use App\Models\Chat;
use App\Models\User;

class AjaxController extends Controller
{

    public function setMood()
    {
        if( isset( $_POST['uid'] ) )
        {
            $uid = $_POST['uid'];
            $output = 0;
            $Mood = Mood::select('uid')->where([
                [ 'uid', '=', $uid ],
                [ 'date', '=', date('Y-m-d') ]
            ])->get();

            if ( !$Mood->isEmpty() )
            {
                $output = $Mood;
            } 
            
            echo json_encode( $output );
        }
    }

    public function getChatMessages(){
        //
    }

    public function postChatMeesage(){
        //
    }
}
