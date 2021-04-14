@extends('admin.layouts.taravel')

@section('head')

@endsection

@section('content')
<!-- PAGE REAL WRAPPER -->



      <!-- FULL WRAPPER -->

      <div class="main-wrapper-full" style="width: 100%; height: auto; padding: 5%; ">
        <!-- Wrapper of TD -->
        <div class="index-tourist-thumb" style="width: 90%; height: 700px; margin: 5%; ">

        <h4><a href="{{url('/taravel/tourist_destination')}}">Searched Tourist Destination..</a></h4>
        {{-- @if ($tour->count() > 0) --}}

        @forelse($tour as $tour)


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
            @empty
                No results found
        @endforelse

    {{-- @endif --}}
        <h6 style="float: right;"><a href="{{url('/taravel/tourist_destination')}}">See all...</a></h6>
        </div>


        <!-- Wrapper of hotels -->
        <div class="index-tourist-thumb" style="width: 90%; height: 700px; margin: 5%; ">
        <h4><a href="{{url('/taravel/hotelandresorts')}}">Searched Hotels and Resorts</a></h4>

         {{-- @if ($hotel->count() > 0) --}}

            @forelse ($hotel as $hot)


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
                @empty

                No results found
                @endforelse

        {{-- @endif --}}
        <h6 style="float: right;"><a href="{{url('/taravel/hotelandresorts')}}">See all...</a></h6>
        </div>



        <!-- Wrapper of rest -->
        <div class="index-tourist-thumb" style="width: 90%; height: 700px; margin: 5%; ">
        <h4><a href="{{url('/taravel/restaurant')}}">Searched Restaurants</a></h4>
        {{-- @if ($restaurant->count() > 0) --}}

        @forelse ($restaurant as $res)


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
            @empty
            No results found
            @endforelse

    {{-- @endif --}}
        <h6 style="float: right;"><a href="{{url('/taravel/restaurant')}}">See all...</a></h6>

        </div>
      </div>

@endsection
@section('footer')

@endsection
