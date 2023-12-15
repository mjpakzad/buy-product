<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Response::macro('success', function ($data = [], $meta = [], $statusCode = 200) {
            $response = [
                'data' => $data,
                'meta' => $meta,
                'server_time' => now(),
            ];
            return Response::json($response, $statusCode);
        });

        Response::macro('error', function ($data = [], $meta = [], $statusCode = 400) {
            $response = [
                'data' => $data,
                'meta' => $meta,
                'server_time' => now(),
            ];
            return Response::json($response, $statusCode);
        });
    }
}
