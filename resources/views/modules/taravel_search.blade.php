@extends('admin.layouts.taravel2')

@section('head')
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/destinations.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/destinations_responsive.css')}}">
<style>
.item:hover{
    transform: scale(1.1);
}
.item{
    transition: transform .2s;
}
a:hover{
    text-decoration: underline;
}
.destinations{
    padding-bottom:50px;
}
.load_more_row{
    margin-top:-100px;
}
</style>
@endsection

@section('content')
<div class="home">
		<div class="background_image" style=" filter:blur(2px);background-image:url({{url('storage/hdpics/Ati-atihan.jpg')}})"></div>
	</div>

	<!-- Search -->
    {{-- @include('partials.search-bar'); --}}
    	<!-- Destinations -->
    @if(count($tour)!=0)
	<div class="destinations" id="destinations">
            <div class="container" >
                <div class="row">
                    <div class="col text-center">
                        <div class="section_subtitle">simply amazing places</div>
                        <div class="section_title"><h2>Tourist Destinations</h2></div>
                    </div>
                </div>

                <div class="row destinations_row">
                    <div class="col">
                        <div class="destinations_container item_grid" style="padding:50px;">
                            @if (!empty($tour))
                            <!-- Destination -->
                            @foreach ($tour as $c => $tour)

                            <div class="destination item"  style=" width:auto; padding:5px;">
                                    <a href="{{url('get/tourist_details/'.$tour->id)}}">
                                <div class="destination_image">
                                    <img src="{{ asset('uploads') . '/'.  $tour->photo }}" alt="" style="width: 200px; height: 200px;">
                                    {{-- <div class="spec_offer text-center"><a href="#">View</a></div> --}}
                                </div>
                                </a>
                                <div class="destination_content">
                                    <div class="destination_title"style=" width:200px; margin:0px;"><a href="{{url('get/tourist_details/'.$tour->id)}}">{{$tour->name}}</a></div>
                                    <?php
                                    $rating = $ratetour[$c];
                                    ?>
                                    <div class="destination_subtitle"><p>Rating: ({{$ratetour[$c]}})


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
                                </div>
                                    <div class="destination_subtitle" style=" width:200px; margin:0px;"><p style="color:black;">{{str_limit($tour->description,100)}}</p></div>
                                    <a href="{{url('get/tourist_details/'.$tour->id)}}"><i>Read more</i></a>

                                </div>
                            </div>
                            @if($c==5)
                                @break
                            @endif
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
                <div class="row load_more_row">
                    <div class="col">
                        <div class="button load_more_button"><a href="{{url('/taravel/tourist_destination')}}">see more</a></div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        {{--  --}}

        @if(count($hotel)!=0)
        <div class="destinations" id="destinations">
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <div class="section_subtitle">simply amazing places</div>
                            <div class="section_title"><h2>HOTELS AND RESORTS</h2></div>
                        </div>
                    </div>

                    <div class="row destinations_row">
                        <div class="col">
                            <div class="destinations_container item_grid" style="padding:50px;">
                                @if (!empty($hotel))
                                <!-- Destination -->
                                @foreach ($hotel as $c => $hot)

                                <div class="destination item"  style=" width:auto; padding:5px;">
                                        <a href="{{url('get/details/'.$hot->id)}}">
                                    <div class="destination_image">
                                        <img src="{{url(''.$hot->profile_pic)}}" alt="" style="width: 200px; height: 200px;">
                                        {{-- <div class="spec_offer text-center"><a href="{{url('get/details/'.$hot->id)}}">View</a></div> --}}
                                    </div>
                                    </a>
                                    <div class="destination_content">
                                            <div class="destination_title" style=" width:200px; margin:0px;"><a id="title_hover" href="{{url('get/details/'.$hot->id)}}">{{$hot->business_name}}</a></div>
                                            <div class="destination_subtitle" style=" width:200px; margin:0px;"><p>{{$hot->business_address}}</p></div>
                                                            <?php
                                                    $rating = $ratehot[$c];
                                                    ?>
                                                    <div class="destination_subtitle"><p>Rating: ({{$ratehot[$c]}})

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
                                                </div>
                                            <div class="destination_subtitle" style=" width:200px; margin:0px;"><p style="color:black;">{{str_limit($hot->attraction_details,100)}}</p></div>
                                            <a  href="{{url('get/details/'.$hot->id)}}"><i>Read more</i></a>

                                    </div>
                                </div>
                                @if($c==5)
                                    @break
                                @endif
                                @endforeach
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="row load_more_row">
                        <div class="col">
                            <div class="button load_more_button"><a href="{{url('/taravel/hotelandresorts')}}">see more</a></div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
{{--  --}}




        @if(count($restaurant)!=0)
    <div class="destinations" id="destinations">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section_subtitle">simply amazing places</div>
                    <div class="section_title"><h2>Restaurants</h2></div>
                </div>
            </div>

            <div class="row destinations_row">
                <div class="col">
                    <div class="destinations_container item_grid">
                        @if (!empty($restaurant))
                        <!-- Destination -->
                        @foreach ($restaurant as $c => $res)

                        <div class="destination item" style="padding:50px;">
                                <a href="{{url('get/details/'.$res->id)}}">
                            <div class="destination_image"  style=" width:auto; padding:5px;">
                                <img src="{{url(''.$res->profile_pic)}}" alt="" style="width: 200px; height: 200px;">
                                {{-- <div class="spec_offer text-center"><a href="{{url('get/details/'.$res->id)}}">View</a></div> --}}
                            </div>
                            </a>
                            <div class="destination_content">
                                <div class="destination_title"  style=" width:200px; margin:0px;"><a href="{{url('get/details/'.$res->id)}}">{{$res->business_name}}</a></div>
                                <div class="destination_subtitle" style=" width:200px; margin:0px;"><p>{{$res->business_address}}</p></div>
                                <?php
                                    $rating = $rateresto[$c];
                                    ?>
                                    <div class="destination_subtitle"><p>Rating: ({{$rateresto[$c]}})


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
                                </div>
                                <div class="destination_subtitle" style=" width:200px; margin:0px;"><p style="color:black;">{{str_limit($res->attraction_details,100)}}</p></div>
                                <a  href="{{url('get/details/'.$res->id)}}"><i>Read more</i></a>

                            </div>
                        </div>
                        @if($c==5)
                            @break
                        @endif
                        @endforeach
                        @endif

                    </div>
                </div>
            </div>
            <div class="row load_more_row">
                <div class="col">
                    <div class="button load_more_button"><a href="{{url('/taravel/restaurant')}}">see more</a></div>
                </div>
            </div>
        </div>
    </div>
    @endif



    @if(!empty($agency))
    <div class="destinations" id="destinations">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section_subtitle"></div>
                    <div class="section_title"><h2>Travel Agency</h2></div>
                </div>
            </div>
            {{-- <div class="row destination_sorting_row">
                <div class="col">
                    <div class="destination_sorting d-flex flex-row align-items-start justify-content-start">
                        <div class="sorting">
                            <ul class="item_sorting">
                                <li>
                                    <span class="sorting_text">Sort By</span>
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    <ul>
                                        <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'><span>Show All</span></li>
                                        <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "price" }'><span>Price</span></li>
                                        <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "name" }'><span>Name</span></li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="sorting_text">Categories</span>
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    <ul>
                                        <li class="num_sorting_btn"><span>Category</span></li>
                                        <li class="num_sorting_btn"><span>Category</span></li>
                                        <li class="num_sorting_btn"><span>Category</span></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="sort_box ml-auto"><i class="fa fa-th" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div> --}}
            <div class="row destinations_row">
                <div class="col">
                    <div class="destinations_container item_grid">
                        @if (!empty($agency))
                        <!-- Destination -->
                        @foreach ($agency as $c => $ag)

                        <div class="destination item">

                            <div class="destination_image">
                                <img src="{{asset('uploads/'.$ag->photo)}}" alt=""style="width: 200px; height: 200px;"">
                                {{-- <div class="spec_offer text-center"><a href="{{url('get/details/'.$res->id)}}">View</a></div> --}}
                            </div>

                            <div class="destination_content">
                                <div class="destination_title"><a href="#">{{$ag->name}}</a></div>
                                <div class="destination_subtitle"><p>{{$ag->location}}</p></div>
                                <div class="destination_price"> <p>{!!$ag->coverage!!}</p></div>
                                {{-- <div class="destination_list">
                                    <ul>
                                        <li>5 Stars Hotel</li>
                                        <li>All Inclusive</li>
                                        <li>Flight tickets included</li>
                                        <li>Guided visits</li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                        @if($c==5)
                            @break
                        @endif
                        @endforeach
                        @endif
                        @if(count($agency)==0)
                        <i><h2 style="">No Results Found</h2></i>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row load_more_row">
                <div class="col">
                    <div class="button load_more_button"><a href="{{url('/taravel/agency')}}">see more</a></div>
                </div>
            </div>
        </div>
    </div>
    @endif
<!-- PAGE REAL WRAPPER -->


      {{-- <!-- FULL WRAPPER -->

      <div class="main-wrapper-full" style="width: 100%; height: auto; padding: 5%; ">
        <!-- Wrapper of TD -->
        <div class="index-tourist-thumb" style="width: 90%; height: 700px; margin: 5%; ">

        <h4><a href="{{url('/taravel/tourist_destination')}}">Tourist Destination You may like..</a></h4>
        @if ($tour->count() > 0)
        @foreach ($tour as $tour)

      <div class="wrapper-polaroid" style="width: 250px; margin: 1%; height: 300px; float: left; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div style="width: 250px; height: 200px; background-color: white; padding: 5%;">
            <a href="{{url('get/tourist_details/'.$tour->id)}}"><img src="{{ asset('uploads') . '/'.  $tour->photo }}" style="width: 100%; height: 100%;"></a>
            </div>
                <div class="polaroidtitle" style="height: 100px; width: 250px; padding: 5%; background-color: white; color: black; text-transform: uppercase; color: black; font-weight: bold; width :100%;overflow:hidden;text-overflow: ellipsis; text-align: center;" >
                <a href="{{url('get/tourist_details/'.$tour->id)}}">
                    {{$tour->name}}
                 </a>
            </div>
            </div>
            @if($counter==8)
                @break
                @endif
            @endforeach

    @endif
        <h6 style="float: right;"><a href="{{url('/taravel/tourist_destination')}}">See all...</a></h6>
        </div>


        <!-- Wrapper of hotels -->
        <div class="index-tourist-thumb" style="width: 90%; height: 700px; margin: 5%; ">
        <h4><a href="{{url('/taravel/hotelandresorts')}}">Hotels and resorts You may like..</a></h4>

         @if ($hotel->count() > 0)
            @foreach ($hotel as $hot)

          <div class="wrapper-polaroid" style="width: 250px; margin: 1%; height: 300px; float: left; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div style="width: 250px; height: 200px; background-color: white; padding: 5%;">
                <a href="{{url('get/details/'.$hot->id)}}"><img src="{{url(''.$hot->profile_pic)}}" style="width: 100%; height: 100%;"></a>
                </div>
                    <div class="polaroidtitle" style="height: 100px; width: 250px; padding: 5%; background-color: white; color: black; text-transform: uppercase; color: black; font-weight: bold; width :100%;overflow:hidden;text-overflow: ellipsis; text-align: center;" >
                    <a href="{{url('get/details/'.$hot->id)}}">
                        {{$hot->business_name}}
                     </a>
                </div>
                </div>
                @if($counter==8)
                @break
                @endif
                @endforeach

        @endif
        <h6 style="float: right;"><a href="{{url('/taravel/hotelandresorts')}}">See all...</a></h6>
        </div>



        <!-- Wrapper of rest -->
        <div class="index-tourist-thumb" style="width: 90%; height: 700px; margin: 5%; ">
        <h4><a href="{{url('/taravel/restaurant')}}">Restaurants You may like..</a></h4>
        @if ($restaurant->count() > 0)
        @foreach ($restaurant as $res)
      <div class="wrapper-polaroid" style="width: 250px; margin: 1%; height: 300px; float: left; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div style="width: 250px; height: 200px; background-color: white; padding: 5%;">
            <a href="{{url('get/details/'.$res->id)}}'"><img src="{{url(''.$res->profile_pic)}}" style="width: 100%; height: 100%;"></a>
            </div>
                <div class="polaroidtitle" style="height: 100px; width: 250px; padding: 5%; background-color: white; color: black; text-transform: uppercase; color: black; font-weight: bold; width :100%;overflow:hidden;text-overflow: ellipsis; text-align: center;" >
                <a href="{{url('get/details/'.$res->id)}}">
                    {{$res->business_name}}
                 </a>
            </div>
            </div>
            @if($counter==8)
            @break
            @endif
            @endforeach

    @endif
        <h6 style="float: right;"><a href="{{url('/taravel/restaurant')}}">See all...</a></h6>

        </div>
      </div> --}}

@endsection
@section('footer')
<script src="{{url('theme/js/destinations.js')}}"></script>
@endsection
