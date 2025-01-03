<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = Session::get('locale', config('app.locale')); // Default ke locale di config/app.php
        App::setLocale($locale);

        return $next($request);
    }
}
