<?php

namespace App\UseCases\Intro\WelcomeMessage;

use App\UseCases\Intro\WelcomeMessage\WelcomeMessageController;
use App\UseCases\Intro\WelcomeMessage\WelcomeMessageUseCase;

class WelcomeMessageFactory
{
    public function generateInstance(): WelcomeMessageController
    {
        $welcomeMessageUseCase    = new WelcomeMessageUseCase();
        $welcomeMessageController = new WelcomeMessageController($welcomeMessageUseCase);

        return $welcomeMessageController;
    }
}
