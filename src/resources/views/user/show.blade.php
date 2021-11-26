@extends('layouts.app')

@section('title')
<title>BT School | {{ $data['user']->username }}</title>    
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="avatar rounded-circle img-thumbnail" style="height: 150px; width:150px;" 
                            src="{{config('app.url')}}/{{$data['user']->avatar}}" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">
                        @if($data['user']->fullname)
                            {{ $data['user']->fullname }}
                        @else
                            {{ $data['user']->username }}
                        @endif
                    </h3>
                    <p class="text-muted text-center">
                            {{ $data['user']->email }}
                    </p>
                    @if(!$data['profiles']->isEmpty())
                    <div>
                        <h4>Other information:</h4>
                    </div>
                    <ul class="list-group list-group-unbordered mb-3">
                        @foreach ($data['profiles'] as $profile)
                            <li class="list-group-item">
                                <b>{{$profile->key}}: </b>{{$profile->value}}
                            </li>
                        @endforeach
                    </ul>
                    @endif
                    
                    @if(!$data['topics']->isEmpty())
                        <h4 class="mt-3">Topics - Courses:</h4>
                        @foreach ($data['topics'] as $topic)
                            <li class="list-group-item">
                                <b>{{$topic->name}}</b>@if ($topic->course) - {{$topic->course->name}} @endif
                            </li>
                        @endforeach
                    @endif
                    @if(!$data['courses']->isEmpty())
                        <h4 class="mt-3">Courses:</h4>
                        @foreach ($data['courses'] as $course)
                            <li class="list-group-item">
                                <b>{{$course->name}}</b>
                            </li>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection