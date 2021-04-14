@extends('admin.layouts.taravel2')

@section('head')
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/news.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/news_responsive.css')}}">
@endsection

@section('content')
<div class="home">
		<div class="background_image" style="filter:blur(2px); background-image:url({{asset('storage/hdpics/Dinayag.jpg')}})"></div>
	</div>
<br>
    <div class="container">
        <div class="row" style="background: #0E4D92;">
            <div class="col-sm-2"></div>
            <div class="col-sm-8" style="text-align:center;">
                    <h1 style="color:white;">Travel Agency Partners</h1>
            </div>
            <div class="col-sm-2"></div>
        </div>
<br>
<hr>
        <div class="row">

                    @foreach ($partner as $item)
                    <div class="col-sm-3">
                    <div class="card" style="width: 15rem; margin:5px;">
                            <a href="{{url('/taravel/agent-profile/'.$item->id)}}"><img class="card-img-top" height="100px;" src="{{url('/uploads/'.$item->photo)}}" alt="Card image cap"></a>
                            <div class="card-body">
                            <h4 class="card-text"><a href="{{url('/taravel/agent-profile/'.$item->id)}}">{{$item->name}}</a></h4>
                            </div>
                          </div>
                    </div>
                    @endforeach

        </div>
    </div>
<br>
@endsection
@section('footer')
<script src="{{url('theme/js/news.js')}}"></script>
@endsection
