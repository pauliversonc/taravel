@extends('admin.layouts.taravel2')

@section('head')
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/news.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/news_responsive.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about_responsive.css')}}">
<script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>
<link href="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css" rel="stylesheet">

@endsection

@section('content')
<div class="home">
		<div class="background_image" style="filter:blur(2px); background-image:url({{asset('storage/hdpics/Panagbenga.jpg')}})"></div>
	</div>
    <div class="home_search">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="home_search_container">
                        
                       <h2><span >
                        <i style="text-shadow: 2px 2px white; color:black; font-weight:bold; font-family: 'Tangerine', serif !important;">
                            @if(Request::path()=="taravel/tourist_destination")
                                Want To Discover More Places?&nbsp;&nbsp;
                            @endif
                        </i></span></h2>
                        <div class="home_search_title">
                            Search for your trip
                        </div>
                        <div class="home_search_content">
                            <form action="{{url('/taravel/tourist_destination')}}" method="get" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="page" value="tourist">




                                <div class="d-flex flex-lg-row flex-column align-items-start justify-content-lg-between justify-content-start">
                                        <div style="display:flex; width:100%;">
                                            
                                            <i class="fas fa-map-marker-alt" style="color:red; padding:15px;"> Place</i>
                                            <select size="6" id="editable-select" name="search" style="width:90%" class="form-control search_input" placeholder="Travel Destination">
                                                    <option style="color:red!important;font-wieght:700!important">Destination</option>
                                                    @if (!empty($input))
                                                    <option value="{{$input}}" selected>{{$input}}</option>
                                                    @endif
                                                        @foreach($search as $a)
                                                        <option value="{{$a->name}}">{{$a->name}}</option>
                                                        @endforeach

                                            </select>
                                            <script>$('#editable-select').editableSelect();</script>
                                        </div>
                                     <button type="submit"  class="home_search_button">search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="container">
<div class="row">
                        <div class="col" style="margin-top:10px;">
                                <button class="home_search_button" type="button" id="form-trigger">
                                        view Filter
                                      </button>

                            </div>
                </div>
                <br>
</div>

    <div class="container"  id="filter-form" >
            <form action="{{url('/taravel/tourist_destination')}}" method="post">
                {{ csrf_field() }}
                @if (!empty($input))
                <input type="hidden" name="search" value="{{$input}}">
                @endif

        <div class="row" style="border:2px solid black; padding: 10px; border-radius: 8px;">


                    @foreach ($category as $cat)
                <div class="col-sm-3">
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
                <div class="col-sm-1.5">
                <div class="sidebar_title">Region</div>
                    <br>
                    <ul>
                        @for ($i = 0; $i < count($region)/2; $i++)
                        <li><div class="d-flex flex-row align-items-start justify-content-start"> <input type="checkbox" name="filter_region[]" value="{{$region[$i]->id}}">{{$region[$i]->name}}</div></li>
                        @endfor

                        <br>
                    </ul>
                </div>
                <div class="col-sm-1.5" style="margin-left:4em;">
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
    </div><br>

    <div class="news">
            <div class="container">
                <div class="row"  style="border:2px solid black; padding: 10px; border-radius: 8px;">
                        <h4 class="sidebar_title">Tourist Destination</h4>
                    <!-- News Container -->
                    <div class="col-lg-12">
                            @if($data->count()>0)
                            <?php $ratecount=0;?>
                            @foreach ($data as $k => $item)
                            <div class="card" style="padding:5px;">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <img src="{{ asset('uploads') . '/'.  $item->photo }}"width="200px" height="200px" class="img-fluid" alt="">
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="card-block px-2">
                                                <h4 class="card-title"><a href="{{url('get/tourist_details/'.$item->id)}}">{{$item->name}}</a></h4>
                                                <p class="card-text"><i class="fas fa-eye" style="color:tomato"></i> {{$views[$k]}} <br> {{$item->address}}
                                                <br>
                                                <?php
                                                $rating = $rates[$k];

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
                                                    ({{$rates[$k]}}) rating


                                                    <form action="{{url('tag')}}" method="get" enctype="multipart/form-data">
                                                        {{csrf_field()}}
                                                     Tags:   <button name="tag" value="{{$item->cat_id}}" type="submit" style=" border:none;" > <span class="badge badge-info">{{$item->cat_name}}</span></button>
                                                    </form>
                                                </p>

                                            </div>
                                        </div>
                                        <div class="col-sm-4" >
                                            <p class="sidebar_title">Details:</p>
                                            <p class="card-text">{{ str_limit($item->description, $limit = 300, $end = '...') }}</p>
                                            <div class="news_post_link" style="margin-top:0px;"><a href="{{url('get/tourist_details/'.$item->id)}}">Read More</a></div>
                                        </div>
                                    </div>
                                    <div class="card-footer w-100 text-muted">
                                        {{-- Footer stating cats are CUTE little animals --}}
                                    </div>
                              </div>

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
        <br>
        <div class="container">
                <div class="row" >
                    <div class="col-sm-6" >

                            <h4 class="sidebar_title">Top Rated</h4>
                        @if($data->count()>0)
                        <?php $ratecount=0;?>
                        @foreach ($top as $k => $item)
                        <div class="card">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <img src="{{ asset('uploads') . '/'.  $item->photo }}"width="200px" height="200px" class="img-fluid" alt="">
                                    </div>
                                    <div class="col">
                                        <div class="card-block px-2">
                                        <h4 class="card-title"> <a href="{{url('get/tourist_details/'.$item->id)}}">{{$item->name}}</a></h4>
                                        <?php
                                            $rating = $item->total;

                                        ?>
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


                                            ({{number_format($item->total,1)}}) Rating 
                                            <form action="{{url('tag')}}" method="get" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                             Tags:   <button name="tag" value="{{$item->cat_id}}" type="submit" style=" border:none;" > <span class="badge badge-info">{{$item->cat_name}}</span></button>
                                            </form><br> {{$item->address}} <br>{{ str_limit($item->description, $limit = 100, $end = '...') }} </p>
                                            <div class="news_post_link" style="margin-top:0px;"><a href="{{url('get/tourist_details/'.$item->id)}}">Read More</a></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer w-100 text-muted">
                                    {{-- Footer stating cats are CUTE little animals --}}
                                </div>
                          </div>
                          @endforeach
                          @endif
                    </div>
                    <div class="col-sm-6" >

                            <h4 class="sidebar_title">Most Viewed</h4>
                        @if($data->count()>0)
                        <?php $ratecount=0;?>
                        @foreach ($view as $k => $item)
                        <div class="card">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <img src="{{ asset('uploads') . '/'.  $item->photo }}"width="200px" height="200px" class="img-fluid" alt="">
                                    </div>
                                    <div class="col">
                                        <div class="card-block px-2">
                                        <h4 class="card-title"> <a href="{{url('get/tourist_details/'.$item->id)}}">{{$item->name}}</a></h4>
                                        <p class="card-text"><i class="fas fa-eye" style="color:tomato"></i> {{number_format($item->total,0)}} viewed <br> <form action="{{url('tag')}}" method="get" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                         Tags:   <button name="tag" value="{{$item->cat_id}}" type="submit" style=" border:none;" > <span class="badge badge-info">{{$item->cat_name}}</span></button>
                                        </form> <br>{{$item->address}} <br>{{ str_limit($item->description, $limit = 100, $end = '...') }} </p>
                                        <div class="news_post_link" style="margin-top:0px;"><a href="{{url('get/tourist_details/'.$item->id)}}">Read More</a></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer w-100 text-muted">
                                    {{-- Footer stating cats are CUTE little animals --}}
                                </div>
                          </div>
                          @endforeach
                          @endif
                    </div>
                </div></div>
                <div style="overflow:hidden; width: 90%; height: auto;  margin: 5%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <br>
                        <h3 style="text-align:center;">Festivals</h3>
                        <style>
                                .suggested{
                                    transition: transform .2s;
                                }
                                .suggested:hover{
                                    -webkit-transform: scale(1.1);
                                }

                                </style>
                                <style>
                                    .why_content
                                            {
                                                padding-top: 18px;
                                                padding-bottom: 10px;
                                                padding-left: 35px;
                                                padding-right: 35px;
                                            }
                                </style>


<div class="" style="padding: 2em;">
        <div class="container">

            <div class="row ">
                {{-- <div class="col-lg-12"> --}}
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
                <div class="col-md-3 why_col">
                        <a style="color:black;" href="{{url('/things-todo/profle/'.$t->id)}}"> <div class="why_item" style="box-shadow:0 4px 8px grey">
                        <div class="why_image">
                            <img height="150px" width="300px" src="{{ asset('uploads') . '/'.  $t->photo }}" alt="">
                            {{-- <div class="why_icon d-flex flex-column align-items-center justify-content-center">
                                <img src="{{url('theme/images/why_3.svg')}}" alt="">
                            </div> --}}
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
            {{-- </div> --}}

            </div>
        </div>
    </div>
                </div></div>

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
