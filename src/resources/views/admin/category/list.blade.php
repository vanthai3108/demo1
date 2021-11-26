@extends('adminlte::page')

@section('title', 'Admin | List of categories')

@section('content_header')
    <h1>List of categories</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><a href="{{ route('admin.categories.create') }}" class="text-green"><i class="fas fa-plus text-green"></i> Create new category</a></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Description</th>
                        <th colspan="2" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td class="text-center align-middle">{{ ($categories->currentPage() - 1)  * $categories->perpage() + $loop->iteration }}</td>
                            <td class="align-middle">{{ $category->name }}</td>
                            <td class="align-middle">{{ $category->description }}</td>
                            <td class="text-center align-middle"><a href="{{ route('admin.categories.edit', $category->id) }}"><i class="fas fa-edit text-blue"></i></a></td>
                            <td class="align-middle">
                                <form action="{{ route('admin.categories.destroy',$category->id) }}" method="POST">
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
                {{$categories->links('vendor.pagination.custom')}}
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