@extends('admin.layouts.taravel2')
@section('head')
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/main_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/responsive.css')}}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/news.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/destinations.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/news_responsive.css')}}">
@endsection

@section('content')
<script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>
<link href="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css" rel="stylesheet">

<div style="overflow:hidden;">
<style>
     .slider{
                        /* height: 100%;
                        width: 100%; */
                        position: fixed;
                    }
     .mySlides{
                    height: 100vh;
                    width: 100vw;
                    transition-delay: 1s;
                    filter: blur(2px);
                }

        #h2_title:hover{
            -webkit-transform: scale(1.1);
            -webkit-transition-delay: 2ms;
        }
    </style>
    <div class="slider">
        {{-- <img class="mySlides" src="{{asset('storage/mountain.jpg')}}">
        <img class="mySlides" src="{{asset('storage/elnido.jpg')}}">
        <img class="mySlides" src="{{asset('storage/swim.jpg')}}">
        <img class="mySlides" src="{{asset('storage/amanpulo_palawan.jpg')}}">
        <img class="mySlides" src="{{asset('storage/amanpulo_palawan2.png')}}">
        <img class="mySlides" src="{{asset('storage/okada.jpg')}}">
        <img class="mySlides" src="{{asset('storage/okada2.jpg')}}">
        <img class="mySlides" src="{{asset('storage/resto.jpg')}}">
        <img class="mySlides" src="{{asset('storage/national_museum.jpg')}}"> --}}
        <img class="mySlides" src="{{asset('storage/hdpics/Ati-atihan.jpg')}}">
        <img class="mySlides" src="{{asset('storage/hdpics/Dinayag.jpg')}}">
        <img class="mySlides" src="{{asset('storage/hdpics/Tinalak.jpg')}}">
        <img class="mySlides" src="{{asset('storage/hdpics/Maskara.jpg')}}">
     </div>

     <script>
            var slideIndex = 0;
        carousel();

        function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > x.length) {slideIndex = 1}
        x[slideIndex-1].style.display = "block";
        setTimeout(carousel, 1500); // Change image every 1 seconds
        }
    </script>

<div class="home">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10"  style="margin-top:190px;">
            {{-- <div class="home_title"><h2 id="h2_title" style="text-shadow: 4px 2px 2px #4d4d4d;">Journeys as great as the destinations.</h2></div> --}}
        </div>
        <div class="col-md-1"></div>
    </div>

</div>

<div class="home_search" >
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="home_search_container">
                    <div class="home_search_title">Search for your trip</div>
                    <div class="home_search_content" >
                        <form action="{{url('homeSearch')}}" method="get" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <i class="fa fa-search-plus">&nbsp;Search</i>
                            {{-- <input type="text" name="search"> --}}
                            <select size="6" id="editable-select" name="search" class="form-control search_input" placeholder="Search">
                                    <option style="color:red!important;font-wieght:700!important">Full Package</option>
                                        @foreach($agen1 as $a)
                                        <option value="{{$a->name}}">{{$a->name}}</option>
                                        @endforeach
                                    <option style="color:red!important;font-wieght:700!important">Tour Package</option>
                                        @foreach($agen2 as $a)
                                        <option value="{{$a->name}}">{{$a->name}}</option>
                                        @endforeach
                                    <option style="color:red!important;font-wieght:700!important">Accomodation</option>
                                        @foreach($hr as $a)
                                        <option value="{{$a->business_name}}">{{$a->business_name}}</option>
                                        @endforeach
                                    <option style="color:red!important;font-wieght:700!important">Restaurants</option>
                                    @foreach($rest as $a)
                                        <option value="{{$a->business_name}}">{{$a->business_name}}</option>
                                        @endforeach
                            </select>

                            <script>$('#editable-select').editableSelect();</script>

                            <div class="d-flex flex-lg-row flex-column align-items-start justify-content-lg-between justify-content-start">
                                <i class="fas fa-money-bill-alt" style="color:green; margin-top:16px;margin-bottom:15px;">  Budget</i>
                                <input type="text" name="budget" class="search_input search_input_2" placeholder="Budget" >
                                <i class="fa fa-calendar-check-o" style="color:blue;margin-top:16px;margin-bottom:15px;">  Check-in</i>
                                <input type="text" name="checkin" class="search_input search_input_2 datepicker" placeholder="Check In">
                                <i class="fa fa-calendar-minus-o" style="color:red; margin-top:16px;margin-bottom:15px;">  Check-out</i>
                                <input type="text" name="checkout" class="search_input search_input_2 datepicker" placeholder="Check Out">
                            <button type="submit" name="submit"  class="home_search_button" value="1">search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@auth
<input id="username" type="hidden" value="<?php if((URL::previous()==url('admin')) ){ echo strtoupper(Auth::user()->name); }?>">


@endauth
<script>
    $( document ).ready(function() {
        var n=$('#username').val();

    if((n!="") && (n!=null)  ){
        //  $('#btForm').click();
        alert('Welcome, '+n);
        }
    });

</script>


<!-- Intro -->

{{-- <div class="intro">

    <div class="intro_background" style="background-image:url(images/intro.png)"></div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="intro_container">
                    <div class="row">

                        <!-- Intro Item -->
                        <div class="col-lg-4 intro_col">
                            <div class="intro_item d-flex flex-row align-items-end justify-content-start">
                                <div class="intro_icon"><img src="{{url('theme/images/beach.svg')}}" alt=""></div>
                                <div class="intro_content">
                                    <div class="intro_title">Top Destinations</div>
                                    <div class="intro_subtitle"><p></p></div>
                                </div>
                            </div>
                        </div>

                        <!-- Intro Item -->
                        <div class="col-lg-4 intro_col">
                            <div class="intro_item d-flex flex-row align-items-end justify-content-start">
                                <div class="intro_icon"><img src="{{url('theme/images/wallet.svg')}}" alt=""></div>
                                <div class="intro_content">
                                    <div class="intro_title">The Best Prices</div>
                                    <div class="intro_subtitle"><p></p></div>
                                </div>
                            </div>
                        </div>

                        <!-- Intro Item -->
                        <div class="col-lg-4 intro_col">
                            <div class="intro_item d-flex flex-row align-items-end justify-content-start">
                                <div class="intro_icon"><img src="{{url('theme/images/suitcase.svg')}}" alt=""></div>
                                <div class="intro_content">
                                    <div class="intro_title">Amazing Services</div>
                                    <div class="intro_subtitle"><p></p></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<!-- Destinations -->

<div class="destinations" id="destinations">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="section_subtitle">simply amazing places</div>
                @if(count($tour)!=0)
                <div class="section_title"><h2>Popular Tourist Destinations</h2></div>
                @endif
            </div>
        </div>



<style>
        .destination_image{
            transition: transform .2s;
        }
        .destination_image img{
           height:200px;
           width:200px;
        }

        .destination_image:hover{
            -webkit-transform: scale(1.1);
        }
        #title_hover:hover{
            text-decoration:underline;
        }

    </style>

        <div class="row destinations_row">
            <div class="col">
                <div class="destinations_container item_grid" style="padding:50px;"  >
                @if(!is_null('$tour'))
                @for ($i = 0; $i < count($tour); $i++)
                    <!-- Destination -->
                    <div class="destination item"  style=" width:auto; padding:5px;">
                            @if (!empty($tour[$i]))
                        <div class="destination_image">
                           <a href="{{url('get/tourist_details/'.$tour[$i]->id)}}">
                            <img src="{{ asset('uploads') . '/'.  $tour[$i]->photo }}" alt="" ></a>
                            <div class="spec_offer text-center"><a href="{{url('get/tourist_details/'.$tour[$i]->id)}}">View</a></div>
                            <div class="destination_title" style=" width:200px; margin:0px;"><a id="title_hover" href="{{url('get/tourist_details/'.$tour[$i]->id)}}">{{$tour[$i]->name}}</a></div>
                            <div class="destination_subtitle" style=" width:200px; margin:0px;"><p>{{$tour[$i]->address}}</p></div>
                            <?php
                              $rating = $tourRating[$i];
                            ?>
                            <div class="destination_subtitle"><p>Rating: ({{$tourRating[$i]}})

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
                        <div class="destination_subtitle" style=" width:200px; margin:0px;"><p style="color:black;">{{str_limit($tour[$i]->description,100)}}</p></div>
                        <a href="{{url('get/tourist_details/'.$tour[$i]->id)}}"><i>Read more</i></a>

                            </p></div>

                        </div>
                        <div class="destination_content">

                            {{-- <div class="destination_price">From $679</div> --}}
                        </div>
                            @endif
                    </div>
                @endfor
                @endif

                </div>
            </div>
        </div>
        @if(count($hotel)!=0)
        <div class="row">
                <div class="col text-center">
                    {{-- <div class="section_subtitle">simply amazing places</div> --}}
                    <div class="section_title"><h2>Popular Hotels and Resorts</h2></div>
                </div>
            </div>
        @endif

            <div class="row destinations_row">
                    <div class="col">
                        <div class="destinations_container item_grid" style="padding:50px;" >
                        @if(!is_null($hotel))
                        @php $count=0; @endphp
                        @for ($i = 0; $i < count($hotel); $i++)
                            <!-- Destination -->
                            <div class="destination item" style=" width:auto; padding:5px;">
                                @if (!empty($hotel[$i]))
                                <div class="destination_image">
                                   <a href="{{url('get/details/'.$hotel[$i]->id)}}">
                                    <img src="{{url($hotel[$i]->profile_pic)}}" alt=""></a>
                                    <div class="spec_offer text-center"><a href="{{url('get/details/'.$hotel[$i]->id)}}">View</a></div>
                                    <div class="destination_title" style=" width:200px; margin:0px;"><a id="title_hover" href="{{url('get/details/'.$hotel[$i]->id)}}">{{$hotel[$i]->business_name}}</a></div>
                                    <div class="destination_subtitle" style=" width:200px; margin:0px;"><p>{{$hotel[$i]->business_address}}</p></div>
                                    <?php
                                    $rating = $hotelRating[$i];

                                    ?>
                                    <div class="destination_subtitle"><p>Rating ({{$hotelRating[$i]}})






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



                                    </p></div>
                                </div>
                                @php $count++ @endphp
                                @endif
                                <div class="destination_subtitle" style=" width:200px; margin:0px;"><p style="color:black;">{{str_limit($hotel[$i]->attraction_details,100)}}</p></div>
                                <a  href="{{url('get/details/'.$hotel[$i]->id)}}"><i>Read more</i></a>
                                <div class="destination_content">

                                    {{-- <div class="destination_price">From $679</div> --}}
                                </div>
                            </div>
                            @php
                            if($count==5){
                                break;
                            }
                           @endphp
                        @endfor
                        @endif

                        </div>
                    </div>
                </div>
        @if(count($resto)!=0)
        <div class="row">
            <div class="col text-center">
                            {{-- <div class="section_subtitle">simply amazing places</div> --}}
                            <div class="section_title"><h2>Popular Restaurants</h2></div>
            </div>

        </div>
        @endif
                 <div class="row destinations_row">
                        <div class="col">
                            <div class="destinations_container item_grid" style="padding:50px;" >
                            @if(!is_null($resto))
                            @php $count=0; @endphp
                            @for ($i = 0; $i < count($resto); $i++)
                                <!-- Destination -->
                                <div class="destination item"  style=" width:auto; padding:5px;">
                                    @if (!empty($resto[$i]))
                                    <div class="destination_image">
                                       <a href="{{url('get/details/'.$resto[$i]->id)}}">
                                        <img src="{{url($resto[$i]->profile_pic)}}"  alt=""></a>
                                        <div class="spec_offer text-center"><a href="{{url('get/details/'.$resto[$i]->id)}}">View</a></div>
                                        <div class="destination_title" style=" width:200px; margin:0px;"><a id="title_hover" href="{{url('get/details/'.$resto[$i]->id)}}">{{$resto[$i]->business_name}}</a></div>
                                        <div class="destination_subtitle" style=" width:200px; margin:0px;"><p>{{$resto[$i]->business_address}}</p></div>
                                        <?php
                                            $rating = $restoRating[$i];

                                        ?>
                                        <div class="destination_subtitle"><p>Rating ({{$restoRating[$i]}})
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





                                        </p></div>
                                    </div>
                                    @php $count++; @endphp
                                    @endif
                                    <div class="destination_subtitle" style=" width:200px; margin:0px;"><p style="color:black;">{{str_limit($resto[$i]->attraction_details,100)}}</p></div>
                                <a  href="{{url('get/details/'.$resto[$i]->id)}}"><i>Read more</i></a>
                                    <div class="destination_content">

                                        {{-- <div class="destination_price">From $679</div> --}}
                                    </div>
                                </div>
                                @php
                                if($count==5){
                                    break;
                                }
                               @endphp
                            @endfor
                            @endif


                            </div>
                        </div>
                    </div>
    </div>
</div>



<!-- Testimonials -->

<div class="testimonials" id="testimonials">
    <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{url("theme/images/testimonials.jpg")}}" data-speed="0.8"></div>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="section_subtitle" style="text-shadow: 4px 3px 3px #4d4d4d;">simply amazing places</div>
                <div class="section_title"><h1 style="text-shadow: 4px 3px 3px #4d4d4d;">Awaken To A Different World.</h1></div>
            </div>
        </div>
        <div class="row testimonials_row">
            <div class="col">

                <!-- Testimonials Slider -->
                <div class="testimonials_slider_container">
                    <div class="owl-carousel owl-theme testimonials_slider">

                        <!-- Slide -->
                        <div class="owl-item text-center">
                            <div class="testimonial" style="text-shadow: 4px 3px 3px #4d4d4d;">Experience Variety.</div>
                            <div class="testimonial_author">
                                <div class="testimonial_author_content d-flex flex-row align-items-end justify-content-start">
                                    {{-- <div>john turner,</div>
                                    <div>client</div> --}}
                                </div>
                            </div>
                        </div>

                        <!-- Slide -->
                        <div class="owl-item text-center">
                            <div class="testimonial" style="text-shadow: 4px 3px 3px #4d4d4d;">Exploring the world in comfort.</div>
                            <div class="testimonial_author">
                                <div class="testimonial_author_content d-flex flex-row align-items-end justify-content-start">
                                    {{-- <div>john turner,</div>
                                    <div>client</div> --}}
                                </div>
                            </div>
                        </div>

                        <!-- Slide -->
                        <div class="owl-item text-center">
                            <div class="testimonial" style="text-shadow: 4px 3px 3px #4d4d4d;">Great Faces. Great Places.
                                    Great journeys – fascinating places.</div>
                            <div class="testimonial_author">
                                <div class="testimonial_author_content d-flex flex-row align-items-end justify-content-start">
                                    {{-- <div>john turner,</div>
                                    <div>client</div> --}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="test_nav">
        <ul class="d-flex flex-column align-items-end justify-content-end">
            <li><a href="#">City Breaks Clients<span>01</span></a></li>
            <li><a href="#">Cruises Clients<span>02</span></a></li>
            <li><a href="#">All Inclusive Clients<span>03</span></a></li>
        </ul>
    </div>
</div>

<!-- News -->

<div class="news" id="news">
        <div class="news_container">
                <div class="col text-center">
                        {{-- <div class="section_subtitle">simply amazing places</div> --}}
             <div class="section_title"><h2>Travel Deals</h2></div>
        </div>
        <div class="container" >

                <div class="row" style="border:2px solid black; padding: 10px; border-radius: 8px;">
            <h4 class="sidebar_title">Tour Packages</h4>

                    <div class="col-sm-12">

                        @foreach ($agen2 as $item)

                        <div class="card">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <img src="{{url('/uploads/'.$item->photo)}}" width="200px" height="200px" class="img-fluid" alt="">
                                    </div>
                                    <div class="col">
                                        <div class="card-block px-2">
                                                <div class="modal fade bd-example-modal-lg" id="{{'modal'.$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
                                                            <div class="modal-content" style="padding:2em;">
                                                                      {!!$item->coverage!!}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                                              </div>
                                                        </div>
                                        <h4 class="card-title">{{$item->name}} - {{$item->price}}</h4>
                                            <p class="card-text">{!! str_limit($item->coverage, $limit = 300, $end = '...') !!}</p>
                                            {{-- <a href="#" class="btn btn-primary">Read More</a> --}}
                                            <br>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{'#modal'.$item->id}}">Read More</button>

                                            @auth
                                            @if(Auth::user()->role_id==1 || Auth::user()->role_id==3)
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{'#2modal'.$item->id}}"><i class="fas fa-plus" ></i>&nbsp;Add to Custom Package</button>
                                            <form action="{{url('travellers/add/package')}}" method="post">
                                                {{ csrf_field() }}
                                            <div class="modal fade bd-example-modal-lg" id="{{'2modal'.$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
                                                        <div class="modal-content" style="padding:2em;">
                                                                <h2>{{$item->name}}</h2>
                                                                {{$item->location}}
                                                                <br>{{"Budget Price: ".$item->price}}
                                                                <input type="hidden" name="price" value="{{$item->price}}">
                                                                <input type="hidden" name="name" value="{{$item->name}}">
                                                                <input type="hidden" name="address" value="{{$item->location}}">
                                                                <input type="hidden" name="type" value="2">
                                                                <label>Enter Quantity:&nbsp;<input type="number" min="1" name="qty" placeholder="1"></label>
                                                                <button type="submit" name="action" class="btn btn-success">Submit</button>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                                          </div>
                                                    </div>
                                            </form>
                                            @endif
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer w-100 text-muted">

                                </div>
                          </div>

                                <br>
                        @endforeach

                    </div>

                </div>

            </div><br>
            <div class="container" >

                    <div class="row" style="border:2px solid black; padding: 10px; border-radius: 8px;">
                <h4 class="sidebar_title">Full Packages</h4>

                        <div class="col-sm-12">

                            @foreach ($agen1 as $item)

                            <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <img src="{{url('/uploads/'.$item->photo)}}" width="200px" height="200px" class="img-fluid" alt="">
                                        </div>
                                        <div class="col">
                                            <div class="card-block px-2">
                                                    <div class="modal fade bd-example-modal-lg" id="{{'modal'.$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
                                                                <div class="modal-content" style="padding:2em;">
                                                                          {!!$item->coverage!!}
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                                                  </div>
                                                            </div>
                                            <h4 class="card-title">{{$item->name}} - {{$item->price}} <br>{{$item->location}}</h4>
                                                <p class="card-text">{!! str_limit($item->coverage, $limit = 300, $end = '...') !!}</p>
                                                {{-- <a href="#" class="btn btn-primary">Read More</a> --}}
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{'#modal'.$item->id}}">Read More</button>
                                                @auth
                                                @if(Auth::user()->role_id==1 || Auth::user()->role_id==3)
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{'#2modal'.$item->id}}"><i class="fas fa-plus" ></i>&nbsp;Add to Custom Package</button>
                                                <form action="{{url('travellers/add/package')}}" method="post">
                                                    {{ csrf_field() }}
                                                <div class="modal fade bd-example-modal-lg" id="{{'2modal'.$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
                                                            <div class="modal-content" style="padding:2em;">
                                                                    <h2>{{$item->name}}</h2>
                                                                    {{$item->location}}
                                                                    <br>{{"Budget Price: ".$item->price}}
                                                                    <input type="hidden" name="price" value="{{$item->price}}">
                                                                    <input type="hidden" name="name" value="{{$item->name}}">
                                                                    <input type="hidden" name="address" value="{{$item->location}}">
                                                                    <input type="hidden" name="type" value="2">
                                                                    <label>Enter Quantity:&nbsp;<input type="number" min="1" name="qty" placeholder="1"></label>
                                                                    <button type="submit" name="action" class="btn btn-success">Submit</button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                                              </div>
                                                        </div>
                                                </form>
                                                @endif
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer w-100 text-muted">

                                    </div>
                              </div>

                                    <br>
                            @endforeach

                        </div>

                    </div>

                </div>

    </div>
</div>
</div>
@endsection
@section('footer')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
      $( ".datepicker" ).datepicker();
    } );
    </script>
@endsection
    {{-- <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/admin') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                <img src="{{asset('storage/taravel_white_logo.png')}}" height="250px" width="100%" class="img-responsive" alt="">

                </div>

                <div class="links">
                    <a href="{{url('/taravel/home')}}">Home</a>
                    <a href="{{url('/taravel/tourist_destination')}}">Tourist Destination</a>
                    <a href="{{url('/taravel/hotelandresorts')}}">Hotel and Resort</a>
                    <a href="{{url('/taravel/restaurant')}}">Restaurants</a>


                </div>
            </div>
        </div>
    </body> --}}

