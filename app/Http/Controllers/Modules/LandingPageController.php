<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class LandingPageController extends Controller
{
    public function PopularPlaces(){
        $poptour = DB::table('rate_tourist as rt')
        ->select([
            'rt.post_id',DB::raw("IFNULL(sum(rt.rate)/count(rt.post_id),0) as total")
        ])
        ->groupBy('rt.post_id')
        ->orderBy('total', 'desc')
        ->get();
        $popbusiness = DB::table('rate_business as rb')
        ->select([
            'rb.post_id',DB::raw("IFNULL(sum(rb.rate)/count(rb.post_id),0) as total")
        ])
        ->groupBy('rb.post_id')
        ->orderBy('total', 'desc')
        ->get();
        // dd($popbusiness);
        $count1=0;
        $tour=array();
        $tourRating=array();
        foreach ($poptour as $value) {
           $db_tour=DB:: table('tourist')
                ->where('id','=',$value->post_id)
                ->whereNull('deleted_at')
                ->get();
                $tour[]=$db_tour[0];
                $tourRating[]=number_format($value->total,1,".",'');
                $count1++;
                if($count1==5){
                    break;
                }

        }
        $hotelRating=array();
        $restoRating=array();
        $hotel=array();
        $resto=array();
        foreach ($popbusiness as $value) {
            $db_bus=DB:: table('business_profile')
            ->where('id','=',$value->post_id)
            // ->where('is_verified',1)
            ->get();
            if($db_bus[0]->business_type_id==1){
                $hotel[]=$db_bus[0];
                $hotelRating[]=number_format($value->total,1,".",'');
            }else{
                $resto[]=$db_bus[0];
                $restoRating[]=number_format($value->total,1,".",'');
            }

        }
        $agen1 = DB::table('agencu')->select('*')
        ->inRandomOrder()
        ->limit(2)
        ->where('deleted_at','=',null)
        ->where('package_type',1)
        ->get();
        $agen2 = DB::table('agencu')->select('*')
        ->inRandomOrder()
        ->limit(2)
        ->where('deleted_at','=',null)
          ->where('package_type',2)
        ->get();

        $rest = DB::table('business_profile')
        ->where('business_type_id',2)->get();

        $hr = DB::table('business_profile')
        ->where('business_type_id',1)->get();
        if(Auth::user()!=null){
            $userInfo=DB::table('users')
            ->where('id',Auth::user()->id)
            ->get();
        }
        else{
            $userInfo=null;
        }
        // dd(Session()->all());
        return view('welcome')
        ->withHr($hr)
        ->withRest($rest)
        ->withPoptour($poptour)
        ->withPopbusiness($popbusiness)
        ->withTour($tour)
        ->withAgen1($agen1)
        ->withAgen2($agen2)
        ->withHotel($hotel)
        ->withResto($resto)
        ->withTourRating($tourRating)
        ->withHotelRating($hotelRating)
        ->withRestoRating($restoRating);
    }
   
}
