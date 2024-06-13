<?php

namespace App\UseCases\User\FetchUser;

interface IFetchUserUseCase
{
    public function execute(int | string $userId): array;
}
