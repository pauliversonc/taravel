@extends('admin.layouts.taravel2')
@section('head')
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about_responsive.css')}}">
@endsection
@section('content')
<div class="home">
    <div class="background_image" style="background-image:url('{{empty($gallery[0]->photo_url)?'':url($gallery[0]->photo_url)}}')"></div>
</div>
<div class="container">
    <br>
    <br>
    <br>
    <br>
<h1 class="my-4 text-center text-lg-left">{{strtoupper($tourist->name)}} Gallery</h1>
      <div class="row text-center text-lg-left">

          @foreach($gallery as $g)
            <div class="col-lg-3 col-md-4 col-xs-6">
                <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="{{url($g->photo_url)}}" alt="">
                </a>
            </div>
          @endforeach
      </div>
    </div>
    <!-- /.container -->
    @endsection
    @section('footer')
    <script src="{{url('theme/js/about.js')}}"></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?AIzaSyB5-r89NnLCwkmYEr-otFPRQ2qE60ZOxEw&callback=initMap" async defer></script> --}}

    @endsection
