<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

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
        Model::unguard();
        
        Response::macro('api', function(int $statusCode = 200, string $message = 'Success', $data = null){
            return response()->json([
                'status_code' => $statusCode,
                'message' => $message,
                'data' => $data,
            ], $statusCode);
        });
    }
}
