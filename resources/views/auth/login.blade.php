@extends('admin.layouts.taravel2')
@section('head')
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/destinations.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/destinations_responsive.css')}}">
@endsection
@section('content')

<style>
    .home{
        height:800px;
    }
    .home_search_container{
        top:-600px;
    }
    .background_image{
        height: 100%;
    }
</style>

<div class="home">
     
		<div class="background_image" style="background-image:url({{url('storage/hdpics/sinulog1.jpg')}}); filter:blur(4px);"></div>
</div>
{{-- <img style="width:50%; height: 1130px; float: left;" src="{{url('/storage/loginleft.jpg')}}"> --}}
<div class="home_search">
		<div class="container" >
			<div class="row" >
                <div class="col-sm-3"></div>
				<div class="col-sm-6" >
					<div class="home_search_container">
                            <div class="panel panel-default" >
                                    <div class="panel-heading">
                                        <legend style="text-shadow: 4px 3px 3px #4d4d4d; color:white;">Log in Now!</legend>
                                    </div>
                                    <br>
                                    <div class="panel-body">
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <strong>{{ trans('quickadmin::auth.whoops') }}</strong> {{ trans('quickadmin::auth.some_problems_with_input') }}
                                                <br><br>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form class="form-horizontal"
                                              role="form"
                                              method="POST"
                                              action="{{ url('login') }}">
                                            <input type="hidden"
                                                   name="_token"
                                                   value="{{ csrf_token() }}">

                                            <div class="form-group">
                                                <label class="col-md-4 control-label" style="text-shadow: 4px 3px 3px #4d4d4d; color:white;">Email Address</label>

                                                <div>
                                                    <input type="email"
                                                           class="form-control"
                                                           name="email"
                                                           placeholder="Enter Email Address"
                                                           value="{{ old('email') }}" onblur="duplicateEmail(this)">
                                                </div>

                                            </div>

                                            <div class="form-group">

                                                <label class="col-md-4 control-label" style="text-shadow: 4px 3px 3px #4d4d4d; color:white;">{{ trans('quickadmin::auth.login-password') }}</label>
                                                <div>

                                                    <input type="password"
                                                           class="form-control"
                                                           placeholder="Enter Password"
                                                           name="password">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <label style="text-shadow: 4px 3px 3px #4d4d4d; color:white;">
                                                        <input type="checkbox"
                                                               name="remember">{{ trans('quickadmin::auth.login-remember_me') }}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div style="text-align:center; ">

                                                    <button type="submit" style="text-shadow: 4px 3px 3px #4d4d4d; color:white;"
                                                            class="btn btn-primary form-control">
                                                        {{ trans('quickadmin::auth.login-btnlogin') }}
                                                    </button>
                                                </div>
                                            </div>
                                            <div style="text-align:center;" >
                                            <label style="text-shadow: 4px 3px 3px #4d4d4d; color:white;">Don't have any account? <a style="text-shadow: 4px 3px 3px #4d4d4d; color:white;" href="{{url('register/user')}}">Click here to Sign up</a></label>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
            
        </div>
        
</div>


{{-- <div class="container-fluid" style="margin-top:150px;">
    <div class="row">
        <div class="col-md-12 col-md-offset-2">

        </div>
    </div>
</div> --}}
<script type="text/javascript">

    function duplicateEmail(element){

            var email = $(element).val();
            $.ajax({
                headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                type: "POST",
                url: '{{url('checkverify')}}',
                data: {email:email},
                dataType: "json",
                success: function(res) {
                    if(res.exists){

                        alert('Please verify your account');
                    }else{
                        // alert('Email Available, Please provide a valid email for verification');
                    }
                },
                error: function (jqXHR, exception) {

                }
            });
        }

        </script>
      
@include('admin.partials.footer')
@include('admin.partials.javascripts')
@endsection

