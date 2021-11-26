<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['total_users'] = User::count();
        $data['total_courses'] = Course::count();
        $data['total_topics'] = Topic::count();
        $data['total_categories'] = Category::count();
        return view('admin.home')->with('data', $data);
    }

    public function setting()
    {
        return view('admin.setting');
    }
}
