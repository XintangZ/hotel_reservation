<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Weather
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'q' => 'Montreal', 
            'units' => 'metric',
            'appid' => env('OPENWEATHERMAP_API_KEY'),
        ]);

        if ($response->successful()) {
            $weather = $response->json();
            session()->put('weather', $weather);
        } else {
            \Log::error('Failed to fetch weather information: ' . $response->status());
        }
        return $next($request);
    }
}
