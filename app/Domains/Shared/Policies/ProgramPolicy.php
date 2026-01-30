<?php

namespace App\Domains\Shared\Policies;

use App\Domains\Shared\Exceptions\ForbiddenForYouException;
use App\Domains\Shared\Model\Program;
use App\Domains\User\Models\User;

class ProgramPolicy
{

    public function before(User $user)
    {
        if ($user->role_name === 'admin') return true;
        return null;
    }

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
    public function view(User $user, Program $program): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        throw new ForbiddenForYouException();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Program $program): bool
    {
        throw new ForbiddenForYouException();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Program $program): bool
    {
        throw new ForbiddenForYouException();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Program $program): bool
    {
        throw new ForbiddenForYouException();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Program $program): bool
    {
        throw new ForbiddenForYouException();
    }

    public function isActive(User $user, Program $program): bool
    {
        throw new ForbiddenForYouException();
    }
}
