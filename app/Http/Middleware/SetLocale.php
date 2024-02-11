<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $settings = Auth::user()?->settings;

        if ($settings) {
            $locale = $settings->language ?? config('app.locale');
        } else {
            $locale = $request->getPreferredLanguage(config('app.available_locales'));

            $acceptedLanguages = $request->server('HTTP_ACCEPT_LANGUAGE');

            $preferredLanguages = explode(',', $acceptedLanguages);
            
            $locale = $preferredLanguages[0] ?? config('app.locale');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
