@extends('adminlte::page')

@section('title', 'Admin | Edit category')

@section('content_header')
    <h1>Edit category</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit category - ID: {{$category->id}}</h3>
                      </div>
                    <form action="{{route('admin.categories.update', $category->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="categoryName">Name:</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                    id="categoryName" name="name" value="{{ old('name') != null ? old('name') : $category->name }}" placeholder="Category name">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="categoryDescription">Description:</label>
                                <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" 
                                    id="categoryDescription" name="description" value="{{ old('description') != null ? old('description') : $category->description }}" placeholder="Description">
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