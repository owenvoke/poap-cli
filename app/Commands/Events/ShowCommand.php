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
        $event = $client->event()->show(
            $this->argument('id')
        );

        if (isset($event['statusCode'])) {
            $this->showError($event['message'] ?? $event['error'] ?? 'An unknown error occurred');

            exit(static::FAILURE);
        }

        render(view('events.show', ['event' => $event]));
    }
}
