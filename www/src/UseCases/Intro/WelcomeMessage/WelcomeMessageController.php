<?php

namespace App\UseCases\Intro\WelcomeMessage;

use App\Http\Request;
use App\Http\Response;

class WelcomeMessageController
{
    public function __construct(private IWelcomeMessageUseCase $welcomeMessageUseCase)
    {
    }

    public function handle(Request $request, Response $response): Response
    {
        return $response->json($this->welcomeMessageUseCase->execute());
    }
}
