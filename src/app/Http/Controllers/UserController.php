<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInfoRequest;
use App\Models\Course;
use App\Models\Profile;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data['profiles'] = Profile::where('user_id', '=', $user->id)->get();
        $data['user'] = $user;  
        $data['courses'] = Course::whereHas('users', function($q) use($user) {
            $q->whereIn('id', [$user->id]);
        })->get();
        $data['topics'] = Topic::where('user_id', '=', $user->id)->get();
        return view('user.show')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Auth::user()->id == $user->id ){
            
            return view('user.edit')->with('user', $user);
        }
        else {
            abort(401);
        } 
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserInfoRequest $request, User $user)
    {
        if(Auth::user()->id == $user->id ){
            if($request->avatar)
            {
                $request->file('avatar')->store('public/avatars');
                $filename = $request->file('avatar')->hashName();
                $user->avatar = 'storage/avatars/'.$filename;
            }
            if($request->email)
            {
                $user->email = $request->email;
            }
            if($request->fullname)
            {
                $user->fullname = $request->fullname;
            }
            $user->save();
            return redirect()->route('profiles.index');
        }
        else {
            abort(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort(404);
    }
}
