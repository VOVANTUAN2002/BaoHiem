<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserGroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('UserGroup_viewAny');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, UserGroup $userGroup)
    {
        return $user->hasPermission('UserGroup_view');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('UserGroup_create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, UserGroup $userGroup)
    {
        return $user->hasPermission('UserGroup_update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, UserGroup $userGroup)
    {
        return $user->hasPermission('UserGroup_delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, UserGroup $userGroup)
    {
        return $user->hasPermission('UserGroup_restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, UserGroup $userGroup)
    {
        return $user->hasPermission('UserGroup_forceDelete');
    }
}
