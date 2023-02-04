<?php

namespace App\Providers;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\ServiceProvider;
use OwenVoke\POAP\Client;
use Symfony\Component\Console\Output\OutputInterface;
use function Termwind\renderUsing;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        renderUsing($this->app->make(OutputInterface::class));

        $this->app->bind(Client::class, function ($app) {
            /** @var Repository $config */
            $config = $app->make(Repository::class);

            $client = new Client();

            $client->authenticate(
                $config->get('services.poap.token'),
                null,
                Client::AUTH_ACCESS_TOKEN
            );

            return $client;
        });
    }
}
