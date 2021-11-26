<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Course;
use App\Models\Profile;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['profiles'] = Profile::where('user_id', '=', auth()->user()->id)->get();
        $data['courses'] = Course::whereHas('users', function($q) {
            $q->whereIn('id', [Auth::user()->id]);
        })->get();
        $data['topics'] = Topic::where('user_id', '=', Auth::user()->id)->get();
        return view('profile.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfileRequest $request)
    {
        $profile = new Profile();
        $profile->key = ucwords($request->key);
        $profile->value = ucwords($request->value);
        $profile->user_id = Auth::user()->id;
        $profile->save();
        return redirect()->route('profiles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        return view('profile.edit')->with('profile', $profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        $profile->key = ucwords($request->key);
        $profile->value = ucwords($request->value);
        $profile->user_id = Auth::user()->id;
        $profile->save();
        return redirect()->route('profiles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect()->route('profiles.index');

    }
}
