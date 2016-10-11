<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasRoles');
    }

    public function showAssigningForm($userId)
    {
        $user = User::findOrFail($userId);
        $roles = Role::all();

        return view('roles.assign', ['roles' => $roles, 'user' => $user]);
    }

    public function assign(Request $request)
    {
        $this->validate($request, [
            'role_id' => 'required|integer|exists:roles,id', 
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $user = User::find($request->user_id);
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('user.show', $user->login)->with('success', 'Роль пользователя успешно изменена');


    }
}