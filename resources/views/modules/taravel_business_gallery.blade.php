@extends('admin.layouts.taravel2')
@section('head')
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about_responsive.css')}}">
@endsection
@section('content')
<div class="home">
    <div class="background_image" style="background-image:url({{asset('storage/hdpics/Dinayag.jpg')}}); filter:blur(2px);"></div>
</div>
<div class="container">
    <br>
    <br>
    <br>
    <br>
@foreach ($business as $b)
<h1 class="my-4 text-center text-lg-left">{{strtoupper($b->business_name)}} Gallery</h1>

      <div class="row text-center text-lg-left">
          @foreach($gallery->where('business_profile_id',$b->id) as $g)
            <div class="col-lg-3 col-md-4 col-xs-6">
                <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="{{url($g->photo_url)}}" alt="">
                </a>
            </div>
          @endforeach
      </div>

    <!-- /.container -->


    @endforeach
 </div>
 @endsection
