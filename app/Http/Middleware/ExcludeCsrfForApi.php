<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExcludeCsrfForApi
{
    protected $except = [
        'admin/login',
        'admin/logout',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        foreach ($this->except as $route) {
            if ($request->is($route) || $request->is($route.'/*')) {
                config(['session.http_only' => false]);
                config(['session.secure' => false]);
            }
        }
        return $next($request);
    }
}