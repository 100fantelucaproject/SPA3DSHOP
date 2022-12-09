<?php

namespace App\Policies;

use App\Models\Announcement;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Image  $image
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
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Announcement $announcement)
    {
        return $user->id === $announcement->user_id
        ? Response::allow()
        : Response::deny('You can\'t do it');
    }
    
}
