<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Services\Admin\UserService;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $service;
    public function __construct(UserService $service){
        $this->service = $service;

    }
    public function index(){
    
        $users = $this->service->getUsers();
        return view('admin.users.index', compact('users'));
    }

    public function destroy($id){
        $this->service->deleteUser($id);
        return redirect()->route('admin.users.index');
    }
}
