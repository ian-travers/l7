<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->can('admin')) {
            return $next($request);
        }

        return redirect(route('root'))->with('flash', json_encode([
            'type' => 'warning',
            'title' => __('flash.warning'),
            'message' => __('flash.not-enough-rights'),
        ]));
    }
}
