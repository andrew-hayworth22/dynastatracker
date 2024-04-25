<?php

namespace App\Policies;

use App\Models\Dynasty;
use App\Models\Season;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SeasonPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Dynasty $dynasty): bool
    {
        return $user->id === $dynasty->user_id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Season $season): bool
    {
        return $user->id === $season->dynasty->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Dynasty $dynasty): bool
    {
        return $user->id === $dynasty->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Season $season): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Season $season): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Season $season): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Season $season): bool
    {
        //
    }
}
