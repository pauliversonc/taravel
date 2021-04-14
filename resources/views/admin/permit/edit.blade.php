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

{!! Form::model($permit, array('files' => true, 'class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.permit.update', $permit->id))) !!}

<div class="form-group">
    {!! Form::label('permit', 'Permit file', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::file('permit') !!}

    </div>
</div><div class="form-group">
    {!! Form::label('businesstype_id', 'Bussiness*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
            <select name="businesstype_id" class="form-control" id="">
        @foreach ($buss->where('user_id',Auth::user()->id) as $f)
            @if ($f->id==$permit->businesstype_id)
            <option selected value="{{$f->id}}">{{$f->business_name}}</option>
            @else
            <option value="{{$f->id}}">{{$f->business_name}}</option>
            @endif


        @endforeach
            </select>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.permit.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection
