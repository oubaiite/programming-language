<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LangSwitcher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*app()->setLocale("ar");
        if(isset($request->lang)&&$request->lang=="en")
            app()->setLocale("en");
        return $next($request);
        */
        /*$locale = $request->header('Accept-Language', 'en');
        $supportedLanguages = ['ar', 'en'];
        if (in_array($locale, $supportedLanguages)) {
            App::setLocale($locale);
        } else {
            App::setLocale('en');
        }*/
        $locale = $request->header('Accept-Language', $request->query('lang', 'en'));
        if (!in_array($locale, ['en', 'ar'])) {
            $locale = 'en';
        }
        App::setLocale($locale);
        session()->put('locale', $locale);
        return $next($request);
    }
}
