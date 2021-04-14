<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Taravel
    </title>

    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0"
          name="viewport"/>
    <meta http-equiv="Content-type"
          content="text/html; charset=utf-8">

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"
          rel="stylesheet"
          type="text/css"/>
          {{-- <link rel="stylesheet" href="{{url('css/app.css')}}"> --}}
          <link rel="stylesheet" type="text/css" href="{{url('css/style.css')}}">
          <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="page-header-fixed">
        <div class="index-wrapper-tourist" style="width: 100%; height: auto;" >


                <header style="width: 100%;  height: 100%;">

                  <nav style="position: fixed; width: 100%;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); z-index: 100; " class="navbar navbar-expand-lg navbar-dark bg-primary" >
                  <a class="navbar-brand" href="{{url('/')}}"><img src ="{{url('/storage/taravel_black_logo.png')}}" style="width: auto; height: auto;max-width: 160px"></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="{{url('/taravel/home')}}">Home<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{url('/taravel/tourist_destination')}}">Tourist Destinations</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{url('/taravel/hotelandresorts')}}">Hotels & Resorts</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{url('/taravel/restaurant')}}">Restaurants</a>
                  </li>
                  <li class="nav-item">
                    <!--Search Button-->
                     <button class="btn btn-primary"  style="cursor: pointer; padding: 0px; margin-top: 8px; color: gray; font-weight: bold; margin-left: 150px;" onclick="openNav()">Search</button>
                  </li>
                  @auth
                  <li class="nav-item">
                        {!! Form::open(['url' => 'logout']) !!}
                        <button class="nav-link" type="submit" class="logout" style="background: none; border:none;">
                            <i class="fa fa-sign-out fa-fw"></i>
                            <span class="title">{{ trans('quickadmin::admin.partials-sidebar-logout') }}</span>
                        </button>
                        {!! Form::close() !!}
                  </li>

                  @else
                  <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                <li class="nav-item">
                <a class="nav-link" href="{{url('register/user')}}">Sign Up</a>
                @endauth
                </li>
                </ul>


                <div id="myNav" class="overlay">
                  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <div class="overlay-content">
                      <!-- FORM -->
                      <form action="{{url('search')}}" method="get" enctype="multipart/form-data">
                        {{csrf_field()}}
                          <input name="search" style="width: 50%; height: 50px; position: center; display: inline-block;" type="text" class="form-control" placeholder="Look for a Happy Place" >

                          <input type="submit" style="margin-top: -4px; position: center; height: 50px; display: inline-block;" class="btn btn-secondary">
                      </form>

                    </div>
                </div>
                    <!-- Curtain Search -->
            <script>
            function openNav() {
              document.getElementById("myNav").style.height = "50%";
            }

            function closeNav() {
              document.getElementById("myNav").style.height = "0%";
            }
            </script>

              </div>
            </nav>
                </header>
<br>