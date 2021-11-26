@extends('adminlte::page')

@section('title', 'Admin | Create course')

@section('content_header')
    <h1>Create new course</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create new course</h3>
                      </div>
                    <form action="{{route('admin.courses.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="courseName">Name:</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                    id="courseName" name="name" value="{{ old('name') }}" placeholder="Course name">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="courseDescription">Description:</label>
                                <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" 
                                    id="courseDescription" name="description" value="{{ old('description') }}" placeholder="Description">
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="coursesessions">Number of sessions:</label>
                                <input type="text" class="form-control {{ $errors->has('numberOfSessions') ? 'is-invalid' : '' }}" 
                                    id="coursesessions" name="numberOfSessions" value="{{ old('numberOfSessions') }}" placeholder="Number of sessions">
                                @if ($errors->has('numberOfSessions'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('numberOfSessions') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="courseShift">Shift:</label>
                                <input type="text" class="form-control {{ $errors->has('shift') ? 'is-invalid' : '' }}" 
                                    id="courseShift" name="shift" value="{{ old('shift') }}" placeholder="Shift">
                                @if ($errors->has('shift'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('shift') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Start Date:</label>
                                <input name="startDate" value="{{ old('startDate') }}" class="date form-control {{ $errors->has('startDate') ? 'is-invalid' : '' }}" type="date">
                                @if ($errors->has('startDate'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('startDate') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Start Date:</label>
                                <input name="endDate" value="{{ old('endDate') }}" class="date form-control {{ $errors->has('endDate') ? 'is-invalid' : '' }}" type="date">
                                @if ($errors->has('endDate'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('endDate') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="courseCategogy">Category:</label>
                                <select class="form-control" id="courseCategogy" name="category_id">
                                    <option value="0">null</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if (old('category_id') == $category->id)
                                                selected
                                            @endif
                                        >
                                            {{ $category->name }}
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
                                <label for="customFile">Choose image:</label>
                                <div class="input-group {{ $errors->has('image') ? 'is-invalid' : '' }}">
                                    <div class="custom-file">
                                        <input type="file" ref="input" class="custom-file-input {{ $errors->has('image') ? 'is-invalid' : '' }}" id="customFile" name="image">
                                        <label class="custom-file-label" for="customFile">Choose image</label>
                                    </div>
                                </div>
                                @if($errors->has('image'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('image') }}</strong>
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