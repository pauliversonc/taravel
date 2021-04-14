<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class PostReviewController extends Controller
{
    public function post_review()
    {
        $tourcomment=DB::table('comment_tourist as ct')
        ->select('ct.*','t.*','ct.id as ct_id')
        ->leftJoin('tourist as t','ct.post_id','t.id')
        ->get();
        $tourrate=DB::table('rate_tourist as rt')
        ->select('rt.*','t.*','rt.id as rt_id','u.id as user')
        ->leftJoin('tourist as t','rt.post_id','t.id')
        ->leftJoin('users as u','rt.user_id','u.id')
        ->get();
        $buscomment=DB::table('comment_business as cb')
        ->select('cb.*','bp.*','cb.id as cb_id','u.id as user')
        ->leftJoin('business_profile as bp','cb.post_id','bp.id')
        ->leftJoin('users as u','cb.user_id','u.id')
        ->get();
        $busrate=DB::table('rate_business as rb')
        ->select('rb.*','bp.*','rb.id as rb_id','u.id as user')
        ->leftJoin('business_profile as bp','rb.post_id','bp.id')
        ->leftJoin('users as u','rb.user_id','u.id')
        ->get();
        $agencyrate=DB::table('rate_agency as ra')
        ->select('ra.*','a.*','ra.id as ra_id','u.id as user')
        ->leftJoin('agencu as a','ra.post_id','a.id')
        ->leftJoin('users as u','ra.user_id','u.id')
        ->get();
        $agentrate=DB::table('rate_partner_agent as rpa')
        ->select('rpa.*','pa.*','rpa.id as rpa_id','u.id as user')
        ->leftJoin('partneragent as pa','rpa.partneragent_id','pa.id')
        ->leftJoin('users as u','rpa.user_id','u.id')
        ->get();
        // dd($busrate);
        return view('modules.post_review')
        ->withAgentrate($agentrate)
        ->withAgencyrate($agencyrate)
        ->withTourcomment($tourcomment)
        ->withTourrate($tourrate)
        ->withBuscomment($buscomment)
        ->withBusrate($busrate);
        
    }
    public function delete_tour_comment(Request $request)
    {
            DB::table('comment_tourist')
            ->where('id','=',$request->ct_id)
            ->delete();       

            Session::flash('success','Successfully deleted');
            return redirect()->back();
    }
    public function delete_bus_comment(Request $request)
    {
            DB::table('comment_business')
            ->where('id','=',$request->cb_id)
            ->delete();       

            Session::flash('success','Successfully deleted');
            return redirect()->back();
    }
    public function delete_bus_rating(Request $request)
    {
            DB::table('rate_business')
            ->where('id','=',$request->rb_id)
            ->delete();       
            Session::flash('success','Successfully deleted');
            return redirect()->back();
        }
        public function delete_agency_rating(Request $request)
        {
                DB::table('rate_agency')
                ->where('id','=',$request->ra_id)
                ->delete();       
                Session::flash('success','Successfully deleted');
                return redirect()->back();
            }
            public function delete_agent_rating(Request $request)
        {
                DB::table('rate_partner_agent')
                ->where('id','=',$request->rpa_id)
                ->delete();       
                Session::flash('success','Successfully deleted');
                return redirect()->back();
            }
}
