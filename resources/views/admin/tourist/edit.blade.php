@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_edit-edit') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::model($tourist, array('files' => true, 'class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.tourist.update', $tourist->id))) !!}

<div class="form-group">
    {!! Form::label('name', 'name', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('name', old('name',$tourist->name), array('class'=>'form-control')) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('address', 'address', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('address', old('address',$tourist->address), array('class'=>'form-control')) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('latitude', 'Latitude', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        <input type="number" class="form-control" name="lat" step=".0000000001" value="{{$tourist->lat}}">
    </div>
</div>
<div class="form-group">
    {!! Form::label('longitude', 'Longitude', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        <input type="number" class="form-control" name="lng" step=".0000000001" value="{{$tourist->lng}}">

    </div>
</div>
<div class="form-group">
    {!! Form::label('website', 'website', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('website', old('website',$tourist->website), array('class'=>'form-control')) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('categorytags_id', 'attraction type', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('categorytags_id', $categorytags, old('categorytags_id',$tourist->categorytags_id), array('class'=>'form-control')) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('mostly_good', 'This is good mostly for', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('mostly_good', old('mostly_good',$tourist->mostly_good), array('class'=>'form-control')) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('user_id', 'user', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('user_id', old('user_id',$tourist->user_id), array('class'=>'form-control')) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('description', 'Destination', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('description', old('description',$tourist->description), array('class'=>'form-control')) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('photo', 'photo', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('photo') !!}
        {!! Form::hidden('photo_w', 4096) !!}
        {!! Form::hidden('photo_h', 4096) !!}

    </div>
</div>
<label for="">Select Region</label>
<div class="form-group">
    <div class="row">
        <?php  $checker = ''; ?>
        @foreach ($region as $re)
            @if (!empty($regions))
                @foreach ($regions as $reg)
                    @if ($reg->region_id == $re->id)
                        <?php  $checker = 'checked'; ?>
                @endif
                @endforeach

            @endif
        <div class="col-sm-3 ">
        <br><input type="checkbox" style="margin-left: 30px;" {{$checker}} pull-right name="region[]"  value="{{$re->id}}" id="">{{$re->name}} <br>
        </div>
        <?php  $checker = ''; ?>
    @endforeach
    </div>
</div>
<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.tourist.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection
