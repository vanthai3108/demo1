@extends('adminlte::page')

@section('title', 'Admin | Course details')

@section('content_header')
    <h1>Course details</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Course details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-5">
                    <div class="post row">
                        <img class="col-12" src="../../{{$course->image}}" alt="Course image">
                    </div>
                </div>
                <div class="col-7">
                    <div class="post">
                        <h4>Coures name: {{ $course->name }}</h4>
                        <p>Description: {{ $course->description }}</p>
                        <p>Category: @if ($course->category) {{ $course->category->name }} @else null @endif </p>
                        <p>Start date: {{ $course->startDate }}</p>
                        <p>End date: {{ $course->endDate }}</p>
                        <p>Number of sessions: {{ $course->numberOfSessions }}</p>
                        <p>Shift: {{ $course->shift }}</p>
                    </div>
                    <div class="post">
                        <h4>Topics</h4>
                        @foreach ($course->topics as $topic)
                            <p>Name: {{ $topic->name }} - Trainer:@if($topic->user) {{ $topic->user->username}} @else null @endif</p>
                        @endforeach
                    </div>
                    <div class="post">
                        <h4>Tranees <span style="font-size:16px;"><a href="{{ route('admin.courses.addTraineeView', $course->id) }}" class="text-green"><i class="fas fa-plus text-green"></i> Add trainee</a></span></h4>
                        @foreach ($course->users as $user)
                                <form action="{{ route('admin.courses.deleteTrainee',['course' => $course->id, 'user' => $user->id]) }}">
                                    @csrf
                                    <div class="mt-3">{{ $user->username }}
                                        <button type="submit" class="close text-red">×</button>
                                    </div>
                                </form>
                        @endforeach
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop