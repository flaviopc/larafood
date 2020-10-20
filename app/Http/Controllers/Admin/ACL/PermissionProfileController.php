<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    protected $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }

    public function permissions($idProfile)
    {
        $profile = $this->profile->find($idProfile);
        if (!$profile)
            return redirect()->back();

        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permissions',['permissions'=>$permissions,'profile'=>$profile]);
    }

    public function permissionsAvailable($idProfile)
    {
        $profile = $this->profile->find($idProfile);
        if (!$profile)
            return redirect()->back();

        $permissions = $profile->permissionsAvailable();

        return view('admin.pages.profiles.permissions.available', ['profile'=>$profile,'permissions'=>$permissions]);
    }

    public function attachPermissionsProfile($idProfile, Request $request)
    {
        $profile = $this->profile->find($idProfile);
        if (!$profile)
            return redirect()->back();

        if(!$request->permissions || count($request->permissions) <= 0)
            return redirect()->back()->with('info','Marque pelo menos uma permissão');

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions',$profile->id);
    }
}

