<?php

namespace App\Services\Global;

use App\Models\User;
use App\Enums\RoleUserEnum;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function register($attrs, $role = RoleUserEnum::CLIENT)
    {
        $attrs['password'] = Hash::make($attrs['password']);
        $user = User::create(array_merge($attrs, [
            'role' => $role
        ]));
        $user->access_token = $user->createToken('auth_token')->accessToken;
        return $user;
    }

    public function login($attrs, $role = RoleUserEnum::CLIENT)
    {
        if (Auth::attempt([
            'email' => $attrs['email'],
            'password' => $attrs['password'],
            'role' => $role
        ])) {
            $user = User::find(Auth::id());
            $user->access_token = $user->createToken('auth_token')->accessToken;
            return $user;
        }
        throw new GeneralException('Invalid Credentials', 401);
    }

    public function profile()
    {
        return Auth::user();
    }
}
