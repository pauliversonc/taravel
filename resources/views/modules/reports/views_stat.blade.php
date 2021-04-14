@extends('admin.layouts.master')
@section('content')


<style>
    /* Style the buttons that are used to open and close the accordion panel */
        .accordion {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        text-align: left;
        border: none;
        outline: none;
        transition: 0.4s;
        }

        /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
        .active, .accordion:hover {
        background-color: #ccc;
        }

        /* Style the accordion panel. Note: hidden by default */
        .panel {
        padding: 0 18px;
        background-color: white;
        display: none;
        width: 100%;
        height:100%;
        }
        @media print{
            .header{
                display: inline!important;
            }
        }
    </style>
<div class="header" style="display:none">
    <img src="{{asset('storage/taravel_header.png')}}" style="top:0; left:0;width:7.5in;height:.5in;"  />
</div>
<?php

$dataPoints  = array();
?>
@if(count($sched)==0)
{{'NO DATA'}}
@endif
@foreach($sched as $k => $item)
    @php
           $views =DB::table('views as v')
        //    ->select(DB::raw("DATE_FORMAT(date, '%m-%Y') new_date"),  DB::raw('YEAR(date) year, MONTH(date) month'))
        ->select([
            DB::raw("IFNULL(count(v.place_id),0) as total")
            ,"bp.*"])
            ->leftJoin('business_profile as bp', 'bp.id','v.place_id')
            ->groupBy('v.place_id')
           ->where('bp.user_id','=',Auth::user()->id)
           ->whereYear('date', '=', $item->year)
           ->whereMonth('date', '=', $item->month)
           ->get();
        @endphp

      @foreach ($views as $i)
      <?php

      $data []=
          array("label"=> $i->business_name, "y"=> $i->total);

      ?>
      @endforeach
      <?php
       array_push($dataPoints,$data);
       $data = [];
       $count=count($dataPoints);
       $a=0;
    //    dd($dataPoints,$k);
      ?>
        <button class="accordion" style="text-align:center;"><h4><b>{{$item->new_date}}</b></h4></button>
        <div class="panel">
                <button class="btn btn-primary" id="{{'exportChart'.$k}}" style="margin:15px;">Save Chart</button>
             <br>   <div  id="{{'chartContainer'.$k}}" ></div>
        </div>
<script src="{{ url('js/canvasjs.min.js') }}"></script>
 {{-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> --}}

@endforeach


<script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            /* Toggle between adding and removing the "active" class,
            to highlight the button that controls the panel */
            this.classList.toggle("active");

            /* Toggle between hiding and showing the active panel */
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
            panel.style.display = "none";
            } else {
            panel.style.display = "block";
            }
        });
        }
</script>

@endsection
@php
echo "<script>

      window.onload = function () {
          ";
 for ($i=0; $i <count($dataPoints) ; $i++) {
    echo "

     var index;

         chart = new CanvasJS.Chart('chartContainer'.concat(".$i."), {
            animationEnabled: true,
            theme: 'light2',
            title: {
                text: 'Business Views Statistics'
            },
            axisY: {
                suffix: '%',
                scaleBreaks: {
                    autoCalculate: true
                }
            },
            data: [{
                type: 'column',
                yValueFormatString: '#,##0\"%\"',
                indexLabel: '{y}',
                indexLabelPlacement: 'inside',
                indexLabelFontColor: 'white',
                dataPoints:". json_encode($dataPoints[$i],JSON_NUMERIC_CHECK)."
            }]
        });


        chart.render();

        document.getElementById('exportChart'.concat(".$i.")).addEventListener('click',function(){
    	chart.exportChart({format: 'jpg'});
          });

";
 }
 echo "} </script>";
@endphp




