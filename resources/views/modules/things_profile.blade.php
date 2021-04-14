@extends('admin.layouts.taravel2')

@section('head')
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about_responsive.css')}}">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
/*Now the styles*/
* {
    margin: 0;
	padding: 0;
}
body {
	background: #ffffff;
	font-family: arial, verdana, tahoma;
}

/*Time to apply widths for accordian to work
Width of image = 640px
total images = 5
so width of hovered image = 640px
width of un-hovered image = 40px - you can set this to anything
so total container width = 640 + 40*4 = 800px;
default width = 800/5 = 160px;
*/

.accordian {
	width: 805px; height: 320px;
	overflow: hidden;

	/*Time for some styling*/
	margin: 100px auto;
	box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.35);
	-webkit-box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.35);
	-moz-box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.35);
}

/*A small hack to prevent flickering on some browsers*/
.accordian ul {
	width: 2000px;
	/*This will give ample space to the last item to move
	instead of falling down/flickering during hovers.*/
}

.accordian li {
	position: relative;
	display: block;
	width: 160px;
	float: left;

	border-left: 1px solid #888;

	box-shadow: 0 0 25px 10px rgba(0, 0, 0, 0.5);
	-webkit-box-shadow: 0 0 25px 10px rgba(0, 0, 0, 0.5);
	-moz-box-shadow: 0 0 25px 10px rgba(0, 0, 0, 0.5);

	/*Transitions to give animation effect*/
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
	/*If you hover on the images now you should be able to
	see the basic accordian*/
}

/*Reduce with of un-hovered elements*/
.accordian ul:hover li {width: 40px;}
/*Lets apply hover effects now*/
/*The LI hover style should override the UL hover style*/
.accordian ul li:hover {width: 640px;}


.accordian li img {
	display: block;
}

/*Image title styles*/
.image_title {
	background: rgba(0, 0, 0, 0.5);
	position: absolute;
	left: 0; bottom: 0;
width: 640px;

}
.image_title a {
	display: block;
	color: #fff;
	text-decoration: none;
	padding: 20px;
	font-size: 16px;
}
</style>
@endsection

@section('content')

<div class="home">
        <div class="background_image" style="background-image:url('{{url('/uploads/'.$profile->photo)}}')"></div>
    </div>
    {{-- <div class="bottom-left-image-zoom-gallery" style="color: white;"><a href="">Gallery</a></div> --}}
    <div class="about">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="section_subtitle">simply amazing things to do</div>
                    <div class="section_title"><h2>{{$profile->name}}</h2></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="accordian">
                            <ul>
                                @if ($gallery->count())
                                    @foreach ($gallery as $i)
                                <li>
                                    <div class="image_title">
                                    <a href="#">{{$profile->name}}</a>
                                    </div>
                                    <a href="#">
                                        <img width="500px" height="400px;" src="{{url($i->photo_url)}}"/>
                                    </a>
                                </li>
                                     @endforeach
                                @endif

                            </ul>
                        </div>

                    </div>
                </div>
<div class="row">
    @if ($festival->count())
    @foreach ($festival as $item)

<div class="col-sm-3">

    <div class="news_post">
            <div class="news_post_image"><img src="{{url('/uploads/'.$item->photo)}}"   alt="" style="width:100%;height:200px;"></div>
            <div class="news_post_content">
                <div class="news_post_date d-flex flex-row align-items-end justify-content-start">
                    {{-- <div>02</div> --}}
                    <div></div>
                    <div>{{$item->name}}</div>

                </div>
                {{-- <div class="news_post_title"><a href="">{{$item->name}}</a></div> --}}

                <div class="news_post_text">
                    <p>{{$item->description}}</p>
                </div>
            </div>
        </div>
</div>  @endforeach
    @endif

</div>
            </div>
        </div>
        <div class="about">
                <div class="container">

                    <div class="row about_row">
                        <div class="col-lg-6">
                            <div class="about_content">
                                <div class="text_highlight">DESCRIPTION</div>
                                <div >
                                <p>{!!$profile->about!!}</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about_content">
                                <div class="text_highlight">Contact</div>
                                <div >
                                <p>{!!$profile->contact!!}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div style="overflow:hidden; width: 90%; height: auto;  margin: 5%; padding: 2%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

        <h3>Comments</h3>
                <input type='hidden' name="post_id" value="" >
            <br>
            <div class="jumbotron jumbotron-fluid " style="height:auto; overflow:auto; padding:5px;">
                    <style>
                            .comm {
                                padding: 5px;
                                margin:auto;
                                list-style-type: none;
                                width: 80%;
                                color:black;
                                }
                            </style>

@if ($comment->count())


@foreach ($comment as $item)


                 <ul class="comm">
                   <li>
                   <h6><b>{{$item->name}}</b></h6>
                   </li>
                <li style="margin-left:100px;">
                       <p>{{$item->comment}} </p>
                <small style="color:dimgrey;">{{\Carbon\Carbon::parse($item->date)->diffForHumans()}}</small>
                    </li>
               </ul>
               <hr style="border: 0.5px solid black;">
   @endforeach
   @else
               <p>No comments</p>

               @endif

            </div>
            <br><br>
            @auth
            <form action="{{url('/things-todo/comment')}}" method="post">

                {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$profile->id}}">
            <div class="jumbotron" style="text-align:center;">
                <textarea  name="comment" cols="100" rows="5" placeholder="Write your comment.."></textarea>
                <div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
            </div>
            </form>
            @else
            <div style="background:lightgrey; text-align:center;">
            <h4>Please <a style="color:blue;" href="{{route('login')}}">Log in</a> or <a style="color:blue;" href="{{url('register/user')}}">Sign up</a> to participate in comment section</h4>
            </div>
            @endauth

        </div>
        {{-- <div style="overflow:hidden; width: 90%; height: auto;  margin: 5%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <br>
            <h3 style="margin-left:10px;">Suggested locations for you</h3>

            <div class="wrapper-polaroid" style="width: 250px; margin: 1%; height: 300px; float: left; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div style="width: 250px; height: 200px; background-color: white; padding: 5%;">
                <a href=""><img src="" style="width: 100%; height: 100%;"></a>
                </div>
                <div class="polaroidtitle" style="height: 100px; width: 250px; padding: 5%; background-color: white; color: black; text-transform: uppercase; color: black; font-weight: bold; width :100%;overflow:hidden;text-overflow: ellipsis; text-align: center;" >
                    <a href="">

                     </a>
                </div>
            </div>



              </div> --}}
              <script>
          </script>
@endsection
@section('footer')
<script src="{{url('theme/js/about.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?AIzaSyB5-r89NnLCwkmYEr-otFPRQ2qE60ZOxEw&callback=initMap" async defer></script>

@endsection
