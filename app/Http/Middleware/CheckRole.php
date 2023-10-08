<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    public function handle($request, Closure $next, ...$positions)
    {
        if ($request->user() && ! in_array($request->user()->position ,$positions)) {
            return redirect('/welcome')->with('error', 'No tienes permiso para acceder a esta ruta.');
        }

        return $next($request);
    }
}
