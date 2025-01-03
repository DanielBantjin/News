<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Ambil locale dari session atau gunakan default dari config
        $locale = Session::get('locale', config('app.locale'));

        // Validasi jika locale yang didapat adalah string dan sesuai dengan bahasa yang didukung
        if (!in_array($locale, ['en', 'id'])) {
            $locale = config('app.locale');  // Jika tidak valid, kembalikan ke locale default
        }

        App::setLocale($locale);

        return $next($request);
    }
}
