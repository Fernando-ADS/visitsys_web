<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
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
        /*
        $user = auth()->user();

        if($user->tipo != 'admin'){
          return redirect('/403.blade.php');
        }
        */

        //dd(Auth::User()->tipo);


        if(Auth::check() && Auth::User()->tipo!='admin'){
          abort('403');
        }

        return $next($request);
    }
}
