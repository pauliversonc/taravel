
<div class="home_search">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="home_search_container">
                        <h2><span>
                        <i style="text-shadow: 2px 2px white; color:black; font-weight:bold; font-family: 'Tangerine', serif !important;">
                        @if(Request::path()=="taravel/tourist_destination")
                            Want To Discover More Places?
                        @elseif(Request::path()=="taravel/hotelandresorts")
                            Where Do You Want To Stay?
                        @elseif(Request::path()=="taravel/restaurant")
                            Where Do You Want To Eat?
                        @endif
                        </i></span></h2>
                    <div class="home_search_title">
                        Search for your trip
                    </div>
                    <div class="home_search_content">
                            @if($partial == 1)
                            <form action="{{url('taravel/hotelandresorts')}}" method="get" enctype="multipart/form-data">
                        @elseif($partial == 2)
                        <form action="{{url('taravel/restaurant')}}" method="get" enctype="multipart/form-data">
                        @endif
                            {{csrf_field()}}



                            <div class="d-flex flex-lg-row flex-column align-items-start justify-content-lg-between justify-content-start">

                                    <i class="fas fa-map-marker-alt" style="color:red; margin-top:16px;margin-bottom:15px;"> Place</i>
                                    <select size="6" id="editable-select" name="search" class="search_input search_input_4" placeholder="Destination">
                                            <option style="color:red!important;font-wieght:700!important">Destination</option>
                                            @if (!empty($input))
                                            <option value="{{$input}}" selected>{{$input}}</option>
                                            @endif
                                                @foreach($search as $a)
                                                <option value="{{$a->business_name}}">{{$a->business_name}}</option>
                                                @endforeach

                                    </select>
                                    <script>$('#editable-select').editableSelect();</script>
                                {{-- <input style="" type="text" name="search" class="search_input search_input_2" placeholder="Destination"> --}}
                                <i class="fas fa-money-bill-alt" style="color:green;margin-top:16px;margin-bottom:15px;"> Min. Budget</i>
                                <input type="text" name="min" class="search_input search_input_2" placeholder="Minimum price" >
                                <i class="fas fa-money-bill-alt" style="color:green; margin-top:16px;margin-bottom:15px;"> Max. Budget</i>
                                <input type="text" name="max" class="search_input search_input_2" placeholder="Maximum price" >
                                <button type="submit"  class="home_search_button">search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
