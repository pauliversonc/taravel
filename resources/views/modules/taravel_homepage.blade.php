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
</style>
@endsection

@section('content')
<div class="home">
		<div class="background_image" style="background-image:url({{url('theme/images/destinations.jpg')}})"></div>
	</div>

	<!-- Search -->


    @include('partials.search-bar');
    	<!-- Destinations -->

	<div class="destinations" id="destinations">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="section_subtitle">simply amazing places</div>
                        <div class="section_title"><h2>Tourist Destinations</h2></div>
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
                            @if ($tour->count() > 0)
                            <!-- Destination -->
                            @foreach ($tour as $c => $tour)

                            <div class="destination item">
                                    <a href="{{url('get/tourist_details/'.$tour->id)}}">
                                <div class="destination_image">
                                    <img src="{{ asset('uploads') . '/'.  $tour->photo }}" alt="" style="width: 350px; height: 400px;">
                                    {{-- <div class="spec_offer text-center"><a href="#">View</a></div> --}}
                                </div>
                                </a>
                                <div class="destination_content">
                                    <div class="destination_title"><a href="{{url('get/tourist_details/'.$tour->id)}}">{{$tour->name}}</a></div>
                                    {{-- <div class="destination_subtitle"><p>Nulla pretium tincidunt felis, nec.</p></div> --}}
                                    {{-- <div class="destination_price">From $679</div> --}}
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
        {{--  --}}
        <div class="destinations" id="destinations">
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <div class="section_subtitle"></div>
                            <div class="section_title"><h2>HOTELS AND RESORTS</h2></div>
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
                                @if ($hotel->count() > 0)
                                <!-- Destination -->
                                @foreach ($hotel as $c => $hot)

                                <div class="destination item">
                                        <a href="{{url('get/details/'.$hot->id)}}">
                                    <div class="destination_image">
                                        <img src="{{url(''.$hot->profile_pic)}}" alt="" style="width: 350px; height: 400px;">
                                        {{-- <div class="spec_offer text-center"><a href="{{url('get/details/'.$hot->id)}}">View</a></div> --}}
                                    </div>
                                    </a>
                                    <div class="destination_content">
                                        <div class="destination_title"><a href="{{url('get/details/'.$hot->id)}}">{{$hot->business_name}}</a></div>
                                        {{-- <div class="destination_subtitle"><p>Nulla pretium tincidunt felis, nec.</p></div> --}}
                                        {{-- <div class="destination_price">From $679</div> --}}
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
{{--  --}}

<div class="destinations" id="destinations">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section_subtitle"></div>
                    <div class="section_title"><h2>RESTAURANTS</h2></div>
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
                        @if ($restaurant->count() > 0)
                        <!-- Destination -->
                        @foreach ($restaurant as $c => $res)

                        <div class="destination item">
                                <a href="{{url('get/details/'.$res->id)}}">
                            <div class="destination_image">
                                <img src="{{url(''.$res->profile_pic)}}" alt="" style="width: 350px; height: 400px;">
                                {{-- <div class="spec_offer text-center"><a href="{{url('get/details/'.$res->id)}}">View</a></div> --}}
                            </div>
                            </a>
                            <div class="destination_content">
                                <div class="destination_title"><a href="{{url('get/details/'.$res->id)}}">{{$res->business_name}}</a></div>
                                {{-- <div class="destination_subtitle"><p>Nulla pretium tincidunt felis, nec.</p></div> --}}
                                {{-- <div class="destination_price">From $679</div> --}}
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

    <div class="destinations" id="destinations">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section_subtitle"></div>
                    <div class="section_title"><h2>Travel Deals</h2></div>
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
                        @if ($agency->count() > 0)
                        <!-- Destination -->
                        @foreach ($agency as $c => $ag)

                        <div class="destination item">

                            <div class="destination_image">
                                <img src="{{asset('uploads/'.$ag->photo)}}" alt="" style="width: 350px; height: 400px;">
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
