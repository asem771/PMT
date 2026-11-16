<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowedLanguages = ['ar', 'en'];

        if ($request->has('lang')) {
            $language = $request->query('lang');

            if (in_array($language, $allowedLanguages, true)) {
                Session::put('locale', $language);
            }
        }

        $locale = Session::get('locale', config('app.locale', 'ar'));

        if (!in_array($locale, $allowedLanguages, true)) {
            $locale = 'ar';
        }

        App::setLocale($locale);

        return $next($request);
    }
}
