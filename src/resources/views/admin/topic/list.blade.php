@extends('adminlte::page')

@section('title', 'Admin | List of topics')

@section('content_header')
    <h1>List of topics</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><a href="{{ route('admin.topics.create') }}" class="text-green"><i class="fas fa-plus text-green"></i> Create new topic</a></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Trainer</th>
                        <th class="text-center">Course</th>
                        <th colspan="2" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topics as $topic)
                        <tr>
                            <td class="text-center align-middle">{{ ($topics->currentPage() - 1)  * $topics->perpage() + $loop->iteration }}</td>
                            <td class="align-middle">{{ $topic->name }}</td>
                            <td class="align-middle">{{ $topic->description }}</td>
                            <td class="align-middle">
                                @if($topic->user != null) 
                                    {{$topic->user->username}}
                                @else
                                    <span class="text-red">Empty</span>
                                @endif 
                            </td>
                            <td class="align-middle">
                                @if($topic->course != null) 
                                    {{$topic->course->name}}
                                @else
                                    <span class="text-red">Empty</span>
                                @endif 
                            </td>
                            <td class="text-center align-middle"><a href="{{ route('admin.topics.edit', $topic->id) }}"><i class="fas fa-edit text-blue"></i></a></td>
                            <td class="align-middle">
                                <form action="{{ route('admin.topics.destroy',$topic->id) }}" method="POST">
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
                {{$topics->links('vendor.pagination.custom')}}
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