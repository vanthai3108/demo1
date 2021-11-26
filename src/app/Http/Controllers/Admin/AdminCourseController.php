<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\AppConst;
use App\Models\Category;
use App\Models\User;

class AdminCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::with('category')->paginate(AppConst::DEFAULT_ADMIN_USER_PER_PAGE);
        return view('admin.course.list')->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.course.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        $request->file('image')->store('public/courses');
        $filename = $request->file('image')->hashName();
        $course = new Course();
        $course->fill($request->all());
        if ($request->category_id == 0) {
            $course->category_id = null;
        }
        $course->image = 'storage/courses/'.$filename;
        $course->save();
        return redirect()->route('admin.courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('admin.course.show')->with('course', $course);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $data['course'] = $course;
        $data['categories'] = Category::all();
        return view('admin.course.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $request->file('image')->store('public/courses');
        $filename = $request->file('image')->hashName();
        $course->fill($request->all());
        if ($request->category_id == 0) {
            $course->category_id = null;
        }
        $course->image = 'storage/courses/'.$filename;
        $course->save();
        return redirect()->route('admin.courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }

    public function deleteTrainee(Course $course, $user)
    {
        $course->users()->detach($user);
        return redirect()->route('admin.courses.show',['course' => $course->id]);
    }

    public function addTraineeView(Course $course)
    {
        $data['users'] = User::whereHas('roles', function($q) {
            $q->whereIn('name', ['Trainee']);
        })->get();
        $data['course'] = $course;
        return view('admin.course.addTrainee')->with('data', $data);
    }

    public function addTrainee(Request $request, Course $course)
    {
        $check = $course->users->contains($request->user);
        if(!$check)
        {
            $course->users()->attach($request->user);
        }
        return redirect()->route('admin.courses.addTraineeView', $course);
    }
}
