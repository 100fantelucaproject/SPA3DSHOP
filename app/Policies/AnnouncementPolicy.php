<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Announcement;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnouncementPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Announcement $announcement)
    {
        return $user->id === $announcement->user_id
        ? Response::allow()
        : Response::deny('You can\'t do it');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Announcement $announcement)
    {
        return $user->id === $announcement->user_id
            ? Response::allow()
            : Response::deny('You can\'t do it');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Announcement $announcement)
    {
        return $user->id === $announcement->user_id
            ? Response::allow()
            : Response::deny('You can\'t do it');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Announcement $announcement)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Announcement $announcement)
    {
        //
    }
}