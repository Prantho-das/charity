<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role as ModelsRole;

class Role
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
        if(Auth::user()->hasExactRoles('Donor')) {
            return redirect()->to('/');
        }
        if(!Auth::user()->hasAnyRole(['Admin', 'Volunteer'])) {
            return redirect()->to('home/get-role-access');
        }
        return $next($request);
    }
}
