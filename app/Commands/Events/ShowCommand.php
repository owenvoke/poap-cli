<?php

namespace App\Commands\Events;

use App\Commands\Command;
use JetBrains\PhpStorm\NoReturn;
use OwenVoke\POAP\Client;
use function Termwind\render;

class ShowCommand extends Command
{
    /** {@inheritdoc} */
    protected $signature = 'events:show {id : The id of the event}';

    /** {@inheritdoc} */
    protected $description = 'Display the details for an event';

    #[NoReturn]
    public function handle(Client $client): void
    {
        $response = $client->event()->show(
            $this->argument('id')
        );

        if (isset($response['statusCode'])) {
            $this->showError($response['message'] ?? $response['error'] ?? 'An unknown error occurred');

            exit(static::FAILURE);
        }

        render(view('events.show', ['event' => $response]));
    }
}
