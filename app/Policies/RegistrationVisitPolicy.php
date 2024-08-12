<?php

namespace App\Policies;

use App\Models\User;
use App\Models\RegistrationVisit;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegistrationVisitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_registration::visit');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RegistrationVisit $registrationVisit): bool
    {
        return $user->can('view_registration::visit');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_registration::visit');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RegistrationVisit $registrationVisit): bool
    {
        //dd($registrationVisit);
        if($registrationVisit->date_time_out==null){
            return $user->can('update_registration::visit');
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RegistrationVisit $registrationVisit): bool
    {
        return $user->can('delete_registration::visit');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_registration::visit');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, RegistrationVisit $registrationVisit): bool
    {
        return $user->can('force_delete_registration::visit');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_registration::visit');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, RegistrationVisit $registrationVisit): bool
    {
        return $user->can('restore_registration::visit');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_registration::visit');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, RegistrationVisit $registrationVisit): bool
    {
        return $user->can('replicate_registration::visit');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_registration::visit');
    }
}
