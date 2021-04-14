@extends('admin.layouts.taravel2')

@section('head')
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/news.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/destinations.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/news_responsive.css')}}">

<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/styles/about_responsive.css')}}">
@endsection

@section('content')
<script></script>
<div style="background:whitesmoke;"> 
<div class="home">
		<div class="background_image" style="background-image:url({{url('theme/images/travel.jpg')}})"></div>
        </div>

   
    <a style="color: blue; float:right; margin:10px;" 
    onclick="printDiv('printForm')"><u><b>Print</b></u></a>

    <div style="margin:50px;">
    @if((!empty($budget[0]))&&(!empty($total)))
            @if(($budget[0]->budget)<($total[0]->total))
                <div class="alert" style="background:tomato; text-align:center;">
                    <p style="color:white;">TOTAL AMOUNT EXCEEDED IN YOUR BUDGET</p>
                </div>
                @endif
        @endif
    </div>
<div id="printForm"  style="margin:50px;">
    <form action="{{url('travellers/set/budget')}}" method="post">
        {{ csrf_field() }}    
        <div class="row">
                    <div class="col-sm-2">
                        <h3>MY BUDGET</h3>
                    </div>
                    <div class="col-sm-3" style="padding:5px;">
                            <input type="number" name="budget" value="<?php
                                if(!empty($budget->budget)){
                                    echo $budget[0]->budget;
                                }
                                ?>" placeholder="<?php
                                if(!empty($budget[0]->budget)){
                                    echo "PHP ".$budget[0]->budget;
                                }
                                ?>" class="form-control">
                               
                        </div>
                        <div class="col-sm-2" style="padding:10px;">
                                <button id="enter" type="submit" name="action" class="btn btn-primary btn-sm">ENTER</button>
                        </div>
                    <div class="col-sm-1"><h3></h3></div>
                </div>
                <br>
    </form>  
<form action="{{url('travellers/custom/delete')}}" method="post">
    {{ csrf_field() }}
    <div class="container">
       
        @php
            $subtotal1=0;
            $subtotal2=0;
            $total=0;
        @endphp
        @if(!empty($accom))
        @php
            $counter1=0;
        @endphp
        {{-- <h4 style="float:right; margin-right:210px;">BUTTON</h4> --}}
        <br>
        <h2>Accomodation</h2>
        <input type="hidden" id="accom" name="accom" value="{{count($accom)}}">
        @foreach ($accom as $item)
        @if($item->type==1)
        @php
            $subtotal1+=$item->price;
        @endphp
        <div class="row" >
            <div class="col-sm-1"></div>
            <div class="col-sm-5">
                    
                   <p><b>{{$item->name}} </b></p>
                    <p>{{$item->address}}</p>
         
            </div>
            <div class="col-sm-3">
                    <p>{{"Quantity :".$item->quantity}}</p>
                    <p>{{"PHP ".$item->price}}</p>
            </div>
            <div class="col-sm-3" style="padding:15px;">
                <input type="hidden" name="item_id" value="{{$item->id}}">
                <button type="submit" name="action" id="{{'del1'.$counter1++}}"  class="btn btn-danger btn-sm">Remove</button>
            </div>
        </div>
        @endif
      <br>
        @endforeach
        <hr>
        <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-5"></div>
                <div class="col-sm-5">
                        <p><b>{{"Subtotal: PHP ".number_format($subtotal1,2)}}</b></p>
                </div>
                <div class="col-sm-1">
                </div>
        </div>
        @endif
        @if(!empty($pack))
        @php
            $counter2=0;
        @endphp
        <h2>Packages</h2>
        <input type="hidden" id="pack" name="pack" value="{{count($pack)}}">
        @foreach ($pack as $item)
        @if($item->type==2)
        @php
            $subtotal2+=$item->price;
        @endphp
        <div class="row" >
            <div class="col-sm-1"></div>
            <div class="col-sm-5">
                    
                   <p><b>{{$item->name}} </b></p>
                    <p>{{$item->address}}</p>
         
            </div>
            <div class="col-sm-3">
                    <p>{{"Quantity :".$item->quantity}}</p>
                    <p>{{"PHP ".$item->price}}</p>
            </div>
            <div class="col-sm-3">
                    <input type="hidden" name="item_id" value="{{$item->id}}">
                        <button type="submit" name="action" id="{{'del2'.$counter2++}}" class="btn btn-danger btn-sm">Remove</button>
            </div>
        </div>
        @endif
      <br>
        @endforeach
        <hr>
        <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-5"></div>
                <div class="col-sm-5">
                        <p><b>{{"Subtotal: PHP ".number_format($subtotal2,2)}}</b></p>
                </div>
                <div class="col-sm-1">
                </div>
        </div>
        @endif
        <hr>
        <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-5"></div>
                <div class="col-sm-5">
                        <p><b>{{"Total Custom Tour Package: PHP ".number_format($subtotal1+$subtotal2,2)}}</b></p>
                </div>
                <div class="col-sm-1">
                </div>
        </div>

    </div>
    </form>
</div>
</div>
<script>
        function printDiv(divName) {
             var printContents = document.getElementById(divName).innerHTML;
             var originalContents = document.body.innerHTML;
             
             document.body.innerHTML = printContents;
             var countpack= document.getElementById('pack').value;
             var countaccom= document.getElementById('accom').value;
             for (  index = 0; index < countaccom; index++) {
                document.getElementById('del1'+index).style.display='none';           
             }
             for (  index = 0; index < countpack; index++) {
                document.getElementById('del2'+index).style.display='none';           
             }
             document.getElementById('enter').style.display='none';  
             window.print();
        
             document.body.innerHTML = originalContents;  
        }
        </script>





    
@endsection
@section('footer')
<script src="{{url('theme/js/news.js')}}"></script>
@endsection