@extends('adminlte::page')

@section('title', 'Admin | Create topic')

@section('content_header')
    <h1>Create new topic</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create new topic</h3>
                      </div>
                    <form action="{{route('admin.topics.store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="topicName">Name:</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                    id="topicName" name="name" value="{{ old('name') }}" placeholder="Topic name">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="topicDescription">Description:</label>
                                <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" 
                                    id="topicDescription" name="description" value="{{ old('description') }}" placeholder="Description">
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="topicCourse">Course:</label>
                                <select class="form-control" id="topicCourse" name="course_id">
                                    <option value="0">null</option>
                                    @foreach ($data['courses'] as $course)
                                        <option value="{{ $course->id }}"
                                            @if (old('course_id') == $course->id)
                                                selected
                                            @endif
                                        >
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('course_id'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('course_id') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="topicTrainer">Trainer:</label>
                                <select class="form-control" id="topicTrainer" name="user_id">
                                    <option value="0">null</option>
                                    @foreach ($data['users'] as $user)
                                        <option value="{{ $user->id }}"
                                            @if (old('user_id') == $user->id)
                                                selected
                                            @endif
                                        >
                                            {{ $user->fullname }} - {{ $user->username }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('user_id'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary col col-12">Save</button>
                        </div>
                    </form>
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