<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Traits\Permission\Permission;

class AuthenticateMiddleware
{
    use Permission;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$data)
    {
        if (Auth::guard()->check()) {
            dd('yes');
            if (Auth::guard()->check()) {
                return $next($request);
            }else{
                return route('login');
            }
        }else{
            dd($data);
            return route('login');
        }
            /* if (Auth::guard('user')->user()->role_id == 0) {
                return redirect()->route('admin.dashboard')->with('unsuccess', "You don't have access to that section");
            }
            if (Auth::guard('user')->user()->role->permissionCheck($data)) {
                return $next($request);
            } else if (!(new Permission)->checkPermissionExist($data)) {

                if($request->ajax())
                {
                    return response(['errors'=>["Error. Permission: $data is not found in database."]], 401);
                }

                return redirect()->route('admin.dashboard')->with('unsuccess', "Error. Permission: $data is not found in database.");
            }
        }
        // header("location: ".route('admin.dashboard'));
        if($request->ajax())
        {
            return response(['errors'=>["You don't have access to that section."]]);
        }
        return redirect()->route('admin.dashboard')->with('unsuccess', "You don't have access to that section.");
 */
        dd($data);
        dd($this->callTraitForTest());
        /* var_dump($data);
        dd('ses'); */
        return $next($request);
    }
}
