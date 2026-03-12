<?php

namespace App\Observers;

use App\Models\User;
use Cache;

class UserProfileObserver
{

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        Cache::forget("user_profile_image_{$user->id}");
    }
}
