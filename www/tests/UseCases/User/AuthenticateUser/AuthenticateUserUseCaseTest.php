<?php

use App\Exceptions\AuthorizationException;
use App\HttpInteractions\IJWTInteraction;
use App\Repositories\Implementations\UserRepository;
use App\UseCases\User\AuthenticateUser\AuthenticateUserDTO;
use App\UseCases\User\AuthenticateUser\AuthenticateUserUseCase;
use App\Utils\IPasswordUtils;
use PHPUnit\Framework\TestCase;

class AuthenticateUserUseCaseTest extends TestCase
{
    private $jwt;
    private $passwordUtils;
    private $userRepository;
    private $authenticateUserDTO;

    public function setUp(): void
    {
        $this->jwt                 = $this->createMock(IJWTInteraction::class);
        $this->passwordUtils       = $this->createMock(IPasswordUtils::class);
        $this->userRepository      = $this->createMock(UserRepository::class);
        $this->authenticateUserDTO = $this->createMock(AuthenticateUserDTO::class);
    }

    /**
     * @test
     */
    public function shouldAuthenticateUser()
    {
        $this->userRepository->method('findByEmail')->willReturn(['password' => 'hashed_password']);

        $this->passwordUtils->method('verifyPassword')->willReturn(true);

        $this->jwt->method('generateJWT')->willReturn('jwt_token');

        $authenticateUserUseCase = new AuthenticateUserUseCase($this->jwt, $this->passwordUtils, $this->userRepository);

        $jwtToken = $authenticateUserUseCase->excute($this->authenticateUserDTO);

        $this->assertEquals('jwt_token', $jwtToken);
    }

    /**
     * @test
     */
    public function shouldThrowAuthorizationExceptionWhenEmailNotFound()
    {
        $this->userRepository->method('findByEmail')->willReturn(false);

        $this->expectException(AuthorizationException::class);
        $this->expectExceptionMessage('Sorry, email or password is incorrect.');
        $this->expectExceptionCode(401);

        $authenticateUserUseCase = new AuthenticateUserUseCase($this->jwt, $this->passwordUtils, $this->userRepository);

        $authenticateUserUseCase->excute($this->authenticateUserDTO);
    }

    /**
     * @test
     */
    public function shouldThrowAuthorizationExceptionWhenPasswordNotMatch()
    {
        $this->userRepository->method('findByEmail')->willReturn(['password' => 'hashed_password']);

        $this->passwordUtils->method('verifyPassword')->willReturn(false);

        $this->expectException(AuthorizationException::class);
        $this->expectExceptionMessage('Sorry, email or password is incorrect.');
        $this->expectExceptionCode(401);

        $authenticateUserUseCase = new AuthenticateUserUseCase($this->jwt, $this->passwordUtils, $this->userRepository);

        $authenticateUserUseCase->excute($this->authenticateUserDTO);
    }
}
