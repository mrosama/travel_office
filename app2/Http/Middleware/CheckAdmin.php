<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{

  /*   protected $auth;


    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }




    public function handle($request, Closure $next)
    {
      if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
            return redirect()->guest('cp/singin');
            }
        }
        return $next($request);
     }


 */

 public function handle($request, Closure $next, $guard = null)
  {

 


        if (Auth::guard($guard)->guest()) {




          if ($request->ajax()) {
              return response('Unauthorized.', 401);
          } else {


              return redirect()->guest('/');
          }
          //------------------------------------------------



      }

      return $next($request);
  }



}
