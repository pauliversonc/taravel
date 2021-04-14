@extends('admin.layouts.taravel')

@section('content')
<br><br><br><br><br>
<div class="sidebar-tourist-left" style="width: 18%; height: auto; float: left;  margin: 1%; padding: 2%;">
<form action="{{url('/taravel/restaurant')}}" method="post">
    {{ csrf_field() }}
        @foreach ($category as $cat)
            <h6>{{$cat->name}}</h6>
        <hr>
            @foreach ($tags->where('category_id',$cat->id) as $catT)
            <ul class="types-of-attraction">
              <li style="margin-left:-15%;"><input type="checkbox" name="filter[]" id="" value="{{$catT->id}}">{{$catT->name}}</a></li>
            </ul>
            @endforeach
        @endforeach
        @if ($region->count())
        <h6>Region</h6>
        <hr>
            @foreach ($region as $re)
                <ul class="types-of-attraction">

                    <li style="margin-left:-15%;">
                        <input type="checkbox" name="filter_region[]" value="{{$re->id}}">{{$re->name}}
                      </li>
                </ul>
            @endforeach
        @endif
        <button type="submit" class="form-control btn btn-primary">Filter</button>
    </form>
      </div>

      @if($data->count()>0)
      <?php $ratecount=0;  ?>
      @foreach ($data as $item)


      <!-- CONTENT -->
      <div class="content-tourist-right" style="width: 78%; height: auto; float: right; margin: 1%; padding: 1%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <!-- VERTICAL CARD -->
        <div class="content-card-wrapper" style="width:100%;  height: 300px; padding: 1%;">

          <!-- Card Image Part left -->



                  <div class="content-card-image-left" style="float: left; width: 26%; margin: 2%; ">
          <img src="{{url($item->profile_pic)}}" style="width:100%; height:240px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                  </div>
                  <!-- Card Image Part Right -->
                  <div class="content-card-info-right" style="float: right; width: 70%;  height:280px;  padding: 2%; overflow:auto; ">
                      <!-- Card Info Part float left -->
                      <div class="content-card-info-right-title" style="width: 100%; float: left;   height: 30px;">
                          <!-- CARD TITLE -->
            <p class="card-header-title"><a href="{{url('get/details/'.$item->id)}}">{{$item->business_name}}</a></p>
                          <hr>
                          <!-- left side -->
                          <div style="width: 50%; float: left; height: 180px;">
                            <p style="margin: 2%; font-weight: bold; color: #1a1a1a;">Attraction Details </p>
                            <p> {{$item->attraction_details}}</p>

                            <p style="margin: 2%; font-weight: bold; color: #1a1a1a;"> Address </p>
                            <p class="card-address-lefty-side">{{$item->business_address}},{{$item->business_brgy}},{{$item->business_city}}
                            </p>
                            <p style="margin: 2%; font-weight: bold; color: #1a1a1a;"> Landmarks </p>
                            <p class="card-address-lefty-side">{{$item->business_landmarks}}
                            </p>
                            <p style="margin: 2%; font-weight: bold; color: #1a1a1a;"> Zip Code </p>
                            <p class="card-address-lefty-side">{{$item->business_zip}}
                            </p>

                          </div>

                          <!-- Right side -->
                          <div style="width: auto; float: right;  height: auto;">
                            <p style="margin: 2%; font-weight: bold; color: #1a1a1a;">TaraVelers Ratings </p>
                            <div style="background-color: gray; height: auto; width: auto; text-align:center;">

                                <?php $averagerating=0; $sum=0; $innercount=0;
                                $elements= count($rateholder[$ratecount]);
                                ?>
                                   @if($elements>0)
                                   @for ($i = 0; $i < $elements; $i++)

                                     <?php $sum+=$rateholder[$ratecount][$i]->rate;
                                     $innercount++;
                                     ?>
                                    @endfor

                                   <?php $averagerating= $sum/$innercount; ?>
                                    <h4>{{$averagerating}}</h4>
                                    <?php $ratecount++;?>
                                    @else
                                                    <h4>{{"NO RATING"}}</h4>
                                    @endif
                          </div>

                            <p style="margin: 2%; font-weight: bold; color: #1a1a1a;"> Visit There Official Website! </p>


                            <p class="card-website-right-side">
                            '{{$item->business_website}}'
                            </p>

                        </div>

                      </div>

          </div>


              </div><br><br></div>
 @endforeach
          @endif


@endsection
@section('footer')
@endsection
