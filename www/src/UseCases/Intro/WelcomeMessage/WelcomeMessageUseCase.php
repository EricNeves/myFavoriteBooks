<?php

namespace App\UseCases\Intro\WelcomeMessage;

class WelcomeMessageUseCase implements IWelcomeMessageUseCase
{
    public function execute(): array
    {
        return [
            'author'  => 'Eric Neves <github.com/ericneves>',
            'message' => 'Welcome to the api! 🦆',
        ];
    }
}
