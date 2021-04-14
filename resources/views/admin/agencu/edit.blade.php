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

{!! Form::model($agencu, array('files' => true, 'class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.agencu.update', $agencu->id))) !!}

<div class="form-group">
    {!! Form::label('photo', 'Photo', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('photo') !!}
        {!! Form::hidden('photo_w', 4096) !!}
        {!! Form::hidden('photo_h', 4096) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('name', 'name', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('name', old('name',$agencu->name), array('class'=>'form-control')) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('price', 'price', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('price', old('price',$agencu->price), array('class'=>'form-control')) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('location', 'location', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('location', old('location',$agencu->location), array('class'=>'form-control')) !!}

    </div>
</div>
<div class="form-group">
    {!! Form::label('days', 'days', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::number('days', old('days'), array('class'=>'form-control')) !!}

    </div>
</div>
<div class="form-group">

        {!! Form::label('partner_id', 'partner', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">

            <select name="partner_id" class="form-control" id="">
                @foreach ($partner as $item)
                @if ($item->id == $agencu->partner_id)
                <option class="form-control" selected value="{{$item->id}}">{{$item->name}}</option>
                @else
                <option class="form-control" value="{{$item->id}}">{{$item->name}}</option>
                @endif

                @endforeach


            </select>

    </div>
</div>
<div class="form-group">
        {!! Form::label('Package Type', 'Package Type', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-10" >
    @php
     $package=DB:: table('package_type')
                ->select('*')
                ->get();
    @endphp
          @if ($package->count())
          <select name="package_type" class="form-control" id="">
              @foreach ($package as $p)
          <option value="{{$p->id}}">{{$p->name}}</option>
          @endforeach
      </select>
          @endif

                </div>
    </div>
    <div class="form-group">
    {!! Form::label('coverage', 'coverage', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('coverage', old('coverage',$agencu->coverage), array('class'=>'form-control ckeditor')) !!}

    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.agencu.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection
