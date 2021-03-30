<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Cache;
use Illuminate\Http\Request;

use App\Models\User;

class LastUserActivity
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{
		if ( Auth::check() ) {
			// $expiresAt = date("Y-m-d H:i:s", strtotime( '+15 minutes' ) ); // keep online for 1 min
			Cache::put('isUserOnline-' . Auth::user()->id, true, 600 );

			$User = User::find( Auth::user()->id );
			$User->last_seen_at = date("Y-m-d H:i:s");
			$User->save();
		}
		return $next($request);
	}
}
