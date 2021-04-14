@extends('admin.layouts.taravel')

@section('head')

@endsection

@section('content')
<br><br><br>
<!-- wrapper of huge image -->
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

<div class="item-image-zoom" style="width: 90%; height: 400px;background-color: blue; margin: 5%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">


        <img src="{{url('/uploads/'.$details->photo)}}" style="width: 100%; height: 100%;">
       <div class="bottom-left-image-zoom-gallery" style="color: white;"><a href="{{url('gallery/tourist/'.$details->id)}}">Gallery</a></div>
  <!-- 2nd colums API -->

   </div>

   <!-- wrapper-info -->
  <div style="width: 90%; height: 400px; margin: 5%;" >
      <div class="wrapper-info-left" style=" overflow:auto;width: 55%; margin-right: 2%; height: 100%; float: left; background-color: white; padding: 2%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
          <h3></h3>
          <hr>
          <h6 >Address</h6>
      <div class="min-details-t">{{$details->address}}</div><br>
          <h6>Website</h6>
          <div class="min-website-t">{{$details->website}}</div><br>
          <h6>This is good mostly for</h6>
          <div class="min-other-t">{{$details->mostly_good}}</div><br>
          <h6>TaraVeler Review</h6>
          <div class="min-other-t">
            @if($rates->count()>0)
              <?php
              $average_rating=number_format(($total/($counter1+$counter2+$counter3+$counter4+$counter5)),1);
              echo $average_rating;?>
              @else
                  {{"NO RATING"}}
              @endif</div><br>

      </div>
  <!-- MAPS API -->
      <div id="map" style="width: 43%; height: 100%; float: right; background-color: skyblue; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">



      </div>
  </div>
  <div style="overflow:auto; width: 90%; height: auto;  margin: 5%;  padding: 2%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
    <h3>Description</h3>
    <hr>
    <div class="row jumbotron" style="padding:2px;">
        <p>{{$details->description}}</p>
    </div>
</div>


  <div  style=" overflow:hidden; width: 90%; height: auto; margin: 5%; padding: 2%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); padding:10px;">
    <br>
    <h3 style="margin-left:10px;">Reviews Breakdown</h3>
        <br>
    <div class="row jumbotron" style="padding:2px; ">


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
               <?php
               $status1="";
               $status2="";
               $status3="";
               $status4="";
               $status5="";?>
               @foreach ($rates as $item)

               @if(Auth::user()->id==$item->rate_user_id)
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
                @endforeach

               <input class="rb" type="radio" name="rate"
                      {{$status1}} value="1">1
               <input class="rb" type="radio" name="rate"
                        {{$status2}} value="2">2
               <input class="rb" type="radio" name="rate"
                        {{$status3}} value="3">3
               <input class="rb" type="radio" name="rate"
                       {{$status4}} value="4">4
               <input class="rb" type="radio" name="rate"
                       {{$status5}} value="5">5
               <button style="margin-left:10px;" type="submit" name="submit" class="btn btn-primary btn-sm">Rate</button>
              @else
                <div style="background:lightgrey; text-align:center;">
                    <h5>Please <a style="color:blue;" href="{{route('login')}}">Log in</a> or <a style="color:blue;" href="{{url('register/user')}}">Sign up</a> to rate</h5>
                    </div>
                    @endauth
            </form>
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
    
    @for ($i = 0; $i < count($rand); $i++)

    @if (!empty($suggested[$rand[$i]]))
    <div class="wrapper-polaroid" style="width: 250px; margin: 1%; height: 300px; float: left; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div style="width: 250px; height: 200px; background-color: white; padding: 5%;">
        <a href="{{url('get/tourist_details/'.$suggested[$rand[$i]]->id)}}"><img src="{{ asset('uploads') . '/'. $suggested[$rand[$i]]->photo}}" style="width: 100%; height: 100%;"></a>
        </div>
        <div class="polaroidtitle" style="height: 100px; width: 250px; padding: 5%; background-color: white; color: black; text-transform: uppercase; color: black; font-weight: bold; width :100%;overflow:hidden;text-overflow: ellipsis; text-align: center;" >
            <a href="{{url('get/tourist_details/'.$suggested[$rand[$i]]->id)}}">
                {{$suggested[$rand[$i]]->name}}
             </a>
        </div>
    </div>
    @endif
     @endfor

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
<script src="https://maps.googleapis.com/maps/api/js?AIzaSyB5-r89NnLCwkmYEr-otFPRQ2qE60ZOxEw&callback=initMap" async defer></script>
@endsection
@section('footer')

@endsection
