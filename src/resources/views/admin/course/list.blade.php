@extends('adminlte::page')

@section('title', 'Admin | List of courses')

@section('content_header')
    <h1>List of courses</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><a href="{{ route('admin.courses.create') }}" class="text-green"><i class="fas fa-plus text-green"></i> Create new course</a></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center align-middle">#</th>
                        <th class="text-center align-middle">Name</th>
                        <th class="text-center align-middle">Description</th>
                        <th class="text-center align-middle">Image</th>
                        <th class="text-center "><p class="align-middle mb-0">Number of sessions</p></th>
                        <th class="text-center align-middle">Shift</th>
                        <th class="text-center align-middle">Start date</th>
                        <th class="text-center align-middle">End date</th>
                        <th class="text-center align-middle">Category</th>
                        
                        <th colspan="3" class="text-center align-middle">Actions</th>
                    </tr>
                    
                </thead>
                <tbody>
                    @foreach($courses as $key=>$course)
                        <tr>
                            <td class="text-center align-middle">{{ ($courses->currentPage() - 1)  * $courses->perpage() + $loop->iteration }}</td>
                            <td class="align-middle"><a href="{{ route('admin.courses.show', $course->id) }}">{{ $course->name }}</a></td>
                            <td class="align-middle">{{ $course->description }}</td>
                            <td class="align-middle text-center">
                                <img src="{{config('app.url')}}/../{{  $course->image }}" class="img-fluid pad" style="width:150px; height:80px;" alt="Course Image">
                            </td>
                            <td class="text-center align-middle">{{ $course->numberOfSessions }}</td>
                            <td class="text-center align-middle">{{ $course->shift}}</td>
                            <td class="text-center align-middle">{{ $course->startDate }}</td>
                            <td class="text-center align-middle">{{ $course->endDate }}</td>
                            <td class="align-middle">
                            @if($course->category != null) 
                                {{$course->category->name}}
                            @else
                                <span class="text-red">Empty</span>
                            @endif 
                            </td>
                           
                         

                            <td class="text-center align-middle"><a href="{{ route('admin.courses.edit', $course->id) }}"><i class="fas fa-edit text-blue"></i></a></td>
                            <td class="align-middle">
                                <form action="{{ route('admin.courses.destroy',$course->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-block"><i class="fas fa-trash text-red"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 justify-content-center">
                {{$courses->links('vendor.pagination.custom')}}
            </ul>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop