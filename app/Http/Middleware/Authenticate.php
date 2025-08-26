<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
   protected function redirectTo($request)
{
    if (! $request->expectsJson()) {
        // Kalau guard admin
        if ($request->is('admin') || $request->is('dashboard') || $request->is('projects*') || $request->is('categories*') || $request->is('progress*')) {
            return route('admin.login');
        }

        // Kalau guard user biasa
        return route('login'); // kalau memang ada route login user
    }
}

}
