<?php

namespace App\Policies;

use App\Models\DevStack;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DevStackPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DevStack $devStack): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DevStack $devStack): bool
    {
        return $devStack->user()->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DevStack $devStack): bool
    {
        return $this->update($user, $devStack);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DevStack $devStack): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DevStack $devStack): bool
    {
        return true;
    }
}
