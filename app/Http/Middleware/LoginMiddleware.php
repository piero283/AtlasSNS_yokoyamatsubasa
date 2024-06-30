<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth; //追記
use Closure;

class LoginMiddleware
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
        $currentPath = $request->path();
        $openPaths = ['login', 'register', 'added', 'logout'];
        if (!in_array($currentPath, $openPaths) && !Auth::check()) {
            return redirect('login');
        }
        return $next($request);
    }

}
