<?php

use App\Repositories\Implementations\UserRepository;
use App\UseCases\User\RegisterUser\RegisterUserDTO;
use App\UseCases\User\RegisterUser\RegisterUserUseCase;
use App\Utils\IPasswordUtils;
use PHPUnit\Framework\TestCase;

class RegisterUserUseCaseTest extends TestCase
{
    private $passwordUtils;
    private $userRepository;
    private $registerUserDTO;

    public function setUp(): void
    {
        $this->passwordUtils   = $this->createMock(IPasswordUtils::class);
        $this->userRepository  = $this->createMock(UserRepository::class);
        $this->registerUserDTO = $this->createMock(RegisterUserDTO::class);
    }

    /**
     * @test
     */
    public function shouldRegisterUser()
    {
        $this->passwordUtils->method('generatePasswordHash')->willReturn('hashed_password');

        $this->userRepository->method('save')->willReturn(true);

        $registerUserUseCase = new RegisterUserUseCase($this->passwordUtils, $this->userRepository);

        $message = $registerUserUseCase->execute($this->registerUserDTO);

        $this->assertEquals('User created successfully!', $message);
        $this->assertIsString($message);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenUserNotCreated()
    {
        $this->passwordUtils->method('generatePasswordHash')->willReturn('hashed_password');

        $this->userRepository->method('save')->willReturn(false);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Sorry, we couldn't create your account. Try again later.");

        $registerUserUseCase = new RegisterUserUseCase($this->passwordUtils, $this->userRepository);

        $registerUserUseCase->execute($this->registerUserDTO);
    }
}
