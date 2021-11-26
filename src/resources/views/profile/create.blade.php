@extends('layouts.app')

@section('title')
<title>BT School | Add new info</title>    
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create new info</h3>
                  </div>
                <form action="{{route('profiles.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="key">Key:</label>
                            <input type="text" class="form-control {{ $errors->has('key') ? 'is-invalid' : '' }}" 
                                id="key" name="key" value="{{ old('key') }}" placeholder="Key">
                            @if ($errors->has('key'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('key') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="value">Value:</label>
                            <input type="text" class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" 
                                id="value" name="value" value="{{ old('value') }}" placeholder="Value">
                            @if ($errors->has('value'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('value') }}</strong>
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