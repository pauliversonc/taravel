@extends('admin.layouts.taravel2')

@section('head')
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/news.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/news_responsive.css')}}">
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
@endsection

@section('content')
<div class="home">
		<div class="background_image" style="filter:blur(2px); background-image:url({{asset('storage/hdpics/sinulog1.jpg')}})"></div>
	</div>
    {{-- @include('partials.search-bar'); --}}
    @if(!empty($partner))
    <form action="{{url('travellers/partner/agency/rate')}}" method="post" style="width: auto; ">
    {{ csrf_field() }}
        <div class="row" style="background: #0E4D92; margin:1px;" >
        <style>
        .img-thumbnail{
            height:300px;
            width: 550px;
            float: right;
        }
        </style>
            <div class="col-sm-1"> </div>
            <div class="col-sm-4" style="margin:10px; color:white;">
                    <h1>{{$partner[0]->name}}</h1>
                    <caption>Travel Agency</caption>
                    <br>
                    @if(count($aveAgentrate)>0)

                  <?php
                    $rating = $aveAgentrate[0]->total;
                  ?>
 <label>Rating:</label>
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
                    ({{number_format($aveAgentrate[0]->total,1)}})



                    @else
                    <label>No Rating</label>
                    @endif
                    <br>
                    <hr>
                    @php
                    $status1="";
                    $status2="";
                    $status3="";
                    $status4="";
                    $status5="";
                    @endphp

                    <input type="hidden" name="partner_id" value="{{$partner[0]->id}}">
                    <?php
                    $user_id = '';
                    $rate = 0;
                    ?>

                    @auth
                    @foreach ($agentrate as $item)
                    @if(Auth::user()->id==$item->user_id)
                        <?php $user_id = $item->user_id;
                            $rate  = $item->rate;
                         ?>

                    @endif
                    @endforeach

                            <input id="input-1" name="rate" class="rating rating-loading" value="
                            {{ !empty($user_id)?($user_id==Auth::user()->id)?$rate:0:0}}" data-min="0" data-max="5" data-step="1" data-size="sm">

                    <button style="margin-left:10px;" type="submit" name="submit" class="btn btn-primary btn-sm">Rate</button>
                    @else
                    <div style="background:lightgrey; text-align:center;">
                        <h5>Please <a style="color:blue;" href="{{route('login')}}">Log in</a> or <a style="color:blue;" href="{{url('register/user')}}">Sign up</a> to rate</h5>
                        </div>

                    @endauth
                </div>
            <div class="col-sm-6" style="margin:10px;" >
                    <img class="img-thumbnail" src="{{url('/uploads/'.$partner[0]->photo)}}">
            </div>
            <div class="col-sm-1"> </div>
        </div>
    </form>
        @endif
        <nav aria-label="breadcrumb" class="breadcrumb d-flex justify-content-between" style="margin-bottom:-40px">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/taravel/agency')}}">Travel Agency Partner</a></li>
                  <li class="breadcrumb-item active"><a href="#">Profile</a></li>
                  </ol>
              </nav>
              
              <br>
        <div class="news">
                <div class="container">
                    <div class="row">
                        <!-- News Container -->
                        <div class="col-lg-12">
                            <div class="news_container">
                                <div class="row">
                                @if($agency->count())
                                    @foreach ($agency as $i)
                                <!-- News Post -->
                                <div class="col-sm-6">
                                <div class="news_post">
                                    <style>
                                        .img-fluid{
                                            min-width: 500px;
                                            min-height: 300px;
                                            max-height:300px;
                                            max-width: 500px;
                                        }
                                    </style>
                                    <div class="news_post_image"><img src="{{ asset('uploads') . '/'.  $i->photo }}" class="img-fluid"  alt=""></div>
                                    <div class="news_post_content">
                                        <div class="news_post_date d-flex flex-row align-items-end justify-content-start">
                                            {{-- <div>{{$i->id}}</div> --}}
                                            <div>Package</div>
                                        </div>
                                    <div class="news_post_title"><a href="#">{{$i->name}}</a></div>
                                        <div class="news_post_category">
                                            <ul>
                                            <li><a href="#">{{$i->location}}</a></li>
                                            </ul>
                                        </div>
                                        <br>
                                        <div>
                                            <div>
                                                @foreach ($popagency as $pa)
                                            <div></div>
                                                    @if($pa->post_id==$i->id)
                                                    <?php
                                                    $rating = 0;
                                                    $rating = $pa->total
                                                    ?>
                                                     <label for="">Rating:</label>
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
                                                        ({{number_format($pa->total,1)}})
                                                    @endif

                                                @endforeach
                                            </div>
                                            <br>
                                            @auth
                                            <?php
                                            $user_id = '';
                                            $rate = 0;
                                            ?>
                                            <form action="{{url('travellers/agency/rate')}}" method="post" style="width: auto; ">
                                                {{ csrf_field() }}
                                                <style>
                                                        .rb{
                                                            margin-left:5px;
                                                        }
                                                        </style>
                                                         <input type='hidden' name="post_id" value="{{$i->id}}" >
                                                <?php
                                                $status1="";
                                                $status2="";
                                                $status3="";
                                                $status4="";
                                                $status5="";?>
                                                @foreach ($rates as $item)
                                                @if(Auth::user()->id==$item->user_id)
                                                @if($i->id==$item->post_id)
                                                <?php $user_id = $item->user_id;
                                                $rate  = $item->rate;
                                             ?>
                                                @if($item->rate==1)
                                                <?php $status1='checked="checked"';?>
                                                @elseif($item->rate==2)
                                                <?php $status2='checked="checked"';?>
                                                @elseif($item->rate==3)
                                                <?php $status3='checked="checked"';?>
                                                @elseif($item->rate==4)
                                                <?php $status4='checked="checked"';?>
                                                @elseif($item->rate==5)
                                                <?php $status5='checked="checked"';?>
                                                @endif
                                                @endif
                                                @endif
                                                @endforeach

                                                 <input id="input-1" name="rate" class="rating rating-loading" value="
                                                 {{ !empty($user_id)?($user_id==Auth::user()->id)?$rate:0:0}}" data-min="0" data-max="5" data-step="1" data-size="sm">
                                                <button style="margin-left:10px;" type="submit" name="submit" class="btn btn-primary btn-sm">Rate</button>
                                            </form>
                                            @else
                                            <div style="background:lightgrey; text-align:center;">
                                                <h5>Please <a style="color:blue;" href="{{route('login')}}">Log in</a> or <a style="color:blue;" href="{{url('register/user')}}">Sign up</a> to rate</h5>
                                                </div>
                                            @endauth
                                                <br>
                                        </div>
                                        <div class="modal fade bd-example-modal-lg" id="{{'modal'.$i->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
                                                    <div class="modal-content" style="padding:2em;">
                                                              {!!$i->coverage!!}
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                                      </div>
                                                </div>
                                        <div class="news_post_text">
                                            <p>
                                                    {!! str_limit($i->coverage, $limit = 500, $end = '...') !!}</p>
                                                    {{-- <div class="news_post_link"><a href="">Read More</a></div> --}}
                                        </div>
                                        {{-- <div class="news_post_link"><a href="#">Read More</a></div> --}}
                                    </div>
                                    <br>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{'#modal'.$i->id}}">Read More</button>
                                    @auth
                                    @if(Auth::user()->role_id==1 || Auth::user()->role_id==3)
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{'#2modal'.$i->id}}"><i class="fas fa-plus" ></i>&nbsp;Add to Custom Package</button>
                                    <form action="{{url('travellers/add/package')}}" method="post">
                                        {{ csrf_field() }}
                                    <div class="modal fade bd-example-modal-lg" id="{{'2modal'.$i->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
                                                <div class="modal-content" style="padding:2em;">
                                                        <h2>{{$i->name}}</h2>
                                                        {{$i->location}}
                                                        <br>{{"Budget Price: ".$i->price}}
                                                        <input type="hidden" name="price" value="{{$i->price}}">
                                                        <input type="hidden" name="name" value="{{$i->name}}">
                                                        <input type="hidden" name="address" value="{{$i->location}}">
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
                                </div>                                @endforeach

                            </div>

                            <!-- Pagination -->
                            <div class="pagination">
                                <ul class="d-flex flex-row align-items-start justify-content-start">

                                    <li>{{ $agency->links() }}</li>

                                </ul>
                            </div>
                            @endif
                            </div>
                        </div>

                        {{-- <!-- News Sidebar -->
                        <div class="col-lg-4">
                            <div class="news_sidebar">

                                <!-- Categories -->
                                <div class="categories">
                                    <div class="sidebar_title">Categories</div>
                                    <div class="sidebar_list">
                                        <ul>
                                            <li><a href="#"><div class="d-flex flex-row align-items-start justify-content-start">Travels<span class="ml-auto">(09)</span></div></a></li>
                                            <li><a href="#"><div class="d-flex flex-row align-items-start justify-content-start">Organization<span class="ml-auto">(12)</span></div></a></li>
                                            <li><a href="#"><div class="d-flex flex-row align-items-start justify-content-start">Tips & Tricks<span class="ml-auto">(16)</span></div></a></li>
                                            <li><a href="#"><div class="d-flex flex-row align-items-start justify-content-start">Uncategorized<span class="ml-auto">(22)</span></div></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Latest News -->
                                <div class="latest">
                                    <div class="sidebar_title">Latest News</div>
                                    <div class="latest_container">

                                        <!-- Latest Post -->
                                        <div class="latest_post d-flex flex-row align-items-start justify-content-start">
                                            <div class="latest_post_image"><img src="images/latest_1.jpg" alt=""></div>
                                            <div class="latest_post_content">
                                                <div class="latest_post_date d-flex flex-row align-items-end justify-content-start">
                                                    <div class="latest_post_day">02</div>
                                                    <div class="latest_post_month">june</div>
                                                </div>
                                                <div class="latest_post_title"><a href="#">Best tips to travel light</a></div>
                                                <div class="latest_post_text"><p>Pellentesque sit amet..</p></div>
                                            </div>
                                        </div>

                                        <!-- Latest Post -->
                                        <div class="latest_post d-flex flex-row align-items-start justify-content-start">
                                            <div class="latest_post_image"><img src="images/latest_2.jpg" alt=""></div>
                                            <div class="latest_post_content">
                                                <div class="latest_post_date d-flex flex-row align-items-end justify-content-start">
                                                    <div class="latest_post_day">02</div>
                                                    <div class="latest_post_month">june</div>
                                                </div>
                                                <div class="latest_post_title"><a href="#">Best tips to travel light</a></div>
                                                <div class="latest_post_text"><p>Pellentesque sit amet..</p></div>
                                            </div>
                                        </div>

                                        <!-- Latest Post -->
                                        <div class="latest_post d-flex flex-row align-items-start justify-content-start">
                                            <div class="latest_post_image"><img src="images/latest_3.jpg" alt=""></div>
                                            <div class="latest_post_content">
                                                <div class="latest_post_date d-flex flex-row align-items-end justify-content-start">
                                                    <div class="latest_post_day">02</div>
                                                    <div class="latest_post_month">june</div>
                                                </div>
                                                <div class="latest_post_title"><a href="#">Best tips to travel light</a></div>
                                                <div class="latest_post_text"><p>Pellentesque sit amet..</p></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="travello">
                                    <div class="background_image" style="background-image:url(images/travello.jpg)"></div>
                                    <div class="travello_content">
                                        <div class="travello_content_inner">
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </div>
                                    <div class="travello_container">
                                        <a href="#">
                                            <div class="d-flex flex-column align-items-center justify-content-end">
                                                <span class="travello_title">Get a 20% Discount</span>
                                                <span class="travello_subtitle">Buy Your Vacation Online Now</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
@endsection
@section('footer')
<script src="{{url('theme/js/news.js')}}"></script>
<script>
        $("#input-id").rating();
        </script>
@endsection
