@extends('adminlte::page')

@section('title', 'Admin | Edit topic')

@section('content_header')
    <h1>Edit topic</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit topic - ID: {{$data['topic']->id}}</h3>
                      </div>
                    <form action="{{route('admin.topics.update', $data['topic']->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="topicName">Name:</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                    id="topicName" name="name" value="{{ old('name') != null ? old('name') : $data['topic']->name }}" placeholder="Topic name">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="topicDescription">Description:</label>
                                <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" 
                                    id="topicDescription" name="description" value="{{ old('description') != null ? old('description') : $data['topic']->description }}" placeholder="Description">
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
                                            {{ old('course_id') != null ? (old('course_id') == $course->id ? 'selected' : '') : ($data['topic']->course_id == $course->id ? 'selected' : '' )}}
                                        >{{ $course->name }}
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
                                            {{ old('user_id') != null ? (old('user_id') == $user->id ? 'selected' : '') : ($data['topic']->user_id == $user->id ? 'selected' : '' )}}
                                        >{{ $user->fullname }} - {{ $user->username }}
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