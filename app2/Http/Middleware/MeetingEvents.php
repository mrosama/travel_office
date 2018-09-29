<?php

namespace App\Http\Middleware;

use Closure;
use App\Meeting_event;
use Redirect;

class MeetingEvents
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request , Closure $next)
    {
        if(Meeting_event::where('meeting_id' , $request->route('id'))->first() != null)
            return Redirect::to("admin/meetings/{$request->route('id')}/edit/event");
        return $next($request);
    }
}
