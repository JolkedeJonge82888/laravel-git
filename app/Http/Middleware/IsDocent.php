<?php
namespace App\Http\Middleware;
use Closure;
class IsDocent
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
        if(auth()->user()->isDocent()) {
            return $next($request);
        }
        return redirect('home');
    }
}
