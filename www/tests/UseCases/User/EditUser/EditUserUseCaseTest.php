<?php

use App\Repositories\Implementations\UserRepository;
use App\UseCases\User\EditUser\EditUserDTO;
use App\UseCases\User\EditUser\EditUserUseCase;
use PHPUnit\Framework\TestCase;

class EditUserUseCaseTest extends TestCase
{
    private $userRepository;
    private $editUserDTO;

    public function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->editUserDTO    = $this->createMock(EditUserDTO::class);

        $this->editUserDTO->method('username')->willReturn('new_username');
    }

    /**
     * @test
     */
    public function shouldEditUser()
    {
        $this->userRepository->method('update')->willReturn(true);
        $this->userRepository->method('findById')->willReturn(['username' => 'new_username']);

        $editUserUseCase = new EditUserUseCase($this->userRepository);

        $user = $editUserUseCase->execute($this->editUserDTO, 1);

        $this->assertEquals(['username' => 'new_username'], $user);
        $this->assertArrayHasKey('username', $user);
        $this->assertIsArray($user);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenUserNotUpdated()
    {
        $this->userRepository->method('update')->willReturn(false);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Sorry, we could not update the user.');

        $editUserUseCase = new EditUserUseCase($this->userRepository);

        $editUserUseCase->execute($this->editUserDTO, 1);
    }
}
