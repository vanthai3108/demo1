@extends('adminlte::page')

@section('title', 'Admin | Add Trainee to course')

@section('content_header')
    <h1>Add Trainee to course</h1>
    <a href="{{ route('admin.courses.show', $data['course']->id) }}">Back to course details</a>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Trainee to course - ID: {{$data['course']->id}}</h3>
                        
                    </div>
                    <form action="{{route('admin.courses.addTrainee', $data['course']->id)}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="courseTrainee">Trainee:</label>
                                <select class="form-control" id="courseTrainee" name="user">
                                    @foreach ($data['users'] as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id') != null ? old('user_id') : '' }}
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
                        <div class="card-footer justify-content-center">
                            <button type="submit" class="btn btn-primary col-12">Save</button>
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