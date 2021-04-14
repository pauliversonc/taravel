<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Permit;
use App\Http\Requests\CreatePermitRequest;
use App\Http\Requests\UpdatePermitRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\BusinessType;
use Auth;
use DB;
class PermitController extends Controller {

	/**
	 * Display a listing of permit
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        if(Auth::user()->id == 1){
            $permit = DB::table('permit as p')
            ->select('p.*','bp.business_name as name')
            ->leftJoin('business_profile as bp','bp.id','p.businesstype_id')
            // ->where('bp.user_id',Auth::user()->id)
            ->whereNull('p.deleted_at')->get();
        }else{
            $permit = DB::table('permit as p')
            ->select('p.*','bp.business_name as name')
            ->leftJoin('business_profile as bp','bp.id','p.businesstype_id')
            ->where('bp.user_id',Auth::user()->id)
            ->whereNull('p.deleted_at')->get();
        }


        return view('admin.permit.index')
        ->withPermit($permit);
	}

	/**
	 * Show the form for creating a new permit
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
        $business = DB::table('business_profile')
        ->select('*')
        // ->where('user_id',Auth::user()->id)
        ->get();

        // dd($business);
        return view('admin.permit.create')
        ->withBusiness($business);
	}

	/**
	 * Store a newly created permit in storage.
	 *
     * @param CreatePermitRequest|Request $request
	 */
	public function store(CreatePermitRequest $request)
	{
	    $request = $this->saveFiles($request);
		Permit::create($request->all());

		return redirect()->route(config('quickadmin.route').'.permit.index');
	}

	/**
	 * Show the form for editing the specified permit.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
        $permit = Permit::find($id);



        $buss = DB::table('business_profile')
        ->select('*')
        ->get();


        return view('admin.permit.edit')
        ->withBuss($buss)
        ->withPermit($permit);


		return view('admin.permit.edit', compact('permit', "businesstype"));
	}

	/**
	 * Update the specified permit in storage.
     * @param UpdatePermitRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePermitRequest $request)
	{
		$permit = Permit::findOrFail($id);

        $request = $this->saveFiles($request);

		$permit->update($request->all());

		return redirect()->route(config('quickadmin.route').'.permit.index');
	}

	/**
	 * Remove the specified permit from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Permit::destroy($id);

		return redirect()->route(config('quickadmin.route').'.permit.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            Permit::destroy($toDelete);
        } else {
            Permit::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.permit.index');
    }

}
