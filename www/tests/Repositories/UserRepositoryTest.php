<?php

use App\Providers\Implementations\UserPostgresProvider;
use App\Repositories\Implementations\UserRepository;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    private $userPostgresProvider;

    public function setUp(): void
    {
        $this->userPostgresProvider = $this->createMock(UserPostgresProvider::class);
    }

    /**
     * @test
     */
    public function shouldReturnTrueWhenSaveUser()
    {
        $this->userPostgresProvider->method('create')->willReturn(true);

        $userRepository = new UserRepository($this->userPostgresProvider);

        $this->assertTrue($userRepository->save([]));
    }

    /**
     * @test
     */
    public function shouldReturnFalseWhenNotSaveUser()
    {
        $this->userPostgresProvider->method('create')->willReturn(false);

        $userRepository = new UserRepository($this->userPostgresProvider);

        $this->assertFalse($userRepository->save([]));
    }

    /**
     * @test
     */
    public function shouldReturnUserByEmail()
    {
        $this->userPostgresProvider->method('findByEmail')->willReturn([
            'id'    => 1,
            'name'  => 'John Doe',
            'email' => 'john@test.com',
        ]);

        $userRepository = new UserRepository($this->userPostgresProvider);

        $user = $userRepository->findByEmail('john@test.com');

        $this->assertIsArray($user);
        $this->assertEquals(1, $user['id']);
    }

    /**
     * @test
     */
    public function shouldReturnFalseWhenUserNotFoundByEmail()
    {
        $this->userPostgresProvider->method('findByEmail')->willReturn(false);

        $userRepository = new UserRepository($this->userPostgresProvider);

        $this->assertFalse($userRepository->findByEmail('john@test.com'));
    }

    /**
     * @test
     */
    public function shouldReturnUserById()
    {
        $this->userPostgresProvider->method('findById')->willReturn([
            'id'    => 1,
            'name'  => 'John Doe',
            'email' => 'john@test.com',
        ]);

        $userRepository = new UserRepository($this->userPostgresProvider);
        $user           = $userRepository->findById(1);

        $this->assertIsArray($user);
        $this->assertEquals(1, $user['id']);
    }

    /**
     * @test
     */
    public function shouldReturnFalseWhenUserNotFoundById()
    {
        $this->userPostgresProvider->method('findById')->willReturn(false);

        $userRepository = new UserRepository($this->userPostgresProvider);

        $this->assertFalse($userRepository->findById(1));
    }

    /**
     * @test
     */
    public function shouldReturnTrueWhenUpdateUser()
    {
        $this->userPostgresProvider->method('update')->willReturn(true);

        $userRepository = new UserRepository($this->userPostgresProvider);

        $this->assertTrue($userRepository->update([], 1));
    }
}
