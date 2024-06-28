<?php

use App\Repositories\Implementations\UserRepository;
use App\UseCases\User\FetchUser\FetchUserDTO;
use App\UseCases\User\FetchUser\FetchUserUseCase;
use PHPUnit\Framework\TestCase;

class FetchUserUseCaseTest extends TestCase
{
    private $userRepository;
    private $fetchUserDTO;

    public function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->fetchUserDTO   = $this->createMock(FetchUserDTO::class);

        $this->fetchUserDTO->method('toArray')->willReturn([
            'id'       => 1,
            'username' => 'new_username',
            'email'    => 'new_email',
        ]);
    }

    /**
     * @test
     */
    public function shouldReturnUser()
    {
        $this->userRepository->method('findById')->willReturn([
            'id'       => 1,
            'username' => 'new_username',
            'email'    => 'new_email',
        ]);

        $editUserUseCase = new FetchUserUseCase($this->userRepository);

        $user = $editUserUseCase->execute(1);

        $this->assertIsArray($user);
        $this->assertArrayHasKey('id', $user);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenUserNotFound()
    {
        $this->userRepository->method('findById')->willReturn(false);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Sorry, user not found.');

        $editUserUseCase = new FetchUserUseCase($this->userRepository);

        $editUserUseCase->execute(1);
    }
}
