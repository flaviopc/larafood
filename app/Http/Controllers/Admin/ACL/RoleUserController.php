<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    protected $user, $role;

    public function __construct(User $user, Role $role)
    {
        $this->middleware(['can:users']);
        $this->user = $user;
        $this->role = $role;
    }

    public function roles($idUser)
    {
        $user = $this->user->find($idUser);
        if (!$user)
            return redirect()->back();

        $roles = $user->roles()->paginate();

        return view('admin.pages.users.roles.roles', ['roles' => $roles, 'user' => $user]);
    }

    public function users($idRole)
    {
        $role = $this->role->find($idRole);
        if (!$role)
            return redirect()->back();

        $users = $role->users()->paginate();

        return view('admin.pages.roles.users.users', ['role' => $role, 'users' => $users]);
    }

    public function rolesAvailable(Request $request, $idUser)
    {
        $user = $this->user->find($idUser);
        if (!$user)
            return redirect()->back();

        $filters = $request->except('_token');

        $roles = $user->rolesAvailable($request->filter);

        return view('admin.pages.users.roles.available',
         ['user' => $user, 'roles' => $roles,'filters'=>$filters]);
    }

    public function attachRolesUser($idUser, Request $request)
    {
        $user = $this->user->find($idUser);
        if (!$user)
            return redirect()->back();

        if (!$request->roles || count($request->roles) <= 0)
            return redirect()->back()->with('info', 'Marque pelo menos uma permissão');

        $user->roles()->attach($request->roles);

        return redirect()->route('users.roles', $user->id);
    }

    public function detachRolesUser($idUser, $idRole)
    {
        $user = $this->user->find($idUser);
        $role = $this->role->find($idRole);

        if (!$user || !$role)
            return redirect()->back();

        $user->roles()->detach($role);

        return redirect()->back();
    }
}
