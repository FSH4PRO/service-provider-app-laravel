<?php

namespace App\Services\Admin;

use App\Models\User;

class UserService
{
    public function getUsers(){
        return User::all();
    }

    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();
    }

    
}
