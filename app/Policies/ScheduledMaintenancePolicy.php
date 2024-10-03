<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ScheduledMaintenance;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScheduledMaintenancePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_scheduled::maintenance');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ScheduledMaintenance $scheduledMaintenance): bool
    {
        return $user->can('view_scheduled::maintenance');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_scheduled::maintenance');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ScheduledMaintenance $scheduledMaintenance): bool
    {
        return $user->can('update_scheduled::maintenance');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ScheduledMaintenance $scheduledMaintenance): bool
    {
        return $user->can('delete_scheduled::maintenance');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_scheduled::maintenance');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, ScheduledMaintenance $scheduledMaintenance): bool
    {
        return $user->can('force_delete_scheduled::maintenance');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_scheduled::maintenance');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, ScheduledMaintenance $scheduledMaintenance): bool
    {
        return $user->can('restore_scheduled::maintenance');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_scheduled::maintenance');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, ScheduledMaintenance $scheduledMaintenance): bool
    {
        return $user->can('replicate_scheduled::maintenance');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_scheduled::maintenance');
    }
}
