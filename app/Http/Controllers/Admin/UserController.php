<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Gate;
use Exception;

class UserController extends Controller
{
    public function index() {
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('admin.user.index', compact(['users', 'roles']));
    }
    public function update(Request $request, User $user) {
        try {
            $user->roles()->sync($request->roles);
            return $user->load('roles');
        } catch(Exception $e) {
            return json_encode((object) ['error' => $e->getMessage()]);
        }
    }
    public function destroy(User $user) {
        $user->roles()->detach();
        $user->delete();
        return $user;
    }
}
