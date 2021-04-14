@extends('admin.layouts.taravel2')
@section('head')
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/news.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/destinations.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/news_responsive.css')}}">
<link rel="stylesheet" href="{{url('css/jquery-ui.css')}}">
<link rel="stylesheet" href="{{url('css/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about_responsive.css')}}">
@endsection
@section('content')
<script src="{{url('theme/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{ url('js/toastr.min.js') }}"></script>
<div style="background:whitesmoke;">
<div class="home" style="height:350px;">
		<div class="background_image" style="background-image:url({{url('theme/images/travel.jpg')}})"></div>
        </div>
<div style="margin:70px;">
            <h1>Edit Profile</h1>
        <form action="{{url('edit/profile/submit')}}" method="post">
            {{ csrf_field() }}    
        <div style="padding:20px;">
            <div class="form-group">
                <div class="col-sm-7" style="margin-top:15px;">
                <label for="">Name</label>
                <input required name="name" value="{{$user[0]->name}}" placeholder="{{$user[0]->name}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                    <div class="col-sm-7" style="margin-top:15px;">
                    <label for="">Email Address</label>
                    <input readonly value="{{$user[0]->email}}" name="email" placeholder="{{$user[0]->email}}" class="form-control">
                    </div>
                </div>
            <div class="form-group">
                        <div class="col-sm-7" style="margin-top:15px;">
                        <label for="">New Password</label>
                        <input required minlength="8" type="password" name="pw" placeholder="Password" class="form-control">
                        </div>
                    </div>
            <div class="form-group">
                            <div class="col-sm-7" style="margin-top:15px;">
                            <label for="">Confirm Password</label>
                            <input required minlength="8" type="password" name="cpw" placeholder="Confirm Password" class="form-control">
                            </div>
                        </div>
            <div class="form-group">
                    <div class="col-sm-7" style="margin-top:15px;">
                        <button  class="btn btn-primary">Update</button>
                    </div>
                </div>
        </div>
        </form>
  </div>
</div>  
@endsection


