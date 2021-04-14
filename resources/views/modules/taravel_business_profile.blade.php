@extends('admin.layouts.master')

@section('content')


<form action="{{url('business/post')}}" method="post" enctype="multipart/form-data">
<div class="portlet box grey-gallery">
        <div class="portlet-title">
        <div class="caption">Business Profile</div>
    </div>
    <div class="portlet-body">

            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-6">
                        <label for="">Business Picture</label>
                        <input type="file" class="form-control" name="business_profile">
                    </div>
                <div class="col-sm-6">
                    <label for="">Business name</label>
                <input type="text" class="form-control" name="business_name" value="{{empty($business->business_name)?'':$business->business_name}}">
                </div>


            </div>
            <?php
                $select = '';
            ?>
            <div class="row">
                    <div class="col-sm-6">
                        <label for="">Business Owner</label>
                        <input type="text" class="form-control" name="business_owner" value="{{empty($business->business_owner)?'':$business->business_owner}}">
                    </div>
                    <div class="col-sm-6">
                            <label for="">Business Type</label>
                            <select name="business_type" class="form-control" id="buss_type">
                                @if ($type->count()>0)
                                @foreach ($type as $r)
                                    <option
                                    @if (!empty($business))

                                    @if ($business->business_type_id == $r->id)
                                            <?php
                                                $select = 'selected';
                                            ?>
                                    @else
                                    <?php
                                        $select = '';
                                    ?>
                                    @endif
                                    @endif
                                    value="{{$r->id}}" {{$select}}>{{$r->name}} </option>

                                    @endforeach
                                    @endif
                                </select>

                        </div>
            </div>

            <div class="row">

                <div class="col-sm-6">
                    <label for="">Business Website</label>
                    <input type="text" class="form-control" name="business_website" value="{{empty($business->business_website)?'':$business->business_website}}">
                </div>
                <div class="col-sm-6">
                    <label for="">Business Contact No.</label>
                    <input type="text" class="form-control" name="business_number" value="{{empty($business->business_number)?'':$business->business_number}}">
                </div>
            </div>


    </div>
</div>
<input type="hidden" name="update" value="{{empty($business->id)?'null':$business->id}}">
<div class="portlet box grey-gallery">
        <div class="portlet-title">
        <div class="caption">Business Address</div>
    </div>
    <div class="portlet-body">

        <div class="row">
                <div class="col-sm-6">
                        <label for="">City / Municipality</label>
                        <input type="text" class="form-control" name="business_city" value="{{empty($business->business_city)?'':$business->business_city}}">
                </div>
                <div class="col-sm-6">
                        <label for="">Street Address</label>
                        <input type="text" class="form-control" name="business_address" value="{{empty($business->business_address)?'':$business->business_address}}">
                </div>
        </div>
        <div class="row">
                <div class="col-sm-6">
                        <label for="">Barangay</label>
                        <input type="text" class="form-control" name="business_brgy" value="{{empty($business->business_brgy)?'':$business->business_brgy}}">
                </div>
                <div class="col-sm-6">
                        <label for="">Zip Code</label>
                        <input type="text" class="form-control" name="business_zip" value="{{empty($business->business_zip)?'':$business->business_zip}}">
                </div>
        </div>
        <div class="row">
                <div class="col-sm-6">
                        <label for="">Landmarks</label>
                        <input type="text" class="form-control" name="business_landmarks" value="{{empty($business->business_landmarks)?'':$business->business_landmarks}}">
                </div>
                <div class="col-sm-6">
                        <label for="">Price</label>
                        <input type="text" class="form-control" name="business_price" value="{{empty($business->business_price)?'':$business->business_price}}">
                </div>
        </div><br>
            <div class="row">
                    <div class="col-sm-6">
                        <small style="color:red">*To get the coordinates please visit google maps</small> <br>
                        <label for="">Latitude </label>
                        <input type="number" name="lat" step="0.0000000001" value="{{empty($business->lat)?'':$business->lat}}" class="form-control">
                    </div>
                    <br>
                    <div class="col-sm-6">
                        <label for="">Longitude</label>
                        <input type="number" name="lng" step="0.0000000001" value="{{empty($business->lng)?'':$business->lng}}" class="form-control">
                    </div>
                </div>
                <div class="row">
                        <?php

                                $check = '';

                            ?>@if(!empty($business->business_type_id))
                            @foreach ($category->where('buss_type',$business->business_type_id) as $c)
                            <div class="col-sm-3">
                                <div style=""><br><br>
                            <label for="">{{$c->name}}</label><br>
                                @foreach ($categoryTags->where('cat_id','=',$c->id)->where('catT_type',$business->business_type_id) as $cat)

                                @if (!empty($tags))
                                @foreach ($tags as $t)
                                    @if ($t->category_tags_id == $cat->catT_id)
                                         <?php  $check = 'checked'; ?>
                                   @endif
                                @endforeach

                                @endif
                                <br><input style="margin-left:10px;" type="checkbox"{{$check}} name="category_tags[]" id="" value="{{$c->id}}_{{$cat->catT_id}}">{{$cat->catT_name}}<br>
                                <?php $check = ''; ?>
                                @endforeach
                            </div>

                        </div>
                            @endforeach
                            @endif



                    </div><br>
                    <?php

                                $checker = '';

                            ?>
                    @if(!empty($business->business_type_id))
                    <label for="region">Select Region Here</label>
                    <div class="row">

                            @if ($region->count())


                                @foreach ($region as $re)

                                    @if (!empty($regLib))
                                    @foreach ($regLib as $rl)
                                        @if ($rl->region_id == $re->id)
                                            <?php  $checker = 'checked'; ?>
                                    @endif
                                    @endforeach

                                    @endif

                                    <div class="col-sm-3">
                                    <br><input type="checkbox" name="region[]" {{$checker}} value="{{$re->id}}" id="">{{$re->name}} <br>
                                    </div>
                                    <?php $checker = ''; ?>
                                @endforeach
                         @endif

                    </div>
                    @endif
                    <br>
                <div class="row">
                        <div class="col-sm-12">
                            <label for="">Attraction Details</label>
                            <textarea name="attraction_details" class="form-control" id="" cols="30" rows="10" value="{{empty($business->attraction_details)?'':$business->attraction_details}}">{{empty($business->attraction_details)?'':$business->attraction_details}}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-4">
                            @if (is_null($business))
                            <button type="submit" class="form-control btn btn-primary">Submit</button>
                            @else
                            <button type="submit" class="form-control btn btn-primary">Update</button>
                            @endif

                        </div>
                        <div class="col-sm-4">

                            </div>
                    </div>

    </div>
</div>
</form>




@endsection


