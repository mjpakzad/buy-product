<?php

namespace App\Repositories\Contracts;

use App\Models\PersonalAccessToken;
use App\Models\User;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function mobileExists(string $mobile): bool;

    public function emailExists(string $email): bool;

    public function findByMobile($mobile): ?User;

    public function findByEmail($email): ?User;

    public function hashPassword(string $password): string;

    public function getTokens($user);

    public function DeleteToken($user, $tokenId);

    public function DeleteTokens($user);

    public function DeleteCurrentToken($user);

    public function hasCredit($user, $totalAmount): bool;

    public function reduceCredit($user, $totalAmount);
}
