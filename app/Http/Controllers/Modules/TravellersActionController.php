<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Session;
use Carbon;
class TravellersActionController extends Controller
{
    public function getBusinessComment(){
        DB::table('comment_business')
        ->insert([
            'post_id' =>request()->post_id,
            'comment' => request()->comment,
            'user_id' => Auth::user()->id,
            'date' => now(),
        ]);
        return back();
    }
    public function getPartnerAgencyRate(Request $request){
        // dd($request);/
        $rates = DB::table('rate_partner_agent')
        ->where('user_id',Auth::user()->id)
        ->where('partneragent_id',request()->partner_id)
        ->first();
        if(empty($rates)){

         DB::table('rate_partner_agent')
        ->insert([
            'partneragent_id' =>request()->partner_id,
            'rate' => request()->rate,
            'user_id' => Auth::user()->id,
            'date' => now(),
        ]);
        }
        else{
            DB::table('rate_partner_agent')
            ->where('user_id',Auth::user()->id)
            ->where('partneragent_id',request()->partner_id)
            ->update([
            'rate' => request()->rate,
            'date' => now(),
        ]);
        }

        return back();
    }

    public function getTouristComment(){
        DB::table('comment_tourist')
        ->insert([
            'post_id' =>request()->post_id,
            'comment' => request()->comment,
            'user_id' => Auth::user()->id,
            'date' => now()
        ]);
        return back();
    }

    public function getBusinessRate(){

        $rates = DB::table('rate_business')
        ->where('user_id',Auth::user()->id)
        ->where('post_id',request()->post_id)
        ->first();
        // dd($rates);
        if(empty($rates)){

         DB::table('rate_business')
        ->insert([
            'post_id' =>request()->post_id,
            'rate' => request()->rate,
            'user_id' => Auth::user()->id,
            'date' => now()
        ]);
        }
        else{
            DB::table('rate_business')
            ->where('user_id',Auth::user()->id)
             ->where('post_id',request()->post_id)
        ->update([
            'rate' => request()->rate,
            'date' => now()
        ]);
        }
        return back();
    }

    public function getTouristRate(){
        $rates = DB::table('rate_tourist')
        ->where('user_id',Auth::user()->id)
        ->where('post_id',request()->post_id)
        ->first();
        // dd(request()->rate);
        if(empty($rates)){

         DB::table('rate_tourist')
        ->insert([
            'post_id' =>request()->post_id,
            'rate' => request()->rate,
            'user_id' => Auth::user()->id,
            'date' => now()
        ]);
        }
        else{
            DB::table('rate_tourist')
            ->where('user_id',Auth::user()->id)
             ->where('post_id',request()->post_id)
            ->update([
            'rate' => request()->rate,
            'date' => now()
        ]);
        }

        return back();
    }
    public function getAgencyRate(Request $request){
        // dd($request->post_id);
        $rates = DB::table('rate_agency')
        ->where('user_id',Auth::user()->id)
        ->where('post_id',request()->post_id)
        ->first();
        if(empty($rates)){

         DB::table('rate_agency')
        ->insert([
            'post_id' =>request()->post_id,
            'rate' => request()->rate,
            'user_id' => Auth::user()->id,
            'date' => now()
        ]);
        }
        else{
            DB::table('rate_agency')
            ->where('user_id',Auth::user()->id)
             ->where('post_id',request()->post_id)
            ->update([
            'rate' => request()->rate,
            'date' => now()
        ]);
        }

        return back();
    }
    public function search(Request $r){

        $rest = DB::table('business_profile')
        ->select('*')
        ->where('business_type_id',2);

        $hotel = DB::table('business_profile')
        ->select('*')
        ->where('business_type_id',1);
        $tour=null;

        $agency= DB::table('agencu') ->select('*')  ->whereNull('deleted_at');

        if (!is_null($r->min) && !is_null($r->max) && !is_null($r->search)) {
            # code...
            $rest->where('business_name','LIKE','%'.$r->search.'%')
            ->where('business_price','>=',$r->min)
            ->where('business_price','<=',$r->max);
            $hotel->where('business_name','LIKE','%'.$r->search.'%')
            ->where('business_price','>=',$r->min)
            ->where('business_price','<=',$r->max);
            $agency ->where('name','LIKE','%'.$r->search.'%')
            ->where('price','>=',$r->min)
            ->where('price','<=',$r->max);
        }
        else if (!is_null($r->min) && !is_null($r->max)) {
            # code...
            $rest
            ->where('business_price','>=',$r->min)
            ->where('business_price','<=',$r->max);
            $hotel
            ->where('business_price','>=',$r->min)
            ->where('business_price','<=',$r->max);
            $agency
            ->where('price','>=',$r->min)
            ->where('price','<=',$r->max);
        }
        else if ( !is_null($r->max) && !is_null($r->search)) {
            # code...
            $rest->where('business_name','LIKE','%'.$r->search.'%')
            ->where('business_price','<=',$r->max);
            $hotel->where('business_name','LIKE','%'.$r->search.'%')
            ->where('business_price','<=',$r->max);
            $agency ->where('name','LIKE','%'.$r->search.'%')
            ->where('price','<=',$r->max);
        }
        else if (!is_null($r->min) && !is_null($r->search)) {
            # code...
            $rest->where('business_name','LIKE','%'.$r->search.'%')
            ->where('business_price','>=',$r->min);
            $hotel->where('business_name','LIKE','%'.$r->search.'%')
            ->where('business_price','>=',$r->min);
            $agency ->where('name','LIKE','%'.$r->search.'%')
            ->where('price','>=',$r->min);
        }
        else if (!is_null($r->min) ) {
            # code...
            $rest
            ->where('business_price','>=',$r->min);
           $hotel
            ->where('business_price','>=',$r->min);
            $agency
            ->where('price','>=',$r->min);
        }
        else if (!is_null($r->max) ) {
            # code...
            $rest
            ->where('business_price','>=',$r->max);
           $hotel
            ->where('business_price','>=',$r->max);
            $agency
            ->where('price','>=',$r->max);
        }
        else{
            $rest->where('business_name','LIKE','%'.$r->search.'%');
            $hotel->where('business_name','LIKE','%'.$r->search.'%');
            $agency->where('name','LIKE','%'.$r->search.'%');
            $tour = DB::table('tourist')
            ->where('name','LIKE','%'.$r->search.'%')
            ->whereNull('deleted_at')
            ->select('*')
            ->get();
        }

        // $tour = DB::table('tourist')
        // ->where('name','LIKE','%'.$r->search.'%')
        // ->whereNull('deleted_at')
        // ->select('*')
        // ->get();



        return view('modules.taravel_search')
        ->withAgency($agency->get())
        ->withRestaurant($rest->get())
        ->withHotel($hotel->get())
        ->withTour($tour);
        // dd(array($tourist,$business));
    }
    public function searchTag(Request $r){

        $rest=DB::table('business_tags_lib as bt')
        ->where('bt.category_tags_id', '=', $r->tag)
        ->where('bt.business_id','=', 2)
        ->leftJoin('business_profile as bp', 'bt.business_profile_id','bp.id')
        ->get();
        $hotel=DB::table('business_tags_lib as bt')
        ->where('bt.category_tags_id', '=', $r->tag)
        ->where('bt.business_id','=', 1)
        ->leftJoin('business_profile as bp', 'bt.business_profile_id','bp.id')
        ->get();
        $tour=DB::table('tourist as t')
        ->where('t.categorytags_id', '=', $r->tag)
        ->get();
        $ratetour=array();
        foreach($tour as $item){
            $rt= DB::table('rate_tourist as rt')
            ->select([
                DB::raw("IFNULL(sum(rt.rate)/count(rt.post_id),0) as total")
                ])
            ->where('post_id','=',$item->id)
            ->get();
            if(count($rt)>0){
                $ratetour[]=$rt[0]->total;
            }
            else{
                $ratetour[]=0;
            }
        }
        $ratehot=array();
        foreach($hotel as $item){
            $rb= DB::table('rate_business as rb')
            ->select([
                DB::raw("IFNULL(sum(rb.rate)/count(rb.post_id),0) as total")
                ])
            ->where('post_id','=',$item->id)
            ->get();
            if(count($rb)>0){
                $ratehot[]=$rb[0]->total;
            }
            else{
                $ratehot[]=0;
            }
        }
        $rateresto=array();
        foreach($rest as $item){
            $rb= DB::table('rate_business as rb')
            ->select([
                DB::raw("IFNULL(sum(rb.rate)/count(rb.post_id),0) as total")
                ])
            ->where('post_id','=',$item->id)
            ->get();
            if(count($rb)>0){
                $rateresto[]=$rb[0]->total;
            }
            else{
                $rateresto[]=0;
            }
        }
        // dd($ratehot);
       return view('modules.taravel_search')
       ->withRestaurant($rest)
       ->withHotel($hotel)
       ->withTour($tour)
       ->withRatetour($ratetour)
       ->withRatehot($ratehot)
       ->withRateresto($rateresto);
    }
    public  function homeSearch(Request $r){

        $checkin=date_create($r->checkin);
        $checkout=date_create($r->checkout);
        $days = date_diff($checkin,$checkout);
        // dd($r->search);


        $a1 = DB::table('agencu')->select('*')
        ->inRandomOrder()
        ->limit(2)
        ->where('deleted_at','=',null)
        ->where('package_type',1)
        ->get();
        $a2 = DB::table('agencu')->select('*')
        ->inRandomOrder()
        ->limit(2)
        ->where('deleted_at','=',null)
          ->where('package_type',2)
        ->get();

        $b2 = DB::table('business_profile')
        ->where('business_type_id',2)->get();

        $b1 = DB::table('business_profile')
        ->where('business_type_id',1)->get();

        $agen2 = DB::table('agencu')
        ->where('name','LIKE','%'.$r->search.'%')
        ->orWhere('price','LIKE','%'.$r->search.'%')
        ->orWhere('location','LIKE','%'.$r->search.'%')
        ->orWhere('price','LIKE','%'.$r->search.'%')
        ->where('package_type',2);

        $loc = DB::table('location')
        ->where('name','LIKE','%'.$r->search.'%')
        ->get();
        $agen1 = DB::table('agencu')
        ->where('name','LIKE','%'.$r->search.'%')
           ->orWhere('price','LIKE','%'.$r->search.'%')
        ->orWhere('location','LIKE','%'.$r->search.'%')
        ->orWhere('price','LIKE','%'.$r->search.'%')
        ->where('package_type',1);

        $tour=DB::table('tourist')
        ->where('name','LIKE','%'.request()->search.'%')
        ->orWhere('address','LIKE','%'.request()->search.'%')
        ->get();

        $hr = DB::table('business_profile')
        // ->where('business_type_id',1)
        ->where('business_name','LIKE','%'.$r->search.'%')
        ->orWhere('business_address','LIKE','%'.request()->search.'%')
        ->orWhere('attraction_details','LIKE','%'.request()->search.'%')
        ->orWhere('business_city','LIKE','%'.request()->search.'%')
        ->orWhere('business_brgy','LIKE','%'.request()->search.'%')
        ->orWhere('business_landmarks','LIKE','%'.request()->search.'%')->get();

        $rest = DB::table('business_profile')
        ->where('business_name','LIKE','%'.$r->search.'%')
        ->orWhere('business_address','LIKE','%'.request()->search.'%')
        ->orWhere('attraction_details','LIKE','%'.request()->search.'%')
        ->orWhere('business_city','LIKE','%'.request()->search.'%')
        ->orWhere('business_brgy','LIKE','%'.request()->search.'%')
        ->orWhere('business_landmarks','LIKE','%'.request()->search.'%')
        ->where('business_type_id',2)
        ->get();
// dd($rest);
        if($r->budget){
            $agen2->where('price',$r->budget);
            $agen1->where('price',$r->budget);
            $hr->where('business_price',$r->budget);
        }

        if($r->checkin && $r->checkout){
            $agen2->where('days',$days->d);
            $agen1->where('days',$days->d);
        }

        $agen1 = $agen1->get();
        $agen2 = $agen2->get();
        // $hr = $hr->get();
// dd($agen1);
        $agen1rate=array();
        $agen2rate=array();
            foreach($agen1 as $a){

                $rb= DB::table('rate_agency as rb')
                ->select([
                    DB::raw("IFNULL(sum(rb.rate)/count(rb.post_id),0) as total")
                    ])
                ->where('post_id','=',$a->id)
                ->get();
                if(count($rb)>0){
                    $agen1rate[]=$rb[0]->total;
                }
                else{
                    $agen1rate[]=0;
                }
            }
            foreach($agen2 as $a){

                $rb= DB::table('rate_agency as rb')
                ->select([
                    DB::raw("IFNULL(sum(rb.rate)/count(rb.post_id),0) as total")
                    ])
                ->where('post_id','=',$a->id)
                ->get();
                if(count($rb)>0){
                    $agen2rate[]=$rb[0]->total;
                }
                else{
                    $agen2rate[]=0;
                }
            }

        $data1views = array();
        $data1rate=array();
        foreach($hr as $a){
            $view = DB::table('views')
            ->where('place_id',$a->id)
            ->where('lib_place_type_id',1)
            ->get()->count();
            array_push($data1views,$view);

            $rb= DB::table('rate_business as rb')
            ->select([
                DB::raw("IFNULL(sum(rb.rate)/count(rb.post_id),0) as total")
                ])
            ->where('post_id','=',$a->id)
            ->get();
            if(count($rb)>0){
                $data1rate[]=$rb[0]->total;
            }
            else{
                $data1rate[]=0;
            }
        }



        $data2views = array();
        foreach($rest as $a){
            $view = DB::table('views')
            ->where('place_id',$a->id)
            ->where('lib_place_type_id',1)
            ->get()->count();
            array_push($data2views,$view);
        }

        $data3views = array();
        $data3rate= array();
        foreach($tour as $a){
            $view = DB::table('views')
            ->where('place_id',$a->id)
            // ->where('lib_place_type_id',1)
            ->get()->count();
            array_push($data3views,$view);
            $rt= DB::table('rate_tourist as rt')
            ->select([
                DB::raw("IFNULL(sum(rt.rate)/count(rt.post_id),0) as total")
                ])
            ->where('post_id','=',$a->id)
            ->get();
            if(count($rt)>0){
                $data3rate[]=$rt[0]->total;
            }
            else{
                $data3rate[]=0;
            }
        }

        // dd($tour);
        return view('modules.taravel_home_search')
        ->withA1($a1)
        ->withA2($a2)
        ->withB1($b1)
        ->withB2($b2)
        ->withData1views($data1views)
        ->withData2views($data2views)
        ->withData3views($data3views)
        ->withData1($hr)
        ->withData2($rest)
        ->withAgen1($agen1)
        ->withAgen2($agen2)
        ->withloc($loc)
        ->withAgen1rate($agen1rate)
        ->withAgen2rate($agen2rate)
        ->withData3($tour)
        ->withData1rate($data1rate)
        ->withData3rate($data3rate);
    }
    public function AddToCustomPackage(Request $request){
       $qty=$request->qty;
        if($qty==null){
           $qty=1;
       }
    //    dd( $request->price*$qty, $qty,$request->price);
        DB::table('add_custom_package')
        ->insert([
             "name"=>$request->name,
             "address" => $request->address,
             "price" => $request->price*$qty,
             "quantity" => $qty,
             "type" => $request->type,
             "user_id" => Auth::user()->id
        ]);
        Session::flash('success','Successfully Added!');
        return redirect()-> back();
     }
     public function customPackageDel(Request $request){
             DB:: table('add_custom_package')
             ->where('id', '=', $request->item_id)->delete();
             return back();
     }
     public function BudgetCustomPackage(Request $request){
       $check=DB::table('user_budget')
                ->where('user_id',Auth::user()->id)
                ->get();
        if(count($check)==0){
            DB::table('user_budget')
        ->insert([
             "user_id" => Auth::user()->id,
             "budget"  => $request->budget,
        ]);
        }
        else if(count($check)>0){
            DB::table('user_budget')
            ->where('user_id',Auth::user()->id)
            ->update([
                 "budget"  => $request->budget,
            ]);
        }
        return back();
    }
    public function editProfilesubmit(Request $request){
        if($request->pw!=$request->cpw){
            return back()->with('error','Password and Confirm Password do not match.');
        }
        else{
            DB::table('users')
            ->where('id',Auth::user()->id)
            ->update([
                'name'=>$request->name,
                'password'=>bcrypt($request->pw),
            ]);
            return back()->with('success','Successfully updated!');
        }
    }
}
