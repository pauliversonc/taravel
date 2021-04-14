@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_create-add_new') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::open(array('files' => true, 'route' => config('quickadmin.route').'.tourist.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

<div class="form-group">
    {!! Form::label('name', 'Name', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('name', old('name'), array('class'=>'form-control')) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('address', 'Address', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('address', old('address'), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
        {!! Form::label('latitude', 'Latitude', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            <input type="number" class="form-control" name="lat" step=".0000000001">
        </div>
</div>
<div class="form-group">
        {!! Form::label('longitude', 'Longitude', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10">
            <input type="number" class="form-control" name="lng" step=".0000000001">

        </div>
</div>
<div class="form-group">
    {!! Form::label('website', 'Website', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('website', old('website'), array('class'=>'form-control')) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('categorytags_id', 'Attraction Type', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('categorytags_id', $categorytags, old('categorytags_id'), array('class'=>'form-control')) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('mostly_good', 'This is good mostly for', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('mostly_good', old('mostly_good'), array('class'=>'form-control')) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('user_id', 'user', array('hidden')) !!}
    <div class="col-sm-10">
        {!! Form::text('user_id', Auth::user()->id, array('hidden')) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('description', 'Destination', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('description', old('description'), array('class'=>'form-control')) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('photo', 'Photo', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('photo') !!}
        {!! Form::hidden('photo_w', 4096) !!}
        {!! Form::hidden('photo_h', 4096) !!}
    </div>
</div>
<label for="">Select Region</label>
<div class="form-group">
    <div class="row">

        @foreach ($region as $re)

        <div class="col-sm-3 ">
        <br><input type="checkbox" style="margin-left: 30px;" pull-right name="region[]"  value="{{$re->id}}" id="">{{$re->name}} <br>
        </div>

    @endforeach
    </div>
</div>
<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit( trans('quickadmin::templates.templates-view_create-create') , array('class' => 'btn btn-primary')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection
