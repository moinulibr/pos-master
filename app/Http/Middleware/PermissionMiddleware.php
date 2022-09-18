<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\Permission\Permission;
class PermissionMiddleware
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
        /* dd($data);
        dd($this->callTraitForTest()); */
        /* var_dump($data);
        dd('ses'); */
        return $next($request);
    }
}
