<?php

namespace App\Repositories;

use App\Enums\KYCLevel;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return User::class;
    }

    /**
     * @param string $mobile
     * @return bool
     */
    public function mobileExists(string $mobile): bool
    {
        return $this->getModel()->query()->hasMobile($mobile)->exists();
    }

    /**
     * @param string $email
     * @return bool
     */
    public function emailExists(string $email): bool
    {
        return $this->getModel()->query()->hasEmail($email)->exists();
    }

    /**
     * @param $mobile
     * @return User
     */
    public function findByMobile($mobile): ?User
    {
        return $this->getModel()->query()->where('mobile', $mobile)->first();
    }

    /**
     * @param $email
     * @return User
     */
    public function findByEmail($email): ?User
    {
        return $this->getModel()->query()->where('email', $email)->first();
    }

    /**
     * @param string $password
     * @return string
     */
    public function hashPassword(string $password): string
    {
        return bcrypt($password);
    }

    /**
     * @param $user
     */
    public function getTokens($user)
    {
        return $user->tokens()->get();
    }

    /**
     * @param $user
     * @param $tokenId
     * @return mixed
     */
    public function DeleteToken($user, $tokenId)
    {
        return $user->tokens()->where('id', $tokenId)->delete();
    }

    /**
     * @param $user
     * @return mixed
     */
    public function DeleteTokens($user)
    {
        return $user->tokens()->delete();
    }

    /**
     * @param $user
     * @return void
     */
    public function DeleteCurrentToken($user)
    {
        return $user->currentAccessToken()->delete();
    }

    /**
     * @param $user
     * @param $totalAmount
     * @return bool
     */
    public function hasCredit($user, $totalAmount): bool
    {
        $user = $user->refresh();
        return $user->credit >= $totalAmount;
    }

    /**
     * @param $user
     * @param $totalAmount
     * @return mixed
     */
    public function reduceCredit($user, $totalAmount)
    {
        $user->decrement('credit', $totalAmount);
        return $user->refresh();
    }
}
