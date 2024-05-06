<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class CheckRoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routeName = Route::getFacadeRoot()->current()->uri();
        $route = explode('/', $routeName);
        if (auth()->check()) {
            if (auth()->user()->user_role == 'user'){
                return $next($request);
            }else{
              return redirect()->route('admin.index');
            }
        }
        return redirect()->route('admin.login');

    }
}
