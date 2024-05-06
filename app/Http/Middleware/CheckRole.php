<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckRole
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
            if (auth()->user()->user_role == 'admin'){
                return $next($request);
            }else{
              return redirect()->route('users.dashboard');
            }
        }
        return redirect()->route('admin.login');

    }
}
