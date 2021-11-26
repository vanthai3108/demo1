<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\AppConst;
use App\Models\Course;
use App\Models\User;

class AdminTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::paginate(AppConst::DEFAULT_ADMIN_TOPIC_PER_PAGE);
        return view('admin.topic.list')->with('topics', $topics);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = User::whereHas('roles', function($q) {
            $q->whereIn('name', ['Trainer']);
        })->get();
        $data['courses'] = Course::all();
        return view('admin.topic.create')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTopicRequest $request)
    {
        $topic = new Topic();
        $topic->fill($request->all());
        if ($request->course_id == 0) {
            $topic->course_id = null;
        }
        if ($request->user_id == 0) {
            $topic->user_id = null;
        }
        $topic->save();
        return redirect()->route('admin.topics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        $data['users'] = User::whereHas('roles', function($q) {
            $q->whereIn('name', ['Trainer']);
        })->get();
        $data['courses'] = Course::all();
        $data['topic'] = $topic;
        return view('admin.topic.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        if ($request->course_id == 0) {
            $topic->course_id = null;
        }
        if ($request->user_id == 0) {
            $topic->user_id = null;
        }
        $topic->save();
        return redirect()->route('admin.topics.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('admin.topics.index');
    }
}
