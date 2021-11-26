<?php

namespace App\Http\Controllers;

use App\Models\AppConst;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->roles->contains('name', 'Trainee'))
        {
            $courses = Course::whereHas('users', function($q) {
                $q->whereIn('id', [Auth::user()->id]);
            })->paginate(AppConst::DEFAULT_MY_COURSE_PER_PAGE);
        }
        else
        {
            $courses = Course::whereHas('topics', function($q) {
                $q->whereIn('user_id', [Auth::user()->id]);
            })->paginate(AppConst::DEFAULT_MY_COURSE_PER_PAGE);
        }
        
        return view('my-course.index')->with('courses', $courses);
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

    public function joinCourse(Request $request)
    { 
        if(!Auth::user()->courses->contains($request->course) && Auth::user()->roles->contains('name', 'Trainee'))
        {
            Auth::user()->courses()->attach($request->course);
        }
        return redirect()->route("home");
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $my_course)
    {
        if($my_course->users->contains(Auth::user()->id) || $my_course->topics->contains('user_id', Auth::user()->id))
        {
            return view('my-course.show')->with('course', $my_course);
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $my_course)
    {
        //
    }
}
