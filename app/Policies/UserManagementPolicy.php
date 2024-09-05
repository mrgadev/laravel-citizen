<?php

namespace App\Policies;

use App\Models\User;

class UserManagementPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function viewAny(User $user) {
        return $user->role == 'Admin';
    }

    public function view(User $user, User $model) {
        return $user->role == 'Admin';
    }

}
