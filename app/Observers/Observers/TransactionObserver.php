<?php

namespace App\Observers\Observers;

use App\Models\Transaction;
use Cache;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        $this->clearCache($transaction->user_id);
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        $this->clearCache($transaction->user_id);

    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        $this->clearCache($transaction->user_id);
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        $this->clearCache($transaction->user_id);
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }

    public function clearCache(int $userId): void
    {
        Cache::forget("ai_insight_{$userId}");
    }
}
