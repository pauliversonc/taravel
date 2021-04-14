@extends('admin.layouts.taravel2')
@section('head')
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about_responsive.css')}}">
@endsection
@section('content')

<div style=" height: auto; margin-top:120px;">
		<div class="row">
                <div class="col-sm-1"></div>
                        <div class="col-sm-10" style="width: 100%; height: 70px; background-color: #7E191B">
                                   <h1 style="color: white; line-height: 70px; float: left; margin-left: 15px;">Taravel</h1> <h2 style="color: white; margin-left: 15px; line-height: 70px; display: inline-block;">Frequently Asked Questions</h2>
                                    </div>
                <div class="col-sm-1"></div>
        </div>

		<div style="background-color: white; margin-left: 10%; width: 60%; height: auto; padding: 5%; ">

			<h4>Why the Email Verification is not sending to my email address?</h4>
			<hr>
			<p>
				If you are using <u>Yahoo mail</u>,<u> outlook</u> and <u>etc</u>. for registering in Taravel it might not send because for now we are requiring the user to use there <u>Google Mail</u> account for email registration and email verification.
			<p>
			<br><br>


			<h4>Why some of My Photos in album is not posting even it says "Success"?</h4>
			<hr>
			<p>
				Please check the photo that you are posting is not an icon and the size is not greater than 10mb. And also check the image file extension type the website allows only:
				<br>".jpg , .JPG, .JPEG, .jpeg , .PNG, .png only" do not use any .gif to put in the image gallery.
			</p>
			<br><br>

			<h4>How can i get the latitude and the longtitude of my business location?</h4>
			<hr>
			<p>
				You can get the Coordinates by visiting <u>maps.ie/coordinates.html</u> to use get the latitude and the longtitude you must drag the marker or input the address where your business is located.<br>
				You can also find it in <u>Google Maps</u> / <u>maps.google.com</u> if your business already have a marker in google maps you can easily see it in the URL that says latitude and longtitude.
			</p>
			<br><br>

			<h4>Can i change my rate to the Tourist Destination, Hotels & Resorts , Restaurants? </h4>
			<hr>
			<p>
				Yes, you can change your rate to the Tourist Destination, Hotels & Resorts , Restaurants just login the account that you use to comment in that particular Businesses or Tourist Destination.
			<br><br>

			<h4>Why the Exact map location of my business is not showing?</h4>
			<hr>
			<p>
				Please make sure you input the right coordinates and please include the decimal in the coordinates.<br>
				Maybe you put latitude to the longtitude or vice versa.
			<br><br>

			<h4>Can i add a lot of photos in my business profile?</h4>
			<hr>
			<p>
				Yes, you can add image as many as you want just meet the requirements of the photo that is needed to see the image in the business gallery.<br>
				You can add images in the gallery by logging in your business account then click upload image gallery select or drag and drop the image you want to upload and click save.
			<br><br>

		</div>
	</div>



@endsection

@section('footer')
@endsection
