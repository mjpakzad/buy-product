<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return Transaction::class;
    }
}
