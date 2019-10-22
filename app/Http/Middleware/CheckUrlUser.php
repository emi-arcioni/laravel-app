<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class CheckUrlUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $source = '')
    {

        $params = $request->route()->parameters();
        $loggedUser = Auth::user();
        if (!empty($params['user_id'])) {
            if ($params['user_id'] != $loggedUser->id){
                if ($source == 'web') {
                    return redirect('/');
                } else if ($source == 'api') {
                    abort(403);
                }
            }
        }

        return $next($request);
    }
}
