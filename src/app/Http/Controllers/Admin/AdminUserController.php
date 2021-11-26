<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\AppConst;
use App\Models\Profile;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $check = false;
        foreach(auth()->user()->roles as $userRole)
        {
            if($userRole->name == "Admin")
            {
                $check = true;
                break;
            }
        }
        $data['key'] = null;
        $data['type'] = null;
        if($check){
            if($request->key && $request->type)
            {
                $data['key'] = $request->key;
                $data['type'] = $request->type;
                if($data['type'] == "username" ||$data['type'] == "fullname" ||$data['type'] == "email")
                {
                    $data['users'] = User::where('id', '!=', auth()->user()->id)
                                ->where($data['type'], 'LIKE', "%{$data['key']}%")
                                ->with('roles')
                                ->paginate(AppConst::DEFAULT_ADMIN_USER_PER_PAGE);
                }
                else
                {
                    $data['users'] = User::where('id', '!=', auth()->user()->id)
                                ->whereHas('profiles', function($q) use($data) {
                                    $q->where('key', 'LIKE', "%{$data['type']}%")
                                    ->where('value', 'LIKE', "%{$data['key']}%");
                                })->with('roles')
                                ->paginate(AppConst::DEFAULT_ADMIN_USER_PER_PAGE);
                }

            }
            else {
                $data['users'] = User::where('id', '!=', auth()->user()->id)
                                ->with('roles')
                                ->paginate(AppConst::DEFAULT_ADMIN_USER_PER_PAGE);
            }
            
        }
        else {
            if($request->key && $request->type)
            {
                $data['key'] = $request->key;
                $data['type'] = $request->type;
                if($data['type'] == "username" ||$data['type'] == "fullname" ||$data['type'] == "email")
                {
                    $data['users'] = User::where('id', '!=', auth()->user()->id)
                                ->whereHas('roles', function($q) {
                                    $q->whereIn('name', ['Trainer','Trainee']);
                                })
                                ->where($data['type'], 'LIKE', "%{$data['key']}%")
                                ->with('roles')
                                ->paginate(AppConst::DEFAULT_ADMIN_USER_PER_PAGE);
                }
                else
                {
                    $data['users'] = User::where('id', '!=', auth()->user()->id)
                                ->whereHas('roles', function($q) {
                                    $q->whereIn('name', ['Trainer','Trainee']);
                                })
                                ->whereHas('profiles', function($q) use($data) {
                                    $q->where('key', 'LIKE', "%{$data['type']}%")
                                    ->where('value', 'LIKE', "%{$data['key']}%");
                                })->with('roles')
                                ->paginate(AppConst::DEFAULT_ADMIN_USER_PER_PAGE);
                }

            }
            else {
                $data['users'] = User::where('id', '!=', auth()->user()->id)
                                    ->whereHas('roles', function($q) {
                                        $q->whereIn('name', ['Trainer','Trainee']);
                                    })->with('roles')->paginate(AppConst::DEFAULT_ADMIN_USER_PER_PAGE);
            }
        }
        $data['options'] = Profile::distinct()->get(['key']);
        $data['roles'] = Role::all();
        return view('admin.user.list')->with('usersData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $checkRole = false;
        if(Auth::user()->roles->contains('name', 'Admin'))
        {
            $checkRole = true;
        }
        // $request->file('avatar')->store('public/avatars');
        // $filename = $request->file('avatar')->hashName();
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->avatar = 'storage/avatars/avatar-default.png';
        // $user->avatar = 'storage/avatars/'.$filename;
        $user->save();
        if (!$checkRole)
        {
            foreach($request->roles as $role)
            {
                $addRole = Role::find($role);
                if($addRole->name != "Admin" && $addRole != "Training staff") 
                {
                    $user->roles()->attach($role);
                }
            }
            
        }
        else {
            foreach($request->roles as $role)
            {
                $user->roles()->attach($role);
            }

        }
        
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data['user'] = $user;
        $data['roles'] = Role::all();
        return view('admin.user.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $checkRole = false;
        if(Auth::user()->roles->contains('name', 'Admin'))
        {
            $checkRole = true;
        }
        if (!$checkRole)
        {
            foreach($user->roles as $role)
            {
                if($role->name == "Admin" || $role == "Training staff")
                {
                    abort(401);
                }
            }
            
        }
        // $request->file('avatar')->store('public/avatars');
        // $filename = $request->file('avatar')->hashName();
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->avatar = 'storage/avatars/avatar-default.png';
        // $user->avatar = 'storage/avatars/'.$filename;
        $user->save();
        if (!$checkRole)
        {
            foreach($request->roles as $role)
            {
                $addRole = Role::find($role);
                if($addRole->name != "Admin" && $addRole != "Training staff") 
                {
                    $user->roles()->attach($role);
                }
            }
            
        }
        else {
            foreach($request->roles as $role)
            {
                $user->roles()->attach($role);
            }

        }
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('admin.users.index');
    }

    public function blockUser(User $user)
    {
        $user->blocked = true;
        $user->save();
        return redirect()->route('admin.users.index');
    }

    public function unblockUser(User $user)
    {
        $user->blocked = false;
        $user->save();
        return redirect()->route('admin.users.index');
    }
}
