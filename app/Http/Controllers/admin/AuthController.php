<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleUserEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Global\AuthService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Global\LoginRequest;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }

    public function loginView(){
        return view("auth.login");
    }

    public function login(LoginRequest $request){
        $attr = $request->validated();
        $user = $this->authService->login($attr, RoleUserEnum::ADMIN);
        return view("admin.dashboard", compact("user"));
    }

      public function logout(Request $request)
    {
        Auth::logout(); // يخرج الأدمن
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("admin.login.view");
    }
}
 