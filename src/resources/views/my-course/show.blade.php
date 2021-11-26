@extends('layouts.app')

@section('title')
<title>BT School | {{ $course->name }}</title>    
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 text-center mb-3">
            <h1>Course: {{ $course->name }}</h1>
        </div>
        <div class="col-6">
            <div class="row">
                <img class="card-img-top col-12" style="height: 50vmin" src="{{config('app.url')}}/{{  $course->image }}" alt="Card image cap">
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-12">
                    <h5>Description: <span>{{ $course->description }}</span></h5>
                    @if($course->category != null) 
                        <h5>Category: <span>{{ $course->category->name }}</span></h5>
                    @endif
                    <h5>Start date: {{ $course->startDate }}</h5>
                    <h5>End date: {{ $course->endDate }}</h5>
                    <h5>Number of session: {{ $course->numberOfSessions }}</h5>
                    <h5>Shift: {{ $course->shift }}</h5>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h5 class="mb-0">Topics:</h5>
                    @foreach ($course->topics as $topic)
                        <p class="mb-0">{{ $topic->name }} - @if($topic->user) <a href="{{ route('users.show', $topic->user->id ) }}">{{ $topic->user->username}}</a>@else not have @endif</p>
                    @endforeach
                    <hr>
                </div>
            </div>
            <div class="row mt-2 mb-0">
                <div class="col-12">
                    <h5 class="mb-0">Trainee:</h5>
                    @foreach ($course->users as $user)
                        <p class="mb-0"><a href="{{ route('users.show', $user->id ) }}">{{ $user->username}}</a></p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection