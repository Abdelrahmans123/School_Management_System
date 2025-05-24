<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        if ($request->expectsJson() || $request->header('X-Livewire')) {
            abort(403, 'Unauthorized');
        }

        return route('selection'); // Redirect to the selection page

        // Redirect to the selection page if the user is not authenticated
        // and the request does not expect a JSON response.
    }
}
