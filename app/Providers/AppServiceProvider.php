<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use OwenVoke\POAP\Client;
use Symfony\Component\Console\Output\OutputInterface;
use function Termwind\renderUsing;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        renderUsing($this->app->make(OutputInterface::class));

        $this->app->bind(Client::class, function ($app) {
            $apiToken = Cache::remember(config('poap.api_key_cache_id'), now()->addHours(12), function () {
                $response = Http::asJson()->post(sprintf('%s/oauth/token', config('services.poap.auth_url')), [
                    'audience' => config('services.poap.audience'),
                    'client_id' => config('services.poap.client_id'),
                    'client_secret' => config('services.poap.client_secret'),
                    'grant_type' => 'client_credentials',
                ]);

                throw_unless(
                    $response->ok(),
                    'Failed to authenticate with the POAP Auth0 API, please check your credentials'
                );

                throw_unless(
                    isset($response['access_token'], $response['expires_in']) && $response['access_token'] !== null,
                    'Invalid Bearer token returned from the Auth0 API'
                );

                return $response['access_token'];
            });

            return tap(new Client())->authenticate($apiToken, null, Client::AUTH_ACCESS_TOKEN);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
