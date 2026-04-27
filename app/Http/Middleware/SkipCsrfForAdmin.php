<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SkipCsrfForAdmin
{
    protected $except = [
        'admin/login',
        'admin/logout',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        foreach ($this->except as $pattern) {
            if ($request->is($pattern)) {
                return $next($request);
            }
        }
        
        return $next($request);
    }
}