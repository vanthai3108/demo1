@extends('layouts.app')

@section('title')
<title>BT School | Profile</title>    
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="avatar rounded-circle img-thumbnail" style="height: 150px; width:150px;" 
                            src="{{config('app.url')}}/{{Auth::user()->avatar}}" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">
                        @if(Auth::user()->fullname)
                            {{ Auth::user()->fullname }}
                        @else
                            {{ Auth::user()->username }}
                        @endif
                    </h3>
                    <p class="text-muted text-center">
                            {{ Auth::user()->email }}
                    </p>
                    <div class="text-center mb-3">
                        <a href="{{route('users.edit', Auth::user()->id)}}"><i class="fas fa-pen"></i> Edit</a>
                    </div>
                    <div>
                        <h4>Other information:</h4>
                    </div>
                    <ul class="list-group list-group-unbordered mb-3">
                        @foreach ($data['profiles'] as $profile)
                            <form action="{{ route('profiles.destroy',$profile->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <li class="list-group-item">
                                    <b>{{$profile->key}}: </b>{{$profile->value}}
                                    <button type="submit" class="close">×</button>
                                    <a class="float-right mr-3" href="{{ route('profiles.edit', $profile->id)}}"><i class="fas fa-pen"></i></a>
                                </li>
                            </form>
                        @endforeach
                    </ul>
                    <a href="{{ route('profiles.create')}}" class="btn btn-primary btn-block"><b>Add new</b></a>
                    @if(!$data['topics']->isEmpty())
                    <h4 class="mt-3">Topics - Courses:</h4>
                    @foreach ($data['topics'] as $topic)
                        <li class="list-group-item">
                            <b>{{$topic->name}}</b>@if($topic->course) - <a href="{{ route('myCourses.show', $topic->course->id)}}">{{$topic->course->name}}</a> @endif
                        </li>
                    @endforeach
                    @endif
                    @if(!$data['courses']->isEmpty())
                        <h4 class="mt-3">Courses:</h4>
                        @foreach ($data['courses'] as $course)
                            <li class="list-group-item">
                                <b><a href="{{ route('myCourses.show', $course->id)}}">{{ $course->name }}</a></b>
                            </li>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
