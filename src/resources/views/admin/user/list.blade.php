@extends('adminlte::page')

@section('title', 'Admin | List of users')

@section('content_header')
    <h1>List of users</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><a href="{{ route('admin.users.create') }}" class="text-green"><i class="fas fa-plus text-green"></i> Create new user</a></h3>
            <form class="form-inline d-flex justify-content-end" action="{{route('admin.users.index')}}" method="GET">
                <input class="form-control mr-sm-2" name="key" type="search" 
                        placeholder="Search" aria-label="Search" required
                        @if ($usersData['key'])
                            value="{{$usersData['key']}}"
                        @endif
                >
                <select class="form-control mr-sm-2" name="type">
                    <option value="username" @if ("username" == $usersData['type']) selected @endif>Username</option>
                    <option value="fullname" @if ("fullname" == $usersData['type']) selected @endif>Full name</option>
                    <option value="email" @if ("email" == $usersData['type']) selected @endif>Email</option>
                    @foreach ($usersData['options'] as $option)
                        <option value="{{$option->key}}" @if ($option->key == $usersData['type']) selected @endif>{{$option->key}}</option>
                    @endforeach
                    
                </select>
                <button class="btn btn-success " type="submit">Search</button>
            </form>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center align-middle">#</th>
                        <th rowspan="2" class="text-center align-middle">Username</th>
                        <th rowspan="2" class="text-center align-middle">Fullname</th>
                        <th rowspan="2" class="text-center align-middle">Email</th>
                        <th rowspan="2" class="text-center align-middle">Avatar</th>
                        <th rowspan="2" class="text-center align-middle">Info</th>
                        <th colspan="{{count($usersData['roles'])}}" class="text-center align-middle">Roles</th>
                        <th colspan="3" rowspan="2" class="text-center align-middle">Actions</th>
                    </tr>
                    <tr>
                        @foreach ($usersData['roles'] as $role)
                            <th class="text-center">{{$role->name}}</th>
                        @endforeach  
                    </tr>
                </thead>
                <tbody>
                    @if($usersData['users']->total() == 0)
                    <tr>
                        <td colspan="11" class="text-center">No Results</td>
                    </tr>
                    @endif
                    @foreach($usersData['users'] as $key=>$user)
                        <tr>
                            <td class="text-center align-middle">{{ ($usersData['users']->currentPage() - 1)  * $usersData['users']->perpage() + $loop->iteration }}</td>
                            <td class="align-middle">{{ $user->username }}</td>
                            <td class="align-middle">{{ $user->fullname }}</td>
                            <td class="align-middle">{{ $user->email }}</td>
                            <td class="text-center">
                                @if($user->avatar)
                                    <img src="{{config('app.url')}}/../{{  $user->avatar }}" class="img-circle elevation-2" style="height: 60px; width:60px; " alt="User Image">
                                @endif
                            </td>
                            <td class="align-middle">
                                @foreach ($user->profiles as $profile)
                                    <span>{{$profile->key}}: {{$profile->value}}, </span>
                                @endforeach
                            </td>
                            @foreach ($usersData['roles'] as $role)
                                <td class="text-center align-middle">
                                    <input 
                                        type="checkbox" 
                                        disabled="" 
                                        @foreach ($user->roles as $userRole)
                                            @if ($userRole->name == $role->name) checked @endif
                                        @endforeach
                                    />
                                </td> 
                            @endforeach
                            <td class="align-middle">
                                @if ($user->blocked)
                                    <form action="{{ route('admin.user.unblock', ['user' => $user])}}">
                                        @csrf
                                        <button type="submit" class="btn btn-block btn-secondary">Unblock</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.user.block', ['user' => $user])}}">
                                        @csrf
                                        <button type="submit" class="btn btn-block btn-outline-secondary">Block</button>
                                    </form> 
                                @endif   
                            </td>
                            <td class="text-center align-middle"><a href="{{ route('admin.users.edit', $user->id) }}"><i class="fas fa-edit text-blue"></i></a></td>
                            <td class="align-middle">
                                <form action="{{ route('admin.users.destroy',$user->id) }}" method="POST">
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
                {{$usersData['users']->links('vendor.pagination.custom')}}
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