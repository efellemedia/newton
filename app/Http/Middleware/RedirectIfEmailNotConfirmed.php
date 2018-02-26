<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfEmailNotConfirmed
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
        if (! $request->user()->confirmed) {
            // User has not confirmed their email, log them out and redirect them back
            auth()->logout();
            
            return redirect('/login')
                ->with([
                    'flash' => [
                        'level'   => 'warning',
                        'message' => 'You must first confirm your email address.'
                    ]
                ]);
        }
        
        return $next($request);
    }
}
