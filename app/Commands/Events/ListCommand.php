<?php

namespace App\Commands\Events;

use App\Commands\Command;
use JetBrains\PhpStorm\NoReturn;
use OwenVoke\POAP\Client;
use function Termwind\render;

class ListCommand extends Command
{
    /** {@inheritdoc} */
    protected $signature = 'events:list {name? : The name of the event}
                                        {--limit=25 : The number of events to display}
                                        {--expired : Show expired events}
                                        {--editable : Show editable events}
                                        {--private : Show private events}';

    /** {@inheritdoc} */
    protected $description = 'Display a list of events';

    #[NoReturn]
    public function handle(Client $client): void
    {
        $response = $client->event()->all([
            $this->option('expired'),
            $this->option('editable'),
            $this->option('private'),
        ]);

        if (isset($response['statusCode'])) {
            $this->showError($response['message'] ?? $response['error'] ?? 'An unknown error occurred');

            exit(static::FAILURE);
        }

        $offset = (int) $this->option('limit') ?: 25;

        if ($offset > count($response)) {
            $offset = count($response);
        }

        array_splice($response, $offset);

        render(view('events.list', ['events' => $response]));
    }
}
