<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    public function __construct(
        private array $availableLocales = []
    )
    {
        $this->availableLocales = config('app.available_locales', ['en']);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->header('Accept-Language');

        if (!$locale) {
            $locale = config('app.locale', 'en');
        }

        $locale = $this->parseAcceptLanguage($locale);

        if (in_array($locale, $this->availableLocales)) {
            App::setLocale($locale);
        }

        return $next($request);
    }

    private function parseAcceptLanguage(string $header): string
    {
        $locales = explode(',', $header);

        foreach ($locales as $locale) {
            $locale = trim(explode(';', $locale)[0]);
            $locale = strtolower(explode('-', $locale)[0]);

            if (in_array($locale, $this->availableLocales)) {
                return $locale;
            }
        }

        return config('app.locale', 'en');
    }
}
