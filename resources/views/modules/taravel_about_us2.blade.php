@extends('admin.layouts.taravel')

@section('content')
<br>
<div style="margin:1%; padding:1%;">
       
    <div class="row" style= "width: 100%; height: 600px; padding: 5%; ">
            <div class="row" style="width: 100%; height: 70px; background-color: #7E191B">			
                    <h1 style="color: white; line-height: 70px; float: left; margin-left: 15px;">About Taravel<h1> 
                    </div>
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
     
            <h2></h2>
    <br>
    <div class="row">
    <img src="{{url('/storage/taravel_black_logo.png')}}" style="width: 100%; height: 250px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)">
        <hr>
        <p style="margin-top:10px;">
        Our developers came up with the idea of showing off the beautiful scenery of Cavite to the tourist that wanted to visit. Taravel enables to help the travelers to find the perfect restaurant and hotel for them. Taravel can give free advertisement for new business owners that wanted to be known for their services or product by using our website.</p>       
      </div>
    </div>
    <div class="col-sm-2">
        </div>
 </div>
</div>


@endsection
@section('footer')
@endsection