<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use DB;
use Session;
use Mail;
use Auth;
use File;
use App\Region;
class homeContentController extends Controller
{
    //

    public function hotel(){


            $search = DB::table('business_profile')
            ->select('*')
            ->where('business_type_id',1)
            ->get();
        $partial = 1;
        $suggest = DB::table('tourist')
        ->select('*')
        ->inRandomOrder()
        ->limit(3)
        ->get();
        if(!is_null(request()->filter) && !is_null(request()->filter_region)){
            $data = DB::table('business_profile as bp')
            ->select([
                'rb.post_id as rb_post',DB::raw("IFNULL(sum(rb.rate)/count(rb.post_id),0) as total")
                ,"bp.*"])
            ->where('bp.business_type_id',1)
            ->leftJoin('business_tags_lib as btl','btl.business_profile_id','=','bp.id')
            ->whereIn('btl.category_tags_id',request()->filter)
            ->leftJoin('region_libs as rl','rl.business_profile_id','=','bp.id')
            ->whereIn('rl.region_id',request()->filter_region)
            ->leftJoin('rate_business as rb','rb.post_id','bp.id')
            ->groupBy('rb.post_id')
            ->where('bp.is_verified',1)
            ->groupBy('bp.id');
        }
        else if(!is_null(request()->filter)){
            $data = DB::table('business_profile as bp')
            ->select([
                'rb.post_id as rb_post',DB::raw("IFNULL(sum(rb.rate)/count(rb.post_id),0) as total")
                ,"bp.*"])
            ->where('bp.business_type_id',1)
            ->leftJoin('business_tags_lib as btl','btl.business_profile_id','=','bp.id')
            ->whereIn('btl.category_tags_id',request()->filter)
            ->leftJoin('rate_business as rb','rb.post_id','bp.id')
            ->groupBy('rb.post_id')
            ->groupBy('bp.id')
            ->where('bp.is_verified',1);

            }
        else if(!is_null(request()->filter_region)){
            $data = DB::table('business_profile as bp')
            ->select([
                'rb.post_id as rb_post',DB::raw("IFNULL(sum(rb.rate)/count(rb.post_id),0) as total")
                ,"bp.*"])
            ->where('bp.business_type_id',1)
            ->leftJoin('region_libs as rl','rl.business_profile_id','=','bp.id')
            ->whereIn('rl.region_id',request()->filter_region)
            ->leftJoin('rate_business as rb','rb.post_id','bp.id')
            ->groupBy('rb.post_id')
            ->groupBy('bp.id')
            ->where('bp.is_verified',1);
            }
        else{
            $data = DB::table('business_profile as bp')
            ->select([
                'rb.post_id as rb_post',DB::raw("IFNULL(sum(rb.rate)/count(rb.post_id),0) as total")
                ,"bp.*"])
            ->where('bp.business_type_id',1)
            ->where('bp.is_verified',1)
            ->leftJoin('rate_business as rb','rb.post_id','bp.id')
            ->groupBy('rb.post_id');
            // ->leftJoin('business_tags_lib as btl','btl.user_id','=','bp.user_id')
            // ->paginate(4);
        }
        if(!is_null(request()->search)){
            // dd(1);
            $data->where('bp.business_name','LIKE','%'.request()->search.'%')
            ->orWhere('bp.business_address','LIKE','%'.request()->search.'%')
            ->orWhere('bp.attraction_details','LIKE','%'.request()->search.'%')
            ->orWhere('bp.business_city','LIKE','%'.request()->search.'%')
            ->orWhere('bp.business_brgy','LIKE','%'.request()->search.'%')
            ->orWhere('bp.business_landmarks','LIKE','%'.request()->search.'%');

        }if(!is_null(request()->min)){
            $data->where('business_price','>=',request()->min);
        }
        if(!is_null(request()->max)){
            $data->where('business_price','<=',request()->max);
        }
        $tags = $data;
        $tags_array = array();
        $tags_id_array = array();
        $tag_lib = DB::table('business_tags_lib as btl')
        ->select('btl.*','cat.name as cat_name')
        ->leftJoin('categorytags as cat','cat.id','btl.category_tags_id')
        ->get();


        foreach($tags->get() as $k){

            $tags_id = array();
            $cat_tagId = array();
            foreach($tag_lib as $i){
                if($i->business_profile_id == $k->id){
                    // dd($i->cat_name);
                    array_push($tags_id,$i->cat_name);
                    array_push($cat_tagId,$i->category_tags_id);
                }
            }
            array_push($tags_array,$tags_id);
            array_push($tags_id_array,$cat_tagId);
        }
        //   dd($tags_id_array);
        $data = $data->paginate(4);




        $rateholder = array();
        $count=0;
        foreach ($data as $item) {
            $rates = DB::table('rate_business')
            ->where('post_id',$item->id)
            ->get();
            $rateholder[$count]=$rates;
            $count++;
        }

        $views = array();
        foreach($data as $a){
            $view = DB::table('views')
            ->where('place_id',$a->id)
            ->where('lib_place_type_id',1)
            ->get()->count();
            array_push($views,$view);
        }
        // dd($views);

        $agen = DB::table('agencu')->select('*')->get();
        $tags = DB::table('categorytags')
        ->select("*")
        ->where('category_id','!=',5)
        ->get();

        $category = DB::table('category')
        ->select("*")
        ->where('id','<',5)
        ->get();
        $reg = Region::all();

        $top = DB::table('business_profile as bp')
        ->select([
            'rb.post_id',DB::raw("IFNULL(sum(rb.rate)/count(rb.post_id),0) as total")
            ,"bp.*"])
        ->where('bp.business_type_id',1)
        ->leftJoin('rate_business as rb','rb.post_id','bp.id')
        ->groupBy('rb.post_id')
        ->orderBy('total', 'desc')
        ->where('bp.is_verified',1)
        // ->leftJoin('business_tags_lib as btl','btl.user_id','=','bp.user_id')
        ->limit(2)
        ->get();


        // dd($tags_top);
        $view = DB::table('business_profile as bp')
        ->select([
            DB::raw("IFNULL(count(vw.place_id),0) as total")
            ,"bp.*"])
        ->where('bp.business_type_id',1)
        ->leftJoin('views as vw','vw.place_id','bp.id')
        // ->where('vw.lib_place_type_id','bp.business_type_id')
        ->where('vw.lib_place_type_id',1)
        ->groupBy('vw.place_id')
        ->orderBy('total', 'desc')
        ->where('bp.is_verified',1)
        // ->leftJoin('business_tags_lib as btl','btl.user_id','=','bp.user_id')
        ->limit(2)
        ->get();
        $tags_top = array();
        $tags_id_top = array();



        foreach($top as $k){

            $tags_id = array();
            $cat_tagId = array();
            foreach($tag_lib as $i){
                if($i->business_profile_id == $k->id){
                    // dd($i->cat_name);
                    array_push($tags_id,$i->cat_name);
                    array_push($cat_tagId,$i->category_tags_id);
                }
            }
            array_push($tags_top,$tags_id);
            array_push($tags_id_top,$cat_tagId);
        }
        $tags_view = array();
        $tags_id_view = array();



        foreach($view as $k){

            $tags_id = array();
            $cat_tagId = array();
            foreach($tag_lib as $i){
                if($i->business_profile_id == $k->id){
                    // dd($i->cat_name);
                    array_push($tags_id,$i->cat_name);
                    array_push($cat_tagId,$i->category_tags_id);
                }
            }
            array_push($tags_view,$tags_id);
            array_push($tags_id_view,$cat_tagId);
        }

        return view ('modules.HotelsandResort')
        ->withViews($views)
        ->withData($data)
        ->withTags($tags)
        ->withRegion($reg)
        ->withView($view)
        ->withTop($top)
        ->withAgen($agen)
        ->withSuggest($suggest)
        ->withPartial($partial)
        ->with('tags_array',$tags_array)
        ->with('tags_id',$tags_id_array)
        ->with('tags_top',$tags_top)
        ->with('tags_id_top',$tags_id_top)
        ->with('tags_view',$tags_view)
        ->with('tags_id_view',$tags_id_view)
        ->withinput(request()->search)
        ->withSearch($search)
        ->withCategory($category)
        ->withRateholder($rateholder);
        ;
    }
    public function hotelSort($id){
        // dd($id);
        // dd(request()->all());
// dd(request()->filter);

        // if(is_null(request()->filter) && is_null(request()->filter_region)){
        // $data = DB::table('business_profile as bp')
        // ->select("bp.*")
        // ->where('bp.business_type_id',1)
        // // ->leftJoin('business_tags_lib as btl','btl.user_id','=','bp.user_id')
        // ->get();
        // }
        $partial = 1;
        $var = '';
        if($id == 1){
            $var = 'asc';
        }elseif($id == 2){
            $var = 'desc';
        }else{
            $var = 'view';
        }
        $search = DB::table('business_profile')
        ->select('*')
        ->where('business_type_id',1)
        ->get();
        if(!is_null(request()->filter) && !is_null(request()->filter_region)){
            $data = DB::table('business_profile as bp')
            ->select("bp.*",DB::raw('count(v.place_id) as views'))
            ->where('bp.business_type_id',1)
            ->leftJoin('business_tags_lib as btl','btl.business_profile_id','=','bp.id')
            ->whereIn('btl.category_tags_id',request()->filter)
            ->leftJoin('region_libs as rl','rl.business_profile_id','=','bp.id')
            ->leftJoin('views as v',function($join){
                $join->on('v.place_id','bp.id')
                ->where('v.lib_place_type_id',1);
             })
            ->whereIn('rl.region_id',request()->filter_region)
            ->where('bp.is_verified',1)
            ->groupBy('bp.id')
            ->orderBy('bp.business_price',$var)
            ->groupBy('v.place_id');
            if($var=='view'){
                $data = $data->orderBy('views','desc')->paginate(4);
             }
             else{
                $data = $data->orderBy('bp.business_price',$var)->paginate(4);
            }

        }
        else if(!is_null(request()->filter)){
            $data = DB::table('business_profile as bp')
            ->select("bp.*",DB::raw('count(v.place_id) as views'))
            ->where('bp.business_type_id',1)
            ->leftJoin('business_tags_lib as btl','btl.business_profile_id','=','bp.id')
            ->leftJoin('views as v',function($join){
                $join->on('v.place_id','bp.id')
                ->where('v.lib_place_type_id',1);
             })
            ->whereIn('btl.category_tags_id',request()->filter)
            ->where('bp.is_verified',1)
            ->groupBy('bp.id')
            ->orderBy('bp.business_price',$var)
            ->groupBy('v.place_id');
            if($var=='view'){
                $data = $data->orderBy('views','desc')->paginate(4);
             }
             else{
                $data = $data->orderBy('bp.business_price',$var)->paginate(4);
             }

            }
        else if(!is_null(request()->filter_region)){
            $data = DB::table('business_profile as bp')
            ->select("bp.*",DB::raw('count(v.place_id) as views'))
            ->where('bp.business_type_id',1)
            ->leftJoin('region_libs as rl','rl.business_profile_id','=','bp.id')
            ->leftJoin('views as v',function($join){
                $join->on('v.place_id','bp.id')
                ->where('v.lib_place_type_id',1);
             })
            ->whereIn('rl.region_id',request()->filter_region)
            ->where('bp.is_verified',1)
            ->groupBy('bp.id')
            ->orderBy('bp.business_price',$var)
            ->groupBy('v.place_id');
                if($var=='view'){
                    $data = $data->orderBy('views','desc')->paginate(4);
                }
                else{
                    $data = $data->orderBy('bp.business_price',$var)->paginate(4);
                }
            }
        else{
            $data = DB::table('business_profile as bp')
            ->select("bp.*",DB::raw('count(v.place_id) as views'),DB::raw("IFNULL(sum(rb.rate)/count(rb.post_id),0) as total"))
            ->where('bp.business_type_id',1)
            ->where('bp.is_verified',1)
            ->leftJoin('rate_business as rb','rb.post_id','bp.id')
            ->groupBy('rb.post_id')
            ->leftJoin('views as v',function($join){
                $join->on('v.place_id','bp.id')
                ->where('v.lib_place_type_id',1);
             })
             ->groupBy('v.place_id');
             if($var=='view'){
                $data = $data->orderBy('views','desc');
             }
             else{
                $data = $data->orderBy('bp.business_price',$var);
             }
        }

        $tags = $data;
        $tags_array = array();
        $tags_id_array = array();
        $tag_lib = DB::table('business_tags_lib as btl')
        ->select('btl.*','cat.name as cat_name')
        ->leftJoin('categorytags as cat','cat.id','btl.category_tags_id')
        ->get();


        foreach($tags->get() as $k){

            $tags_id = array();
            $cat_tagId = array();
            foreach($tag_lib as $i){
                if($i->business_profile_id == $k->id){
                    // dd($i->cat_name);
                    array_push($tags_id,$i->cat_name);
                    array_push($cat_tagId,$i->category_tags_id);
                }
            }
            array_push($tags_array,$tags_id);
            array_push($tags_id_array,$cat_tagId);
        }
        $data = $data->paginate(4);
        $views = array();
        foreach($data as $a){
            $view = DB::table('views')
            ->where('place_id',$a->id)
            ->where('lib_place_type_id',1)
            ->get()->count();
            array_push($views,$view);
        }

        $rateholder = array();
        $count=0;
        foreach ($data as $item) {
            $rates = DB::table('rate_business')
            ->where('post_id',$item->id)
            ->get();
            $rateholder[$count]=$rates;
            $count++;
        }
        #dd($business_profile);
        $tags = DB::table('categorytags')
        ->select("*")
        ->where('category_id','!=',5)
        ->get();

        $category = DB::table('category')
        ->select("*")
        ->where('id','<',5)
        ->get();
        $reg = Region::all();
        $top = DB::table('business_profile as bp')
        ->select([
            'rb.post_id',DB::raw("IFNULL(sum(rb.rate)/count(rb.post_id),0) as total")
            ,"bp.*"])
        ->where('bp.business_type_id',1)
        ->leftJoin('rate_business as rb','rb.post_id','bp.id')
        ->groupBy('rb.post_id')
        ->orderBy('total', 'desc')
        // ->leftJoin('business_tags_lib as btl','btl.user_id','=','bp.user_id')
        ->limit(2)
        ->get();
        $view = DB::table('business_profile as bp')
        ->select([
            DB::raw("IFNULL(count(vw.place_id),0) as total")
            ,"bp.*"])
        ->where('bp.business_type_id',1)
        ->leftJoin('views as vw','vw.place_id','bp.id')
        // ->where('vw.lib_place_type_id','bp.business_type_id')
        ->where('vw.lib_place_type_id',1)
        ->groupBy('vw.place_id')
        ->orderBy('total', 'desc')
        // ->leftJoin('business_tags_lib as btl','btl.user_id','=','bp.user_id')
        ->limit(2)
        ->get();
        $tags_top = array();
        $tags_id_top = array();



        foreach($top as $k){

            $tags_id = array();
            $cat_tagId = array();
            foreach($tag_lib as $i){
                if($i->business_profile_id == $k->id){
                    // dd($i->cat_name);
                    array_push($tags_id,$i->cat_name);
                    array_push($cat_tagId,$i->category_tags_id);
                }
            }
            array_push($tags_top,$tags_id);
            array_push($tags_id_top,$cat_tagId);
        }
        $tags_view = array();
        $tags_id_view = array();



        foreach($view as $k){

            $tags_id = array();
            $cat_tagId = array();
            foreach($tag_lib as $i){
                if($i->business_profile_id == $k->id){
                    // dd($i->cat_name);
                    array_push($tags_id,$i->cat_name);
                    array_push($cat_tagId,$i->category_tags_id);
                }
            }
            array_push($tags_view,$tags_id);
            array_push($tags_id_view,$cat_tagId);
        }
        return view ('modules.HotelsandResort')
        ->withViews($views)
        ->withData($data)
        ->withTags($tags)
        ->withSearch($search)
        ->withPartial($partial)
        ->withRegion($reg)
        ->with('tags_array',$tags_array)
        ->with('tags_id',$tags_id_array)
         ->with('tags_top',$tags_top)
        ->with('tags_id_top',$tags_id_top)
        ->with('tags_view',$tags_view)
        ->with('tags_id_view',$tags_id_view)
        ->withinput(request()->search)
        ->withCategory($category)
        ->withRateholder($rateholder)
        ->withTop($top)
        ->withView($view)
        ;
    }
    public function restaurant(){
        // dd(request()->all());
        $partial = 2;
        $suggest = DB::table('tourist')
        ->select('*')
        ->inRandomOrder()
        ->limit(3)
        ->get();
        $search = DB::table('business_profile')
        ->select('*')
        ->where('business_type_id',2)
        ->get();
        if(!is_null(request()->filter) && !is_null(request()->filter_region)){
            $data = DB::table('business_profile as bp')
            ->select("bp.*")
            ->where('bp.business_type_id',2)
            ->leftJoin('business_tags_lib as btl','btl.business_profile_id','=','bp.id')
            ->whereIn('btl.category_tags_id',request()->filter)
            ->leftJoin('region_libs as rl','rl.business_profile_id','=','bp.id')
            ->whereIn('rl.region_id',request()->filter_region)
            ->where('bp.is_verified',1)
            ->groupBy('bp.id');

        }
        else if(!is_null(request()->filter)){
            $data = DB::table('business_profile as bp')
            ->select("bp.*")
            ->where('bp.business_type_id',2)
            ->leftJoin('business_tags_lib as btl','btl.business_profile_id','=','bp.id')
            ->whereIn('btl.category_tags_id',request()->filter)
            ->where('bp.is_verified',1)
            ->groupBy('bp.id');

            }
        else if(!is_null(request()->filter_region)){
            $data = DB::table('business_profile as bp')
            ->select("bp.*")
            ->where('bp.business_type_id',2)
            ->leftJoin('region_libs as rl','rl.business_profile_id','=','bp.id')
            ->whereIn('rl.region_id',request()->filter_region)
            ->where('bp.is_verified',1)
            ->groupBy('bp.id');

            }
        else{
            $data = DB::table('business_profile as bp')
            ->select([
                'rb.post_id as rb_post',DB::raw("IFNULL(sum(rb.rate)/count(rb.post_id),0) as total")
                ,"bp.*"])
            ->where('bp.business_type_id',2)
            ->where('bp.is_verified',1)
            ->leftJoin('rate_business as rb','rb.post_id','bp.id')
            ->groupBy('rb.post_id')
            // ->leftJoin('business_tags_lib as btl','btl.user_id','=','bp.user_id')
         ;
        }
        if(!is_null(request()->search)){
            // dd(1);
            $data->where('bp.business_name','LIKE','%'.request()->search.'%')
            ->orWhere('bp.business_address','LIKE','%'.request()->search.'%')
            ->orWhere('bp.attraction_details','LIKE','%'.request()->search.'%')
            ->orWhere('bp.business_city','LIKE','%'.request()->search.'%')
            ->orWhere('bp.business_brgy','LIKE','%'.request()->search.'%')
            ->orWhere('bp.business_landmarks','LIKE','%'.request()->search.'%');
        }if(!is_null(request()->min)){
            $data->where('business_price','>=',request()->min);
        }
        if(!is_null(request()->max)){
            $data->where('business_price','<=',request()->max);
        }
        $tags = $data;
        $tags_array = array();
        $tags_id_array = array();
        $tag_lib = DB::table('business_tags_lib as btl')
        ->select('btl.*','cat.name as cat_name')
        ->leftJoin('categorytags as cat','cat.id','btl.category_tags_id')
        ->get();


        foreach($tags->get() as $k){

            $tags_id = array();
            $cat_tagId = array();
            foreach($tag_lib as $i){
                if($i->business_profile_id == $k->id){
                    // dd($i->cat_name);
                    array_push($tags_id,$i->cat_name);
                    array_push($cat_tagId,$i->category_tags_id);
                }
            }
            array_push($tags_array,$tags_id);
            array_push($tags_id_array,$cat_tagId);
        }
        $data = $data->paginate(4);
        $rateholder = array();
        $count=0;
        foreach ($data as $item) {
            $rates = DB::table('rate_business')
            ->where('post_id',$item->id)
            ->get();
            $rateholder[$count]=$rates;
            $count++;
        }
        #dd($business_profile);
        $tags = DB::table('categorytags')
        ->select("*")
        ->whereIn('category_id',[5,9])
        ->get();
        // dd($tags);
        $category = DB::table('category')
        ->select("*")
        ->whereIn('id',[5,9])
        ->get();
        // dd($category);
        $reg = Region::all();


        $views = array();
        foreach($data as $a){
            $view = DB::table('views')
            ->where('place_id',$a->id)
            ->where('lib_place_type_id',1)
            ->get()->count();
            array_push($views,$view);
        }
        $top = DB::table('business_profile as bp')
        ->select([
            'rb.post_id',DB::raw("IFNULL(sum(rb.rate)/count(rb.post_id),0) as total")
            ,"bp.*"])
        ->where('bp.business_type_id',2)
        ->leftJoin('rate_business as rb','rb.post_id','bp.id')
        ->groupBy('rb.post_id')
        ->where('bp.is_verified',1)
        ->orderBy('total', 'desc')
        // ->leftJoin('business_tags_lib as btl','btl.user_id','=','bp.user_id')
        ->limit(2)
        ->get();
        $view = DB::table('business_profile as bp')
        ->select([
            DB::raw("IFNULL(count(vw.place_id),0) as total")
            ,"bp.*"])
        ->where('bp.business_type_id',2)
        ->leftJoin('views as vw','vw.place_id','bp.id')
        // ->where('vw.lib_place_type_id','bp.business_type_id')
        ->where('vw.lib_place_type_id',1)
        ->groupBy('vw.place_id')
        ->where('bp.is_verified',1)
        ->orderBy('total', 'desc')
        // ->leftJoin('business_tags_lib as btl','btl.user_id','=','bp.user_id')
        ->limit(2)
        ->get();
        $tags_top = array();
        $tags_id_top = array();



        foreach($top as $k){

            $tags_id = array();
            $cat_tagId = array();
            foreach($tag_lib as $i){
                if($i->business_profile_id == $k->id){
                    // dd($i->cat_name);
                    array_push($tags_id,$i->cat_name);
                    array_push($cat_tagId,$i->category_tags_id);
                }
            }
            array_push($tags_top,$tags_id);
            array_push($tags_id_top,$cat_tagId);
        }
        $tags_view = array();
        $tags_id_view = array();



        foreach($view as $k){

            $tags_id = array();
            $cat_tagId = array();
            foreach($tag_lib as $i){
                if($i->business_profile_id == $k->id){
                    // dd($i->cat_name);
                    array_push($tags_id,$i->cat_name);
                    array_push($cat_tagId,$i->category_tags_id);
                }
            }
            array_push($tags_view,$tags_id);
            array_push($tags_id_view,$cat_tagId);
        }
        return view ('modules.Restaurant')
        ->withViews($views)
        ->withData($data)
        ->withTags($tags)
        ->withRegion($reg)
        ->withPartial($partial)
        ->withView($view)
        ->withSearch($search)
        ->with('tags_array',$tags_array)
        ->with('tags_id',$tags_id_array)
        ->with('tags_top',$tags_top)
        ->with('tags_id_top',$tags_id_top)
        ->with('tags_view',$tags_view)
        ->with('tags_id_view',$tags_id_view)
        ->withSuggest($suggest)
        ->withinput(request()->search)
        ->withTop($top)
        ->withCategory($category)
        ->withRateholder($rateholder)
        ;
    }
    public function restaurantSort($id){
        $partial = 2;
        $var = '';
        if($id == 1){
            $var = 'asc';
        }elseif($id == 2){
            $var = 'desc';
        }else{
            $var = 'view';
        }
        $search = DB::table('business_profile')
        ->select('*')
        ->where('business_type_id',2)
        ->get();
        // dd(request()->all());
        if(!is_null(request()->filter) && !is_null(request()->filter_region)){
            $data = DB::table('business_profile as bp')
            ->select("bp.*",DB::raw('count(v.place_id) as views'))
            ->where('bp.business_type_id',2)
            ->leftJoin('business_tags_lib as btl','btl.business_profile_id','=','bp.id')
            ->whereIn('btl.category_tags_id',request()->filter)
            ->where('bp.is_verified',1)
            ->leftJoin('region_libs as rl','rl.business_profile_id','=','bp.id')
            ->leftJoin('views as v',function($join){
                $join->on('v.place_id','bp.id')
                ->where('v.lib_place_type_id',1);
             })
            ->whereIn('rl.region_id',request()->filter_region)
            ->groupBy('bp.id')
            ->orderBy('bp.business_price',$var)
            ->groupBy('v.place_id');
            if($var=='view'){
                $data = $data->orderBy('views','desc')->paginate(4);
             }
             else{
                $data = $data->orderBy('bp.business_price',$var)->paginate(4);
            }

        }
        else if(!is_null(request()->filter)){
            $data = DB::table('business_profile as bp')
            ->select("bp.*",DB::raw('count(v.place_id) as views'))
            ->where('bp.business_type_id',2)
            ->leftJoin('business_tags_lib as btl','btl.business_profile_id','=','bp.id')
            ->leftJoin('views as v',function($join){
                $join->on('v.place_id','bp.id')
                ->where('v.lib_place_type_id',1);
             })
            ->whereIn('btl.category_tags_id',request()->filter)
            ->where('bp.is_verified',1)
            ->groupBy('bp.id')
            ->orderBy('bp.business_price',$var)
            ->groupBy('v.place_id');
            if($var=='view'){
                $data = $data->orderBy('views','desc')->paginate(4);
             }
             else{
                $data = $data->orderBy('bp.business_price',$var)->paginate(4);
             }

            }
        else if(!is_null(request()->filter_region)){
            $data = DB::table('business_profile as bp')
            ->select("bp.*",DB::raw('count(v.place_id) as views'))
            ->where('bp.business_type_id',2)
            ->leftJoin('region_libs as rl','rl.business_profile_id','=','bp.id')
            ->leftJoin('views as v',function($join){
                $join->on('v.place_id','bp.id')
                ->where('v.lib_place_type_id',1);
             })
            ->whereIn('rl.region_id',request()->filter_region)
            ->where('bp.is_verified',1)
            ->groupBy('bp.id')
            ->orderBy('bp.business_price',$var)
            ->groupBy('v.place_id');
                if($var=='view'){
                    $data = $data->orderBy('views','desc')->paginate(4);
                }
                else{
                    $data = $data->orderBy('bp.business_price',$var)->paginate(4);
                }
            }
        else{
            $data = DB::table('business_profile as bp')
            ->select("bp.*",DB::raw('count(v.place_id) as views')
                ,DB::raw("IFNULL(sum(rb.rate)/count(rb.post_id),0) as total")
                )
            ->where('bp.business_type_id',2)
            ->where('bp.is_verified',1)
            ->leftJoin('views as v',function($join){
                $join->on('v.place_id','bp.id')
                ->where('v.lib_place_type_id',1);
             })
             ->leftJoin('rate_business as rb','rb.post_id','bp.id')
            ->groupBy('rb.post_id')
             ->groupBy('v.place_id');
             if($var=='view'){
                $data = $data->orderBy('views','desc');
             }
             else{
                $data = $data->orderBy('bp.business_price',$var);
             }
        }
        $tags = $data;
        $tags_array = array();
        $tags_id_array = array();
        $tag_lib = DB::table('business_tags_lib as btl')
        ->select('btl.*','cat.name as cat_name')
        ->leftJoin('categorytags as cat','cat.id','btl.category_tags_id')
        ->get();


        foreach($tags->get() as $k){

            $tags_id = array();
            $cat_tagId = array();
            foreach($tag_lib as $i){
                if($i->business_profile_id == $k->id){
                    // dd($i->cat_name);
                    array_push($tags_id,$i->cat_name);
                    array_push($cat_tagId,$i->category_tags_id);
                }
            }
            array_push($tags_array,$tags_id);
            array_push($tags_id_array,$cat_tagId);
        }
        $data = $data->paginate(4);
        $views = array();
        foreach($data as $a){
            $view = DB::table('views')
            ->where('place_id',$a->id)
            ->where('lib_place_type_id',1)
            ->get()->count();
            array_push($views,$view);
        }
        $rateholder = array();
        $count=0;
        foreach ($data as $item) {
            $rates = DB::table('rate_business')
            ->where('post_id',$item->id)
            ->get();
            $rateholder[$count]=$rates;
            $count++;
        }
        #dd($business_profile);
        $tags = DB::table('categorytags')
        ->select("*")
        ->where('category_id','=',5)
        ->get();

        $category = DB::table('category')
        ->select("*")
        ->where('id','=',5)
        ->get();
        $reg = Region::all();
        $top = DB::table('business_profile as bp')
        ->select([
            'rb.post_id',DB::raw("IFNULL(sum(rb.rate)/count(rb.post_id),0) as total")
            ,"bp.*"])
        ->where('bp.business_type_id',2)
        ->leftJoin('rate_business as rb','rb.post_id','bp.id')
        ->groupBy('rb.post_id')
        ->orderBy('total', 'desc')
        // ->leftJoin('business_tags_lib as btl','btl.user_id','=','bp.user_id')
        ->limit(2)
        ->get();
        $view = DB::table('business_profile as bp')
        ->select([
            DB::raw("IFNULL(count(vw.place_id),0) as total")
            ,"bp.*"])
        ->where('bp.business_type_id',2)
        ->leftJoin('views as vw','vw.place_id','bp.id')
        // ->where('vw.lib_place_type_id','bp.business_type_id')
        ->where('vw.lib_place_type_id',1)
        ->groupBy('vw.place_id')
        ->orderBy('total', 'desc')
        // ->leftJoin('business_tags_lib as btl','btl.user_id','=','bp.user_id')
        ->limit(2)
        ->get();
        $tags_top = array();
        $tags_id_top = array();



        foreach($top as $k){

            $tags_id = array();
            $cat_tagId = array();
            foreach($tag_lib as $i){
                if($i->business_profile_id == $k->id){
                    // dd($i->cat_name);
                    array_push($tags_id,$i->cat_name);
                    array_push($cat_tagId,$i->category_tags_id);
                }
            }
            array_push($tags_top,$tags_id);
            array_push($tags_id_top,$cat_tagId);
        }
        $tags_view = array();
        $tags_id_view = array();



        foreach($view as $k){

            $tags_id = array();
            $cat_tagId = array();
            foreach($tag_lib as $i){
                if($i->business_profile_id == $k->id){
                    // dd($i->cat_name);
                    array_push($tags_id,$i->cat_name);
                    array_push($cat_tagId,$i->category_tags_id);
                }
            }
            array_push($tags_view,$tags_id);
            array_push($tags_id_view,$cat_tagId);
        }
        return view ('modules.Restaurant')
        ->withViews($views)
        ->withData($data)
        ->withTags($tags)
        ->withRegion($reg)
        ->withSearch($search)
        ->withPartial($partial)
        ->with('tags_array',$tags_array)
        ->with('tags_id',$tags_id_array)
        ->with('tags_top',$tags_top)
        ->with('tags_id_top',$tags_id_top)
        ->with('tags_view',$tags_view)
        ->with('tags_id_view',$tags_id_view)
        ->withinput(request()->search)
        ->withCategory($category)
        ->withRateholder($rateholder)
        ->withTop($top)
        ->withView($view)
        ;
    }
    public function home(){
        $rest = DB::table('business_profile')
        ->select('*')
        ->where('business_type_id',2)
        ->get();
        $hotel = DB::table('business_profile')
        ->select('*')
        ->where('business_type_id',1)
        ->get();
        $tour = DB::table('tourist')
        ->select('*')
        ->whereNull('deleted_at')
        ->get();
        $agency = DB::table('agencu')
        ->whereNull('deleted_at')
        ->select('*')
        ->get();

        return view ('modules.taravel_homepage')
        ->withAgency($agency)
        ->withRestaurant($rest)
        ->withHotel($hotel)
        ->withTour($tour);
    }
    public function tourist(){


        if(!is_null(request()->filter) && !is_null(request()->filter_region)){
            $data = DB::table('tourist as tou')
            ->select([
                'rt.post_id',DB::raw("IFNULL(sum(rt.rate)/count(rt.post_id),0) as total")
            ,'tou.*','cat.name as cat_name','cat.id as cat_id'])
            ->whereIn('tou.categorytags_id',request()->filter)
            ->whereNull('tou.deleted_at')
            ->leftJoin('tourist_region as tr','tr.tourist_id','=','tou.id')
            ->whereIn('tr.region_id',request()->filter_region)
            ->leftJoin('rate_tourist as rt','tou.id','rt.post_id')
            ->leftJoin('categorytags as cat','cat.id','tou.categorytags_id')
            ->groupBy('rt.post_id')
            ->groupBy('tou.id');
        }
        else if(!is_null(request()->filter)){
            $data = DB::table('tourist as tou')
            ->select([
                'rt.post_id',DB::raw("IFNULL(sum(rt.rate)/count(rt.post_id),0) as total")
            ,'tou.*','cat.name as cat_name','cat.id as cat_id'])
            ->whereIn('tou.categorytags_id',request()->filter)
            ->leftJoin('rate_tourist as rt','tou.id','rt.post_id')
            ->leftJoin('categorytags as cat','cat.id','tou.categorytags_id')
            ->groupBy('rt.post_id')
            ->whereNull('tou.deleted_at')
            ->groupBy('tou.id');
        }
        else if(!is_null(request()->filter_region)){
            $data = DB::table('tourist as tou')
            ->select([
                'rt.post_id',DB::raw("IFNULL(sum(rt.rate)/count(rt.post_id),0) as total")
            ,'tou.*','cat.name as cat_name','cat.id as cat_id'])
            ->whereNull('tou.deleted_at')
            ->leftJoin('tourist_region as tr','tr.tourist_id','=','tou.id')
            ->whereIn('tr.region_id',request()->filter_region)
            ->leftJoin('rate_tourist as rt','tou.id','rt.post_id')
            ->leftJoin('categorytags as cat','cat.id','tou.categorytags_id')
            ->groupBy('rt.post_id')
            ->groupBy('tou.id');
        }else{
            $data = DB::table('tourist as tou')
            ->select([

            'tou.*','cat.name as cat_name','cat.id as cat_id'])
            ->whereNull('tou.deleted_at')
            // ->leftJoin('rate_tourist as rt','tou.id','rt.post_id')
            ->leftJoin('categorytags as cat','cat.id','tou.categorytags_id')

            ;


        }
        if(!is_null(request()->search)){
            $data->where('tou.name','LIKE','%'.request()->search.'%')
                 ->orWhere('tou.address','LIKE','%'.request()->search.'%')
                 ->orWhere('tou.description','LIKE','%'.request()->search.'%');
            // $data = DB::table('tourist as tou')
            // ->select([
            //     'rt.post_id',DB::raw("IFNULL(sum(rt.rate)/count(rt.post_id),0) as total")
            // ,'tou.*','cat.name as cat_name','cat.id as cat_id'])
            // ->whereNull('tou.deleted_at')
            // ->leftJoin('rate_tourist as rt','tou.id','rt.post_id')
            // ->leftJoin('categorytags as cat','cat.id','tou.categorytags_id')
            // ->where('tou.name','LIKE','%'.request()->search.'%')
            // ->orWhere('tou.address','LIKE','%'.request()->search.'%')
            // ->groupBy('rt.post_id')->paginate(2);
        }
            $data = $data->paginate(4);

        $search = DB::table('tourist')
        ->select('*')
        ->get();
        // dd($data);
        $views = array();
        foreach($data as $a){
            $view = DB::table('views')
            ->where('place_id',$a->id)
            ->where('lib_place_type_id',2)
            ->get()->count();
            array_push($views,$view);
        }
        $ratess = array();

        $ratee= DB::table('rate_tourist')
        ->select('*')
        ->get();

        foreach($data as $a){
           $total = 0;
           $count = 0;
            foreach($ratee as $i){

                if($i->post_id == $a->id){
                    $total+=$i->rate;
                    $count++;
                }

                if($total>0){
                    $total/$count;
                }else{
                    $total = 0;
                }
            }
            array_push($ratess,$total);
        }
        // dd($rates);
        $rateholder = array();
        $count=0;
        foreach ($data as $item) {
            $rates = DB::table('rate_tourist')
            ->where('post_id',$item->id)
            ->get();
            $rateholder[$count]=$rates;
            $count++;
        }
        #dd($business_profile);
        $tags = DB::table('categorytags')
        ->select("*")
        ->where('category_id','>=',6)
        ->where('category_id','!=',9)
        ->get();

        $category = DB::table('category')
        ->select("*")
        ->where('id','>=',6)
        ->where('id','!=',9)
        ->get();

        $top = DB::table('rate_tourist as rt')
        ->select([
            'rt.post_id',DB::raw("IFNULL(sum(rt.rate)/count(rt.post_id),0) as total")
        ,'tou.*','cat.name as cat_name','cat.id as cat_id'])
        ->leftJoin('tourist as tou','tou.id','rt.post_id')
        ->leftJoin('categorytags as cat','cat.id','tou.categorytags_id')
        ->groupBy('rt.post_id')
        ->limit(2)
        ->orderBy('total', 'desc')
        ->get();
        $view = DB::table('tourist as tou')
        ->select([
            DB::raw("IFNULL(count(vw.place_id),0) as total")
            ,"tou.*",'cat.name as cat_name','cat.id as cat_id'])

        ->leftJoin('views as vw','vw.place_id','tou.id')
        ->leftJoin('categorytags as cat','cat.id','tou.categorytags_id')
        // ->where('vw.lib_place_type_id','bp.business_type_id')
        ->where('vw.lib_place_type_id',2)
        ->groupBy('vw.place_id')
        ->orderBy('total', 'desc')
        // ->leftJoin('business_tags_lib as btl','btl.user_id','=','bp.user_id')
        ->limit(2)
        ->get();
        $things = DB::table('todo')
        ->select('*')
        ->inRandomOrder()
        ->limit(4)
        ->get();

        $reg = Region::all();
        // dd($ratess);
        return view ('modules.taravel_tourist')
        ->withViews($views)
        ->withData($data)
        ->withTags($tags)
        ->withRates($ratess)
        ->withTop($top)
        ->withSearch($search)
        ->withThings($things)
        ->withView($view)
        ->withinput(request()->search)
        ->withCategory($category)
        ->withRegion($reg)
        ->withRateholder($rateholder)
        ;

    }
    public function viewReg(){
        $role = Role::all();
        return view ('modules.taravel_signup')->withRole($role);
    }
    public function postReg(){

        // if(DB::table('users')->where('email',request()->email)->get()[0]->email == request()->email){

        //     session::flash('error','Email is existing, please use another email in requirements tab');
        //     return redirect()->back();
        // }

        $user = new User();
        $user->role_id = request()->user_type;
        $user->email = request()->email;
        $user->password = bcrypt(request()->password);
        $user->name = request()->fname;
        $user->is_verified = '0';
        $user->save();
        $data = array('name'=>request()->fname,'user_id'=>$user->id);

        Mail::send('mail', $data, function($message) {
           $message->to(request()->email, 'Site of life')->subject
              ('Taravel email verification');
           $message->from('taraveladm1n@gmail.com','Taravel');
        });

        DB::table('user_personal_information')
        ->insert([
            'firstname' => request()->fname,
            'middlename'=> request()->mname,
            'lastname' => request()->lname,
            'user_id' => $user->id
        ]);
            Session::flash('success','Registered Successfully');
        return redirect()->to('login');

    }
    public function getDetails($id){

        $user = Auth::user();
        $user_id = null;
        if($user){
           $user_id = $user->id;
        }
        DB::table('views')
            ->insert([
            'place_id'=>$id,
            'user_id'=>$user_id,
            'lib_place_type_id'=>2,
            'date'=>date(now()),
        ]);

        $details = DB::table('tourist')
        ->select('*')
        ->where('id',$id)
        ->first();
        $comments = DB::table('comment_tourist as cb')
        ->select('cb.*','upi.*')
        ->where('post_id',$id)
        ->leftJoin('user_personal_information as upi','upi.user_id','=','cb.user_id')
        ->get();
        $rates = DB::table('rate_tourist as rb')
        ->select('rb.*','rb.user_id as rate_user_id')
        ->where('post_id',$id)
        // ->leftJoin('user_personal_information as upi','upi.user_id','=','rb.user_id')
        ->get();
        // dd($rates);

        $check = DB::table('tourist')
        ->select('*')
        ->where('id','!=',$id)
        ->get();
    if(count($check)>=4){
        $suggested = DB::table('tourist')
        ->select('*')
        ->where('id','!=',$id)
        ->get()
        ->random(4);
    }else{
        $suggested = DB::table('tourist')
        ->select('*')
        ->where('id','!=',$id)
        ->get()
        ->random(count($check));
    }
    // $rand = array();
    //     $rand[0]=rand(1,$suggested->count());
    //     $rand[1]=rand(2,$suggested->count());
    //     $rand[2]=rand(3,$suggested->count());
    //     $rand[3]=rand(4,$suggested->count());
    //     if($suggested->count()>0){
    // while($rand[0]==$rand[1] || $rand[0]==$rand[2] ||$rand[0]==$rand[3] || $rand[1]==$rand[2] || $rand[1]==$rand[3]|| $rand[2]==$rand[3]){
    //     $rand[0]=rand(1,$suggested->count());
    //     $rand[1]=rand(2,$suggested->count());
    //     $rand[2]=rand(3,$suggested->count());
    //     $rand[3]=rand(4,$suggested->count());
    // }
    //     }
    // dd($suggested);
        $tags=DB:: table('tourist as t')
        ->select(['ct.name as _name', 't.*'])
        ->where('t.id','=',$id)
        ->leftJoin('categorytags as ct', 'ct.id', 't.categorytags_id')
                ->get();

        return view('modules.tourist_travel_details')
        ->withTags($tags)
        ->withDetails($details)
        ->withComments($comments)
        ->withRates($rates)
        // ->withRand($rand)
        ->withSuggested($suggested);
    }
    public function checkEmail(Request $request){
        $email = $request->input('email');
        $isExists = \App\User::where('email',$email)->first();
        if($isExists){
            return response()->json(array("exists" => true));
        }else{
            return response()->json(array("exists" => false));
        }
    }
    public function checkVerify(Request $request){
        $email = $request->input('email');
        $isExists = \App\User::where('email',$email)->first();
        if($isExists->is_verified != 1){
            return response()->json(array("exists" => true));
        }else{
            return response()->json(array("exists" => false));
        }
    }
    public function verifyEmail($id){

        $user = DB::table('users')->where('id',$id);
        // dd($user);
        if(!is_null($user->first())){

        }
        $user->update([
            'is_verified' => '1'
        ]);
        return redirect()->to('login');
    }
    public function things(){
        $region = DB::table('regions')->select('*')->get();
        // dd($regions);

        // dd(request()->filter_region);
        if(!is_null(request()->filter_region)){
            $things = DB::table('todo')->select('*')->whereIn('region',request()->filter_region)->orderBy('id','desc')->get();
        }else{
            $things = DB::table('todo')->select('*')->orderBy('id','desc')->get();
        }

        // dd($things);
        return view('modules.things_to_do')
        ->withRegion($region)
        ->withThings($things);
    }
    public function profile($id){
        $profile = DB::table('todo')
        ->where('id',$id)
        ->first();
// dd($profile);
        $gallery = DB::table('things_gallery')
        ->where('things_id',$id)
        ->get();
        // dd($gallery);
        $comment = DB::table('things_comment as tc')
        ->where('tc.post_id',$id)
        ->leftJoin('users as usr','usr.id','tc.user_id')
        ->get();
        // dd($comment);
        // dd($comment);

        $festival = DB::table('festival')
        ->where('todo_id',$id)
        ->get();
        return view('modules.things_profile')
        ->withProfile($profile)
        ->withComment($comment)
        ->withGallery($gallery)
        ->withFestival($festival);

    }
    public function upload(Request $req){
        $image_filename = $req->file->getClientOriginalName();
        $id = $req->tour_d;
        // dd($id);
        if (!is_null($id)) {
          $profile_image              = $req->file;
        if($profile_image){

            /*Prepares the directory, creates if not existing*/
            $image_folder           = $id;
            $image_path             = public_path().'/things/gallery/'.$image_folder;

            File::isDirectory($image_path) or File::makeDirectory($image_path, 0777,true,true);
            // return 1;
            /*Copies the uploaded image to Profile Photos Directory*/

            $profile_image->move($image_path,$req->file->getClientOriginalName());
            $profile_image_path        = '/things/gallery/'.$image_folder."/".$req->file->getClientOriginalName();

            DB::table('things_gallery')->insert(
                [
                'things_id' => $id,
                'photo_url' => $profile_image_path
                ]
            );
                }
        return response()->json(array(
            'code'      =>  200,
            'filename'   =>  $image_filename
        ), 200);
        }

        //else null
        else{
                return response()->json(array(
            'code'      =>  500,
            'filename'   =>  $image_filename
        ), 500);
        }
    }
    public function comment(){
          $save =   DB::table('things_comment')
            ->insert([
                'post_id' => request()->id,
                'comment' => request()->comment,
                'user_id' => Auth::user()->id,
                'date'     => now()
            ]);
            If($save){
                Session::flash('success','Successfully Commented');
                return redirect()->back();
            }
    }
    public function getCustomPackages(){
        $accom=DB::table('add_custom_package')
        ->where('user_id','=',Auth::user()->id)
        ->where('type','=',1)
        ->get();
        $pack=DB::table('add_custom_package')
        ->where('user_id','=',Auth::user()->id)
        ->where('type','=',2)
        ->get();
        $total=DB::table('add_custom_package')
        ->select(DB::raw("IFNULL(sum(price),0) as total"))
        ->where('user_id',Auth::user()->id)
        ->get();
        // dd($total[0]->total);
        $budget=DB::table('user_budget')
        ->where('user_id','=',Auth::user()->id)
        ->get();
        // dd($budget,$total);
        return view('modules.custom_packages')
        ->withAccom($accom)
        ->withPack($pack)
        ->withBudget($budget)
        ->withTotal($total);
    }
    public function editProfile(){
        $user=DB::table('users')->where('id',Auth::user()->id)->get();
        return view('modules.editprofile')
        ->withUser($user);
    }
}
