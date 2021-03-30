<?php

namespace App\Helper;

use Cache;

use App\Models\User;
use App\Models\Mood;

use Lang;

class Core
{
	public function Mood( $uid )
	{
		$Mood = Mood::select('uid')->where([
		[ 'uid', '=', $uid ],
		[ 'date', '=', date('Y-m-d') ]
		])->get();

		if ( $Mood->isEmpty() )
		{
			return false;
		} else {
			return true;
		}
	}

	public function userCard( $id )
	{
		$U = User::find( $id );

		$show = ( $U->id > 0 ) ? true : false;
		$online = ( Cache::has('isUserOnline-' . $id ) ) ? true : false;

		return (object) [
			'show' => $show,
			'name' => $U->name,
			'surname' => $U->surname,
			'online' => $online,
			'mail' => $U->email,
			'avatar' => $U->avatar,
			'group' => $U->group,
			'lastSeen' => $this->lastSeen( $U->last_seen_at->format('U') ),
		];
	}

	public function lastSeen($dateTime)
	{

	    $time 	= time() - $dateTime;
	    $time 	= ($time<1)? 1 : $time;
	    $tokens = array (
	        31536000 => 'app.year',
	        2592000 => 'app.month',
	        604800 => 'app.week',
	        86400 => 'app.day',
	        3600 => 'app.hour',
	        60 => 'app.minute',
	        1 => 'app.second'
	    );

	    foreach ($tokens as $unit => $text)
	    {
	        if ( $time < $unit ) continue;
	        $numberOfUnits = floor($time / $unit);
	        return $numberOfUnits .' '. trans_choice( $text, $numberOfUnits );
	    }
	}
}

?>