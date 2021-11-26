@extends('adminlte::page')

@section('title', 'Admin | Create user')

@section('content_header')
    <h1>Create new user</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create new user</h3>
                      </div>
                    <form action="{{route('admin.users.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" 
                                    id="username" name="username" value="{{ old('username') }}" placeholder="Username" autofocus>
                                @if ($errors->has('username'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="text" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                                    id="password" name="password" value="{{ old('password') }}" placeholder="Password">
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                            {{-- <div class="form-group">
                                <label for="fullname">Full name:</label>
                                <input type="text" class="form-control {{ $errors->has('fullname') ? 'is-invalid' : '' }}" 
                                    id="fullname" name="fullname" value="{{ old('fullname') }}" placeholder="Fullname">
                                @if ($errors->has('fullname'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('fullname') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                    id="email" name="email" value="{{ old('email') }}" placeholder="email">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="customFile">Choose avatar:</label>
                                <div class="input-group {{ $errors->has('avatar') ? 'is-invalid' : '' }}">
                                    <div class="custom-file">
                                        <input type="file" ref="input" class="custom-file-input {{ $errors->has('avatar') ? 'is-invalid' : '' }}" id="customFile" name="avatar">
                                        <label class="custom-file-label" for="customFile">Choose avatar</label>
                                    </div>
                                </div>
                                @if($errors->has('avatar'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </div>
                                @endif
                            </div> --}}
                            
                            <div class="form-group">
                                <label for="roles">Roles:</label>
                                <div id="roles" class="row justify-content-center {{ $errors->has('roles') ? 'is-invalid' : '' }}">
                                    @foreach ($roles as $role)
                                        <div class="custom-control custom-checkbox col-5">
                                            <input class="custom-control-input" id="role_{{ $role->id }}" type="checkbox" 
                                                name="roles[]" value="{{ $role->id }}" 
                                                {{ (is_array(old('roles')) && in_array($role->id, old('roles'))) ? ' checked' : ''}}>
                                            <label class="custom-control-label" for="role_{{ $role->id }}">{{ $role->name}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @if($errors->has('roles'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('roles') }}</strong>
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