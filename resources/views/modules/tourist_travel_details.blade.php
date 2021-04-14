@extends('admin.layouts.taravel2')

@section('head')
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about_responsive.css')}}">
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

@endsection

@section('content')
<?php $total=0; $average_rating=0; $counter1=0; $counter2=0; $counter3=0;$counter4=0; $counter5=0;?>
                @foreach ($rates as $item)
                     @if($item->rate=="5")
                     <?php $counter5++;
                     $total+=$item->rate;
                     ?>
                     @endif
                     @if($item->rate=="4")
                     <?php $counter4++;
                     $total+=$item->rate;
                     ?>
                     @endif
                     @if($item->rate=="3")
                     <?php $counter3++;
                     $total+=$item->rate;
                     ?>
                     @endif
                     @if($item->rate=="2")
                     <?php $counter2++;
                     $total+=$item->rate;
                     ?>
                     @endif
                     @if($item->rate=="1")
                     <?php $counter1++;
                     $total+=$item->rate;
                     ?>
                     @endif
                @endforeach
<div class="home">
        <div class="background_image" style="background-image:url('{{url('/uploads/'.$details->photo)}}')"></div>
    </div>

    <nav aria-label="breadcrumb" class="breadcrumb d-flex justify-content-between"  style="margin-bottom:-40px">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/taravel/tourist_destination')}}">Tourist Destination</a></li>
          <li class="breadcrumb-item active"><a href="#">Profile</a></li>
          </ol>
          <a href="{{url('gallery/tourist/'.$details->id)}}">Gallery</a>
      </nav><br>
    <div class="about">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="section_subtitle">simply amazing tourist destination</div>
                        <div class="section_title"><h2>{{$details->name}}</h2></div>
                    </div>
                </div>
                <div class="row about_row">
                    <div class="col-lg-6">
                        <div class="about_content">
                            <div class="text_highlight">ADDRESS</div>
                            <div >
                                <p>{{$details->address}}</p>
                            </div>
                            <div class="text_highlight">THIS IS GOOD MOSTLY FOR</div>
                            <div >
                                <p>{{$details->mostly_good}}</p>
                            </div>
                            <div class="text_highlight">WEBSITE</div>
                            <div >
                                <p>{{$details->website}}</p>
                            </div>
                            <div class="text_highlight">TARAVEL REVIEW</div>
                            <div >
                                <p> @if($rates->count()>0)
                                        <?php
                                        $average_rating=number_format(($total/($counter1+$counter2+$counter3+$counter4+$counter5)),1);
                                        $rating= $average_rating;?>


                                                @foreach(range(1,5) as $x)
                                                <span class="fa-stack" style="width:1em">
                                                    <i class="far fa-star fa-stack-1x"></i>

                                                    @if($rating >0)
                                                        @if($rating >0.5)
                                                            <i class="fas fa-star fa-stack-1x" style="color:tomato;"></i>
                                                        @else
                                                            <i class="fas fa-star-half fa-stack-1x" style="color:tomato;"></i>
                                                        @endif
                                                    @endif
                                                    @php $rating--; @endphp
                                                </span>
                                                @endforeach
                                        @else
                                            {{"NO RATING"}}
                                        @endif</p>
                            </div>
                            {{-- <div class="button about_button"><a href="#">read more</a></div> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div id="map" style="width: 100%; height: 90%; float: right; background-color: skyblue; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

                            </div>
                    </div>
                </div>
                <form action="{{url('tag')}}" method="get" enctype="multipart/form-data">
                    {{csrf_field()}}
                <div class="row" style="margin:10px;">
                    <label style="color:black;"> <b>Tags: &nbsp; </b></label>
                    @foreach ($tags as $item)
                    <button name="tag" value="{{$item->categorytags_id}}" type="submit" style="border:none; margin-left:2px;"><span class="badge badge-info" style="background:blue;0">{{$item->_name}}</span></button>
                    @endforeach
                </div>
                </form>
            </div>
        </div>
        <div class="about">
                <div class="container">

                    <div class="row about_row">
                        <div class="col-lg-12">
                            <div class="about_content">
                                <div class="text_highlight">DESCRIPTION</div>
                                <div >
                                    <p>{{$details->description}}</</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <div class="about">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="section_title"><h2>REVIEWS BREAKDOWN</h2></div>
                    </div>
                </div>
                <div class="row about_row">
                    <div class="col-lg-12">
                        <div class="about_content">
                            <div class="text_highlight">RATINGS</div>
                            <div class="row  ">


                                <div class="col-sm-2">
                                    <p><h2 style="text-align:center;">
                                    @if($rates->count()>0)
                                    <?php
                                    $average_rating=number_format(($total/($counter1+$counter2+$counter3+$counter4+$counter5)),1);
                                    echo $average_rating;?>
                                    @else
                                        {{"NO RATING"}}
                                    @endif
                                    </h2></p>
                                   <p style="text-align:center;">Total number of review(s) :  {{($counter1+$counter2+$counter3+$counter4+$counter5)}}</p>

                                </div>
                                <div class="col-sm-4 jumbotron">

                                       <ul>
                                           <li><h6>5: {{ $counter5}} </h6> </li>
                                           <li><h6>4: {{$counter4}}</h6> </li>
                                           <li><h6>3: {{$counter3}}</h6> </li>
                                           <li><h6>2: {{ $counter2 }}</h6> </li>
                                           <li><h6>1: {{$counter1}}</h6> </li>
                                       </ul>

                                </div>

                                <div class="col-sm-6" style="padding:10px;">
                                    <h2>Rate</h2>
                                    <form action="{{url('travellers/tourist/rate')}}" method="post" style="width: auto; ">
                                        {{csrf_field()}}
                                        <input type='hidden' name="post_id" value="{{$details->id}}" >
                                        <style>
                                        .rb{
                                            margin-left:5px;
                                        }
                                        </style>
                                       @auth


                                       {{-- <input class="rb" type="radio" name="rate"
                                              {{$status1}} value="1">1
                                       <input class="rb" type="radio" name="rate"
                                                {{$status2}} value="2">2
                                       <input class="rb" type="radio" name="rate"
                                                {{$status3}} value="3">3
                                       <input class="rb" type="radio" name="rate"
                                               {{$status4}} value="4">4
                                       <input class="rb" type="radio" name="rate"
                                               {{$status5}} value="5">5 --}}
                                               <?php $rate = 0  ?>
                                               @foreach ($rates->where('user_id',Auth::user()->id) as $item)
                                                    <?php $rate = $item->rate ?>
                                               @endforeach
                                    <input id="input-1" name="rate" class="rating rating-loading" value="
                                    {{ $rate!=0?$rate:0}}" data-min="0" data-max="5" data-step="1" data-size="sm">
                                    <button style="margin-left:10px;" type="submit" name="submit" class="btn btn-primary btn-sm">Rate </button>
                                      @else
                                        <div style="background:lightgrey; text-align:center;">
                                            <h5>Please <a style="color:blue;" href="{{route('login')}}">Log in</a> or <a style="color:blue;" href="{{url('register/user')}}">Sign up</a> to rate</h5>
                                            </div>
                                            @endauth
                                    </form>
                            </div>

                          </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div style="overflow:hidden; width: 90%; height: auto;  margin: 5%; padding: 2%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <form action="{{url('travellers/tourist/comment')}}" method="post" style="width: auto; ">
                {{csrf_field()}}
        <h3>Comments</h3>
                <input type='hidden' name="post_id" value="{{$details->id}}" >
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

                @if($comments->count()>0)
                @foreach ($comments as $item)
                 <ul class="comm">
                   <li>
                        <h6><b>{{$item->firstname}} {{$item->lastname}}</b></h6>
                   </li>
                <li style="margin-left:100px;">
                       <p> {{$item->comment}} </p>
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
            <div class="jumbotron" style="text-align:center;">
                <textarea  name="comment" cols="100" rows="10" placeholder="Write your comment.."></textarea>
                <div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
            </div>
            @else
            <div style="background:lightgrey; text-align:center;">
            <h4>Please <a style="color:blue;" href="{{route('login')}}">Log in</a> or <a style="color:blue;" href="{{url('register/user')}}">Sign up</a> to participate in comment section</h4>
            </div>
            @endauth
            </form>
        </div>
        <div style="overflow:hidden; width: 90%; height: auto;  margin: 5%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <br>
            <h3 style="margin-left:10px;">Suggested locations for you</h3>
            <style>
                    .suggested{
                        transition: transform .2s;
                    }
                    .suggested:hover{
                        -webkit-transform: scale(1.1);
                    }

                    </style>
            @if (count($suggested)>0)
            @foreach ($suggested as $item)
            <div class="suggested" style="width: 250px; margin: 1%; height: 300px; float: left; ">
                <div style="width: 250px; height: 200px; background-color: white; padding: 5%;">
                <a href="{{url('get/tourist_details/'.$item->id)}}"><img src="{{ asset('uploads') . '/'. $item->photo}}" style="width: 100%; height: 100%;"></a>
                </div>
                <div  style="height: 100px; width: 250px; padding: 5%; background-color: white; color: black; text-transform: uppercase; color: black; font-weight: bold; width :100%;overflow:hidden;text-overflow: ellipsis; text-align: center;" >
                    <a  href="{{url('get/tourist_details/'.$item->id)}}">
                        {{$item->name}}
                     </a>
                </div>
            </div>
                     @endforeach
            @endif
              </div>
              <script>
                var map;
                var lat;
                var lng;
                var marker;
                function initMap() {
                    lat = parseFloat("{{$details->lat}}");
                    lng = parseFloat("{{$details->lng}}");
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: lat, lng: lng},
                        zoom: 17
                    });
                    marker = new google.maps.Marker({position: {lat: lat, lng: lng}, map: map});
                }
          </script>
@endsection
@section('footer')
<script>
        $("#input-id").rating();
        </script>
<script src="{{url('theme/js/about.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?AIzaSyB5-r89NnLCwkmYEr-otFPRQ2qE60ZOxEw&callback=initMap" async defer></script>

@endsection
