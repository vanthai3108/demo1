@extends('layouts.app')

@section('title')
<title>BT School | Home </title>    
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div id="carouselExampleIndicators" class="carousel slide col-12"  data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active" style="height:42vmin">
                    <img class="d-block w-100" style="height:42vmin" src="https://4zy7s42hws72i51dv3513vnm-wpengine.netdna-ssl.com/wp-content/uploads/2018/01/twitter-7.jpg" alt="First slide">
                </div>
                <div class="carousel-item" style="height:42vmin">
                    <img class="d-block w-100" style="height:42vmin" src="https://whatis.techtarget.com/visuals/IoTAgenda/business_of_iot/iotagenda_article_003.jpg" alt="Second slide">
                </div>
                <div class="carousel-item" style="height:42vmin">
                    <img class="d-block w-100" style="height:42vmin" src="https://www.sergilehkyi.com/wp-content/uploads/2018/05/machine-learning-in-fin-services-potential-applications.jpg" alt="Third slide">
                </div>
                <div class="carousel-item" style="height:42vmin">
                    <img class="d-block w-100" style="height:42vmin" src="https://highskyit.com/wp-content/uploads/2019/05/cloud_banner_image.jpg" alt="Fourth slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="list-group">
                @foreach ($data['categories'] as $category)
                    <a class="list-group-item list-group-item-action {{ $category->id == $data['now_category'] ? "active": ""}}" href="{{ route('home', 'category='.$category->id)}}" role="tab">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>
        <div class="col-9">
            <div class="tab-content row">
                @foreach($data['courses'] as $course)
                    <div class="col-4 mb-4">
                        <div class="row">
                            <div class="card col-11 pt-3">
                                <img class="card-img-top" style="height: 20vmin" src="{{config('app.url')}}/{{  $course->image }}" alt="Card image cap">
                                <div class="pt-2 text-center">
                                    <h5 class="card-title mb-1">{{ $course->name }}</h5>
                                    <p class="card-text mb-1">{{ $course->description}}</p>
                                    @if ($course->users->contains(Auth::user()->id) || $course->topics->contains('user_id', '=', Auth::user()->id))
                                        <a href="{{ route("myCourses.show", $course->id)}}" class="btn btn-primary mb-3 btn-block">View course</a>
                                    @else
                                        <a href="{{ route('myCourses.joinCourse', $course->id) }}" class="btn btn-primary mb-3 btn-block">Join course</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> 
                @endforeach
            </div>
            <div>
                <ul class="pagination pagination-sm m-0 justify-content-center">
                    {{$data['courses']->links('vendor.pagination.custom-category', ['category' => $data['now_category']])}}
                </ul>
            </div>
        </div>
        
      </div>
</div>
@endsection
