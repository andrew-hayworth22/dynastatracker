<?php

namespace App\Policies;

use App\Models\Conference;
use App\Models\Division;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DivisionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Division $division): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Conference $conference): bool
    {
        return $user->id === $conference->dynasty->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Division $division): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Division $division): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Division $division): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Division $division): bool
    {
        //
    }
}
