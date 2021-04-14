<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
class ReportsController extends Controller
{
    //

    public function getRatings(){
        // dd(Auth::user()->id);
        $ratings = DB::table('business_profile as bp')
        ->leftJoin('rate_business as rb','rb.post_id','bp.id')
        ->leftJoin('users as u','u.id','rb.user_id')
        ->where('bp.user_id',Auth::user()->id)
        ->whereNotNull('rb.rate')
        ->get();
        return view('modules.reports.ratings')
        ->withRatings($ratings);
    }
    public function getReviews(){
        $reviews = DB::table('business_profile as bp')
        ->leftJoin('comment_business as c','c.post_id','bp.id')
        ->leftJoin('users as u','u.id','c.user_id')
        ->where('bp.user_id',Auth::user()->id)
        ->whereNotNull('c.comment')
        ->get();
        return view('modules.reports.reviews')
        ->withReviews($reviews);
    }

    public function getAgencyRatings(){
        $ratings = DB::table('agencu as ag')
        ->select('u.name as user','ag.*','ra.*','pt.name as package_type')
        ->leftJoin('rate_agency as ra','ra.post_id','ag.id')
        ->leftJoin('users as u','u.id','ra.user_id')
        ->leftJoin('package_type as pt','pt.id','ag.package_type')
        ->where('ag.user_id',Auth::user()->id)
        ->whereNotNull('ra.rate')
        ->get();
        // dd($ratings);
        return view('modules.reports.agency.ratings')
        ->withRatings($ratings);
    }
    public function getViews(){
        $sched=DB::table('views as v')
                ->select(DB::raw("DATE_FORMAT(date, '%m-%Y') new_date"),  DB::raw('YEAR(date) year, MONTH(date) month'))
                ->leftJoin('business_profile as bp', 'bp.id','v.place_id')
                ->where('bp.user_id','=',Auth::user()->id)
                ->groupBy('year','month')
                ->get();
                // dd($sched);
                foreach($sched as $item){
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
                 }
                //  dd($sched);
        
        return view('modules.reports.views_stat')
        ->withSched($sched);
    }
}
