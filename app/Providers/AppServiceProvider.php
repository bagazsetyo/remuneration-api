<?php

namespace App\Providers;

use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('responseSuccess', function ($data, $message = 'OK') {
            return response()->json([
                'code' => 200,
                'data' => $data,
                'message' => $message,
            ], 200);
        });

        Response::macro('responseMessage', function ($message, $code = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR) {
            return response()->json([
                'code' => $code,
                'message' => $message,
            ], $code);
        });
    }
}
