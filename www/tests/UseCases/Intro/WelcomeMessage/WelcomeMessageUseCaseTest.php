<?php

use App\UseCases\Intro\WelcomeMessage\WelcomeMessageUseCase;
use PHPUnit\Framework\TestCase;

class WelcomeMessageUseCaseTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnWelcomeMessage()
    {
        $userCase = new WelcomeMessageUseCase();

        $expected = [
            'author'  => 'Eric Neves <github.com/ericneves>',
            'message' => 'Welcome to the api! 🦆',
        ];

        $this->assertEquals($expected, $userCase->execute());
        $this->assertIsArray($userCase->execute());
        $this->assertArrayHasKey('author', $userCase->execute());
    }
}
