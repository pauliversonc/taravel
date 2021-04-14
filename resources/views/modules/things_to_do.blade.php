@extends('admin.layouts.taravel2')

@section('head')
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/news.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/destinations.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/news_responsive.css')}}">

<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about_responsive.css')}}">
@endsection

@section('content')
<div class="home">
		<div class="background_image" style="background-image:url({{url('theme/images/travel.jpg')}})"></div>
	</div>
    @include('partials.search-bar');
<style>
    .why{
        top: -5em;
    }
    </style>
    <div class="why">
            <div class="parallax_background parallax-window" data-parallax="scroll" style="background-color:white;"></div>
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="section_subtitle" style="color:grey;">simply amazing places</div>
                        <div class="section_title"><h2 style="color:black;">Things to Do</h2></div>
                    </div>
                </div>
                <div class="row why_row">
                    <div class="col-lg-10">
                    <!-- Why item -->
                    @foreach($things as $t)
                    <style>
                        .why_item{
                            transition: transform .2s;
                        }
                        .why_item:hover{
                            -webkit-transform: scale(1.1);
                        }
                        .why_title:hover{
                            text-decoration: underline;
                        }
                        </style>
                    <!-- Why item -->
                    <div class="col-lg-4 why_col">
                            <a style="color:black;" href="{{url('/things-todo/profle/'.$t->id)}}"> <div class="why_item" style="box-shadow:0 4px 8px grey">
                            <div class="why_image">
                                <img height="200px" width="400px" src="{{ asset('uploads') . '/'.  $t->photo }}" alt="">
                                <div class="why_icon d-flex flex-column align-items-center justify-content-center">
                                    <img src="{{url('theme/images/why_3.svg')}}" alt="">
                                </div>
                            </div>
                            <div class="why_content text-center" style="background-color:#f5f5f5;">
                                <div class="why_title" >{{$t->name}}</div>
                                <div class="why_text">
                                    <p>{{$t->address}}</p>
                                </div>
                            </div>
                        </div></a>
                    </div>
                    @endforeach
                </div>
                <div class="col-lg-2">
                        <div class="news_sidebar">
        
                            <!-- Categories -->
                              <!-- Categories -->
                              <div class="categories">
                                    <form action="{{url('taravel/things-to-do')}}" method="post">
                                        {{ csrf_field() }}
        
                                @if ($region->count())
        
                                <div class="sidebar_title">Region</div>
                                <div class="sidebar_list">
                                    <ul>
                                            @foreach ($region as $re)
                                        <li><div class="d-flex flex-row align-items-start justify-content-start"> <input type="checkbox" name="filter_region[]" value="{{$re->name}}">{{$re->name}}</div></li>
                                        @endforeach
                                        <br>
                                    </ul>
                                </div>
                                @endif
                                {{-- <button type="submit" class="form-control btn btn-primary">Filter</button> --}}
                                <button class="home_search_button" type="submit" >Filter</button>
                            </form>
                            </div>
        
                            <!-- Latest News -->
        
        
        
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
       

@endsection
@section('footer')
<script src="{{url('theme/js/news.js')}}"></script>
@endsection
