<?php

namespace App\Commands\Tokens;

use App\Commands\Command;
use JetBrains\PhpStorm\NoReturn;
use OwenVoke\POAP\Client;
use function Termwind\render;

class ShowCommand extends Command
{
    /** {@inheritdoc} */
    protected $signature = 'tokens:show {id : The id of the token}';

    /** {@inheritdoc} */
    protected $description = 'Display the details for a token';

    #[NoReturn]
    public function handle(Client $client): void
    {
        $response = $client->token()->show(
            $this->argument('id')
        );

        if (isset($response['statusCode'])) {
            $this->showError($response['message'] ?? $response['error'] ?? 'An unknown error occurred');

            exit(static::FAILURE);
        }

        render(view('tokens.show', ['token' => $response]));
    }
}
