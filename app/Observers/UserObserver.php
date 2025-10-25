<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Tutor;

class UserObserver
{
    /**
     * Handle events after a user is created.
     */
    public function created(User $user): void
    {
        if ($user->hasRole('tutor')) {
            Tutor::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
        }
    }
}
