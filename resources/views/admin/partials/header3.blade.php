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
          <link rel="stylesheet" type="text/css" href="{{url('theme/styles/bootstrap4/bootstrap.min.css')}}">
          <link href="{{url('theme/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
          <link rel="stylesheet" type="text/css" href="{{url('theme/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
          <link rel="stylesheet" type="text/css" href="{{url('theme/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
          <link rel="stylesheet" type="text/css" href="{{url('theme/plugins/OwlCarousel2-2.2.1/animate.css')}}">
          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    {{-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"
          rel="stylesheet"
          type="text/css"/> --}}
          {{-- <link rel="stylesheet" href="{{url('css/app.css')}}"> --}}
          {{-- <link rel="stylesheet" type="text/css" href="{{url('css/style.css')}}"> --}}
          <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<header class="header">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="header_content d-flex flex-row align-items-center justify-content-start">
                    <div class="header_content_inner d-flex flex-row align-items-end justify-content-start">
                        <div class="logo"><a href="{{url('/')}}"> <img src="{{url('/storage/taravel_icon.png')}}" style="height:70px; width:150px;"></a>

                        </div>
                        <nav class="main_nav">
                            <ul class="d-flex flex-row align-items-start justify-content-start">
                                {{-- <li><a href="{{url('/taravel/home')}}">Home</a></li> --}}
                                <li @if(Request::path()=="taravel/tourist_destination") class="active" @endif ><a href="{{url('/taravel/tourist_destination')}}">Tourist Destination</a></li>
                                <li @if(Request::path()=="taravel/hotelandresorts") class="active" @endif><a href="{{url('/taravel/hotelandresorts')}}">Hotel and Resort</a></li>
                                <li @if(Request::path()=="taravel/restaurant")class="active" @endif><a href="{{url('/taravel/restaurant')}}">Restaurants</a></li>
                                <li @if(Request::path()=="taravel/agency")class="active" @endif><a href="{{url('/taravel/agency')}}">Travel Agency</a></li>
                                {{-- <li><a href="{{url('/taravel/things-to-do')}}">Things To do</a></li> --}}


                     @if (Route::has('login'))
                            {{-- <div class="top-right links"> --}}
                                @auth
                                    @if(Auth::user()->role_id == 3)
                                    <li><a href="{{ url('edit/profile/') }}">Profile</a></li>
                                    <li>
                                            {{-- {!! Form::open(['url' => 'logout']) !!} --}}
                                            <button onclick="sayHello()" style="background-color: Transparent;
                                            background-repeat:no-repeat;
                                            border: none;
                                            cursor:pointer;
                                            overflow: hidden;
                                            outline:none; color:white"  class="bot" type="submit" class="logout">
                                                {{-- <i class="fa fa-sign-out fa-fw"></i> --}}
                                                <span class="title">Logout</span>
                                            </button>
                                            {{-- {!! Form::close() !!} --}}
                                        </li>

                                        @else
                                        <li><a href="{{ url('/admin') }}">Admin</a></li>
                                    @endif

                                @else
                                    <li><a href="{{ route('login') }}">Login</a></li>
            {{--
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}">Register</a>
                                    @endif --}}
                                @endauth
                            {{-- </div> --}}
                        @endif
                        @auth

                        <li><a href="{{url('/taravel/custom/packages')}}"><i style="color:white;" class="fas fa-shopping-cart"></i></a></li>
                      @endauth  </ul>
                    </nav>
                        <!-- Hamburger -->

                        <div class="hamburger ml-auto">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="header_social d-flex flex-row align-items-center justify-content-start">
        <ul class="d-flex flex-row align-items-start justify-content-start">
            <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
        </ul>
    </div> --}}
    <div class="menu">
            <div class="menu_header d-flex flex-row align-items-center justify-content-start">
                <div class="menu_logo"><a href="{{url('/')}}">Taravel</a></div>
                <div class="menu_close_container ml-auto"><div class="menu_close"><div></div><div></div></div></div>
            </div>
            <div class="menu_content">
                <ul>
                    {{-- <li><a href="{{url('/taravel/home')}}">Home</a></li> --}}
                    <li><a href="{{url('/taravel/tourist_destination')}}">Tourist Destination</a></li>
                    <li><a href="{{url('/taravel/hotelandresorts')}}">Hotel and Resort</a></li>
                    <li><a href="{{url('/taravel/restaurant')}}">Restaurants</a></li>
                    <li><a href="{{url('/taravel/agency')}}"> Travel Agency</a></li>
                    {{-- <li><a href="{{url('/taravel/things-to-do')}}">Things To do</a></li> --}}
                    @if (Route::has('login'))
                            {{-- <div class="top-right links"> --}}
                                @auth
                                     @if(Auth::user()->role_id == 3)
                                    <li>
                                            {{-- {!! Form::open(['url' => 'logout']) !!} --}}
                                            <button onclick="sayHello()"  style="background-color: Transparent;
                                            background-repeat:no-repeat;
                                            border: none;
                                            cursor:pointer;
                                            overflow: hidden;
                                            outline:none; "  class="bot" type="submit" class="logout">
                                                {{-- <i class="fa fa-sign-out fa-fw"></i> --}}
                                                <h4 class="title">{{ trans('quickadmin::admin.partials-sidebar-logout') }}</h4>
                                            </button>
                                            {{-- {!! Form::close() !!} --}}
                                        </li>
                                        @else
                                        <li><a href="{{ url('/admin') }}">Admin</a></li>
                                    @endif
                                    {{-- <li><a href="{{ url('/admin') }}">Admin</a></li> --}}
                                @else
                                    <li><a href="{{ route('login') }}">Login</a></li>
            {{--
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}">Register</a>
                                    @endif --}}
                                @endauth
                            {{-- </div> --}}
                        @endif
                        @auth

                        <li><a href="{{url('/taravel/custom/packages')}}"><i style="color:white;" class="fas fa-shopping-cart"></i></a></li>
                      @endauth
                </ul>

            </div>
            {{-- <div class="menu_social">
                <div class="menu_phone ml-auto">Call us: 00-56 445 678 33</div>
                <ul class="d-flex flex-row align-items-start justify-content-start">
                    <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                </ul>
            </div> --}}
        </div>
</header>


<script type="text/javascript">
    function sayHello()
    {
        var retVal = confirm("Do you want to logout ?");
        if( retVal == true ){
            window.location = "{{url('logout')}}"
            // return true;
        }else{
            // Document.write ("User does not want to continue!");
            return false;
        }
    //  document.write ("Hello there!");

    }
    </script>
