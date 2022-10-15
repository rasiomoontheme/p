<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * @param user $user
     */
    public function creating(User $user){
        $this->checkPassword($user);
    }

    public function updating(User $user){
        $this->checkPassword($user);
        //$user->clearPermissionAndMenu();
    }

    /** 
    public function deleting(user $user){
        $user->clearPermissionAndMenu();
    }
    */

    public function checkPassword(User $user){
        if($user->password && \Hash::needsRehash($user->password)){
            $user->password = bcrypt($user->password);
        }
    }
}
