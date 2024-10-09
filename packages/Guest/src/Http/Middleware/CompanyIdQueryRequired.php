<?php

namespace Guest\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompanyIdQueryRequired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->get('company_id') == '') {
            return back();
        }

        return $next($request);
    }
}
