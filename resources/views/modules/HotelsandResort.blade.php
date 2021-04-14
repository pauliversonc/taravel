@extends('admin.layouts.taravel2')

@section('head')
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/news.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/destinations.css')}}">
<script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>
<link href="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css" rel="stylesheet">

@endsection

@section('content')

<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:400,100,900);

html,
body {
  -moz-box-sizing: border-box;
       box-sizing: border-box;
  height: 100%;
  width: 100%;
  background: #FFF;
  font-family: 'Roboto', sans-serif;
  font-weight: 400;
}

.wrapper {
  display: table;
  height: 100%;
  width: 100%;
}

.container-fostrap {
  display: table-cell;
  padding: 1em;
  text-align: center;
  vertical-align: middle;
}
.fostrap-logo {
  width: 100px;
  margin-bottom:15px
}
h1.heading {
  color: #fff;
  font-size: 1.15em;
  font-weight: 900;
  margin: 0 0 0.5em;
  color: #505050;
}
@media (min-width: 450px) {
  h1.heading {
    font-size: 3.55em;
  }
}
@media (min-width: 760px) {
  h1.heading {
    font-size: 3.05em;
  }
}
@media (min-width: 900px) {
  h1.heading {
    font-size: 3.25em;
    margin: 0 0 0.3em;
  }
}
.card {
  display: block;
    margin-bottom: 0px;
    line-height: 1.42857143;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
    transition: box-shadow .25s;
}
.card:hover {
  box-shadow: 0 8px 17px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
}
.img-card {
  width: 100%;
  height:150px;
  border-top-left-radius:2px;
  border-top-right-radius:2px;
  display:block;
    overflow: hidden;
}
.img-card img{
  width: 100%;
  height: 200px;
  object-fit:cover;
  transition: all .25s ease;
}
.card-content {
  padding:15px;
  text-align:left;
}
.card-title {
  margin-top:0px;
  font-weight: 700;
  font-size: 1.65em;
}
.card-title a {
  color: #000;
  text-decoration: none !important;
}
.card-read-more {
  border-top: 1px solid #D4D4D4;
}
.card-read-more a {
  text-decoration: none !important;
  padding:10px;
  font-weight:600;
  text-transform: uppercase
}</style>

<div class="home">
		<div class="background_image" style="filter:blur(2px); background-image:url({{asset('storage/hdpics/Tinalak.jpg')}})"></div>
	</div>
<!-- Search -->
@include('partials.search-bar');
<div class="container">
<div class="row">
<div class="col">
        <button  class="home_search_button" type="button" id="form-trigger">
                View Filter
              </button>

    </div><br>
</div>
    </div>


<div class="container" id="filter-form" >
        <form action="{{url('/taravel/hotelandresorts')}}" method="post">
            {{ csrf_field() }}
            @if (!empty($input))
            <input type="hidden" name="search" value="{{$input}}">
            @endif
    <div class="row" style="border:2px solid black; padding: 10px; border-radius: 8px;">


                @foreach ($category as $cat)
            <div class="col-sm-2">
                <div class="sidebar_title">{{$cat->name}}</div> <br>
                <ul>
                        @foreach ($tags->where('category_id',$cat->id) as $catT)
                    <li><div class="d-flex flex-row align-items-start justify-content-start"><input type="checkbox" name="filter[]" id="" value="{{$catT->id}}">{{$catT->name}}</div></li>
                    @endforeach
                    <br>
                </ul>
            </div>
            @endforeach

            @if ($region->count())
            <div class="col-sm-2">
            <div class="sidebar_title">Region</div><br>

                <ul>
                    @for ($i = 0; $i < count($region)/2; $i++)
                    <li><div class="d-flex flex-row align-items-start justify-content-start"> <input type="checkbox" name="filter_region[]" value="{{$region[$i]->id}}">{{$region[$i]->name}}</div></li>
                    @endfor

                    <br>
                </ul>
            </div>
            <div class="col-sm-1.5">
                    <div class="sidebar_title"></div><br>
                        <br>
                        <ul>
                            @for ($i = count($region)/2; $i < count($region); $i++)
                            <li><div class="d-flex flex-row align-items-start justify-content-start"> <input type="checkbox" name="filter_region[]" value="{{$region[$i]->id}}">{{$region[$i]->name}}</div></li>
                            @endfor

                            <br>
                        </ul>
                    </div>
            @endif
            <button class="home_search_button" type="submit" >Send</button>

    </div>
        </form>
</div>

<div class="news" >




<br>

        <div class="">
                <div class="container">
                    <div class="row">



                                <div class="col">
                                    <div class="destination_sorting d-flex flex-row align-items-start justify-content-start">
                                        <div class="sorting">
                                            <ul class="item_sorting">
                                                <li>
                                                    <span class="sorting_text">Sort By</span>
                                                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                                    <ul>
                                                    <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'><a href="{{url('/taravel/hotelandresorts')}}"><span>default</span></a></li>
                                                        <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "price" }'><a href="{{url('/taravel/hotelandresorts/1')}}"><span>Price Asc.</span></a></li>
                                                        <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "name" }'><a href="{{url('/taravel/hotelandresorts/2')}}"><span>Price Desc.</span></a></li>
                                                        <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "name" }'><a href="{{url('/taravel/hotelandresorts/3')}}"><span>Most views</span></a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        {{-- <div class="sort_box ml-auto"><i class="fa fa-th" aria-hidden="true"></i></div> --}}
                                    </div>
                                </div>

                        </div>

                    <div class="row"  style="border:2px solid black; padding: 10px; border-radius: 8px;">
                            <h4 class="sidebar_title">Accomodation</h4>
                        <!-- News Container -->
                        <div class="col-lg-12">
                                @if($data->count()>0)
                                <?php $ratecount=0;?>
                                @foreach ($data->where('business_type_id',1) as $k => $item)
                                <div class="card" style="padding:5px;">
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <img src="{{url($item->profile_pic)}}"width="200px" height="200px" class="img-fluid" alt="">
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="card-block px-2">
                                                    <h4 class="card-title"><a href="{{url('get/details/'.$item->id)}}">{{$item->business_name}} - (₱{{$item->business_price}})</a></h4>
                                                    <p class="card-text"><i class="fas fa-eye" style="color:tomato"></i> {{$views[$k]}}{{$item->business_address}} <br> {{$item->business_website}} <br>{{$item->business_number}} <br>
                                                        <?php
                                                        $rating = $item->total;

                                                    ?>


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
                                                        ({{number_format($item->total,1)}}) Rating
                                                        <br>
                                                        <form action="{{url('tag')}}" method="get" enctype="multipart/form-data">
                                                            {{csrf_field()}}   Tags:
                                                            @for ($i = 0; $i < count($tags_array[$k]); $i++)
                                                        <button name="tag" value="{{$tags_id[$k][$i]}}" type="submit" style=" border:none;" > <span class="badge badge-info">{{$tags_array[$k][$i]}}</span></button>
                                                            @endfor

                                                        </form>
                                                    </p>

                                                </div>
                                            </div>
                                            <div class="col-sm-4" >
                                                @if(!empty($item->business_landmarks))
                                                <label>Landmark:</label>
                                                <p class="sidebar_title">{{$item->business_landmarks}}</p>
                                                @endif
                                                <label>Attraction Details:</label>
                                                <p class="card-text">{{ str_limit($item->attraction_details, $limit = 300, $end = '...') }}</p>
                                                <div class="news_post_link" style="margin-top:0px;"><a href="{{url('get/details/'.$item->id)}}">Read More</a></div>
                                            </div>
                                        </div>
                                        <div class="card-footer w-100 text-muted">
                                            {{-- Footer stating cats are CUTE little animals --}}
                                        </div>
                                  </div>
                            {{-- <div class="news_container">


                                <div class="news_post">
                                    <div class="news_post_image"><img src="{{url($item->profile_pic)}}" alt="" style="width:100%;height:440px;"></div>
                                    <div class="news_post_content">
                                        <div class="news_post_date d-flex flex-row align-items-end justify-content-start">
                                            <div></div>
                                            <div>{{$item->business_address}}</div>

                                        </div>
                                    <div class="news_post_title"><a href="{{url('get/details/'.$item->id)}}">{{$item->business_name}} - (₱{{$item->business_price}})</a></div>
                                        <div class="news_post_category">
                                            <ul>
                                                <li><a href="#">{{$item->business_landmarks}}</a></li>
                                                <br>
                                                <li><i class="fas fa-eye"></i> {{$views[$k]}}</li>
                                            </ul>
                                        </div>
                                        <div class="news_post_text">
                                            <p>{{ str_limit($item->attraction_details, $limit = 300, $end = '...') }}</p>
                                        </div>
                                        <div class="news_post_link"><a href="{{url('get/details/'.$item->id)}}">Read More</a></div>
                                    </div>
                                </div>

                            </div> --}}
                            @endforeach
                                @endif
                            <!-- Pagination -->
                            <div class="pagination">
                                <ul class="d-flex flex-row align-items-start justify-content-start">
                                        <li>{{ $data->links() }}</li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
<br>
@if (!empty($input))
<section class="wrapper">
        <div class="container-fostrap">
            <div>
                    <i class="far fa-lightbulb" class="fostrap-logo"></i>
                {{-- <img src="https://4.bp.blogspot.com/-7OHSFmygfYQ/VtLSb1xe8kI/AAAAAAAABjI/FxaRp5xW2JQ/s320/logo.png" class="fostrap-logo"/> --}}
                <h1 class="heading">
                    Suggested For You
                </h1>
            </div>
            <div class="content">
                <div class="container">
                    <div class="row">
                            @foreach ($suggest as $item)
                            {{-- } --}}


                        <div class="col-xs-12 col-sm-4">
                            <div class="card">
                                <a class="img-card" href="{{url('get/tourist_details/'.$item->id)}}">
                                <img src="{{ asset('uploads') . '/'.  $item->photo }}" />
                              </a>
                                <div class="card-content">
                                    <h4 class="card-title">
                                        <a href="{{url('get/tourist_details/'.$item->id)}}">{{$item->name}}
                                      </a>
                                    </h4>
                                    <p class="">
                                            {{ str_limit($item->description, $limit = 100, $end = '...') }}
                                    </p>
                                </div>
                                <div class="card-read-more">
                                    <a href="{{url('get/tourist_details/'.$item->id)}}" class="btn btn-link btn-block">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>



    @endif




<div class="container">
    <div class="row" >
        <div class="col-sm-6" >

                <h4 class="sidebar_title">Top Rated</h4>

            <?php $ratecount=0;?>
            @foreach ($top as $k => $item)
            <div class="card">
                    <div class="row no-gutters">
                        <div class="col-auto">
                            <img src="{{url($item->profile_pic)}}"width="200px" height="200px" class="img-fluid" alt="">
                        </div>
                        <div class="col">
                            <?php
                                $rating = $item->total;
                                ?>
                            <div class="card-block px-2">
                                <h4 class="card-title"><a href="{{url('get/details/'.$item->id)}}">{{$item->business_name}} - (₱{{$item->business_price}})</a></h4>
                            <p class="card-text">

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






                                ({{number_format($item->total,1)}})Rating <br>
                                <form action="{{url('tag')}}" method="get" enctype="multipart/form-data">
                                    {{csrf_field()}}   Tags:
                                    @for ($i = 0; $i < count($tags_top[$k]); $i++)
                                <button name="tag" value="{{$tags_id_top[$k][$i]}}" type="submit" style=" border:none;" > <span class="badge badge-info">{{$tags_top[$k][$i]}}</span></button>
                                    @endfor

                                </form>
                                {{$item->business_address}} <br> {{$item->business_website}} <br>{{$item->business_number}}<br> {{ str_limit($item->attraction_details, $limit = 100, $end = '...') }}</p>
                                <div class="news_post_link" style="margin-top:0px;"><a href="{{url('get/details/'.$item->id)}}">Read More</a></div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer w-100 text-muted">
                        {{-- Footer stating cats are CUTE little animals --}}
                    </div>
              </div>
              @endforeach

        </div>

        <div class="col-sm-6" >

                <h4 class="sidebar_title">Most Viewed</h4>

            <?php $ratecount=0;?>
            @foreach ($view as $k => $item)
            <div class="card">
                    <div class="row no-gutters">
                        <div class="col-auto">
                            <img src="{{url($item->profile_pic)}}"width="200px" height="200px" class="img-fluid" alt="">
                        </div>
                        <div class="col">
                            <div class="card-block px-2">
                                <h4 class="card-title"><a href="{{url('get/details/'.$item->id)}}">{{$item->business_name}} - (₱{{$item->business_price}})</a></h4>
                                <p class="card-text"><i class="fas fa-eye" style="color:tomato"></i> {{$item->total}} <br>
                                    <form action="{{url('tag')}}" method="get" enctype="multipart/form-data">
                                        {{csrf_field()}}   Tags:
                                        @for ($i = 0; $i < count($tags_view[$k]); $i++)
                                    <button name="tag" value="{{$tags_id_view[$k][$i]}}" type="submit" style=" border:none;" > <span class="badge badge-info">{{$tags_view[$k][$i]}}</span></button>
                                        @endfor

                                    </form> {{$item->business_address}}<br> {{$item->business_website}} <br>{{$item->business_number}} <br> {{ str_limit($item->attraction_details, $limit = 100, $end = '...') }}


                                </p>
                                <div class="news_post_link" style="margin-top:0px;"><a href="{{url('get/details/'.$item->id)}}">Read More</a></div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer w-100 text-muted">
                        {{-- Footer stating cats are CUTE little animals --}}
                    </div>
              </div>
              @endforeach

        </div>
    </div>
</div>
</div>
</div>
@endsection
@section('footer')
<script src="{{url('theme/js/news.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    var count = "0";
    $(document).ready(function() {
       $("#filter-form").hide();
       $("#form-trigger").click(function(){


           if(count == "0"){
               $("#filter-form").show('slow')
            count="1";

           }
           else if(count == "1"){
                $("#filter-form").hide('slow');
                count="0";

            }

       });
   });

   </script>
@endsection
