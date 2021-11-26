<?php

namespace App\Http\Controllers;

use App\Models\AppConst;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
    public function index(Request $request)
    {
        $data['categories'] = Category::all();
        $data['now_category'] = null;
        // $data['my_courses'] = Course::where('users', '=', Auth::user()->id);
        if ($request->category)
        {
            $data['now_category'] = $request->category;
            $data['courses'] = Course::where('category_id', '=', $request->category)
                                        ->paginate(AppConst::DEFAULT_HOME_COURSE_PER_PAGE);
        }
        else
        {
            $data['courses'] = Course::paginate(AppConst::DEFAULT_HOME_COURSE_PER_PAGE);;
        }
        return view('home')->with('data', $data); 
    }

    
}
