@extends('layouts.app')

@section('title')
<title>BT School | Edit information</title>    
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit information</h3>
                  </div>
                <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="fullname">Full name:</label>
                            <input type="text" class="form-control {{ $errors->has('fullname') ? 'is-invalid' : '' }}" 
                                id="fullname" name="fullname" value="{{ old('fullname') != null ? old('fullname') : $user->fullname }}" placeholder="Fullname">
                            @if ($errors->has('fullname'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('fullname') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                id="email" name="email" value="{{ old('email') != null ? old('email') : $user->email }}" placeholder="email">
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
@endsection