@extends('layouts.app')

@section('title')
<title>BT School | My course</title>    
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 text-center mb-3">
            @if($courses->isEmpty())
                <h3>You have not taken any courses yet</h3>
            @else
                <h1>My Course</h1>
            @endif
        </div>
        <div class="col-12">
            <div class="tab-content row">
                @foreach($courses as $course)
                    <div class="col-4 mb-4">
                        <div class="row">
                            <div class="card col-11 pt-3">
                                <img class="card-img-top" style="height: 20vmin" src="{{config('app.url')}}/{{  $course->image }}" alt="Card image cap">
                                <div class="pt-2 text-center">
                                    <h5 class="card-title mb-1">{{ $course->name }}</h5>
                                    <p class="card-text mb-1">{{ $course->description}}</p>
                                    <a href="{{ route("myCourses.show", $course->id)}}" class="btn btn-primary mb-3 btn-block">View course</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                @endforeach
            </div>
            <div>
                <ul class="pagination pagination-sm m-0 justify-content-center">
                    {{$courses->links('vendor.pagination.custom')}}
                </ul>
            </div>
        </div>
        
      </div>
</div>
@endsection