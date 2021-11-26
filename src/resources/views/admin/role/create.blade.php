@extends('adminlte::page')

@section('title', 'Admin | Create role')

@section('content_header')
    <h1>Create new role</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create new role</h3>
                      </div>
                    <form action="{{route('admin.roles.store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="roleName">Name:</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                    id="roleName" name="name" value="{{ old('name') }}" placeholder="Role name">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="roleDescription">Description:</label>
                                <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" 
                                    id="roleDescription" name="description" value="{{ old('description') }}" placeholder="Description">
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
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