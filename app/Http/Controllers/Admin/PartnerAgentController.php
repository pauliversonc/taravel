<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\PartnerAgent;
use App\Http\Requests\CreatePartnerAgentRequest;
use App\Http\Requests\UpdatePartnerAgentRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\User;
use Auth;
use DB;

class PartnerAgentController extends Controller {

	/**
	 * Display a listing of partneragent
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $partneragent = PartnerAgent::with("user")->where('user_id',Auth::user()->id)->whereNull('deleted_at')->get();

		return view('admin.partneragent.index', compact('partneragent'));
	}

	/**
	 * Show the form for creating a new partneragent
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $user = DB::table('users')->where('id',Auth::user()->id)->first();


        return view('admin.partneragent.create')
        ->withUser($user);
	}

	/**
	 * Store a newly created partneragent in storage.
	 *
     * @param CreatePartnerAgentRequest|Request $request
	 */
	public function store(CreatePartnerAgentRequest $request)
	{
	    $request = $this->saveFiles($request);
		PartnerAgent::create($request->all());

		return redirect()->route(config('quickadmin.route').'.partneragent.index');
	}

	/**
	 * Show the form for editing the specified partneragent.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$partneragent = PartnerAgent::find($id);
        $user = DB::table('users')->where('id',Auth::user()->id)->first();


		return view('admin.partneragent.edit', compact('partneragent', "user"));
	}

	/**
	 * Update the specified partneragent in storage.
     * @param UpdatePartnerAgentRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePartnerAgentRequest $request)
	{
		$partneragent = PartnerAgent::findOrFail($id);

        $request = $this->saveFiles($request);

		$partneragent->update($request->all());

		return redirect()->route(config('quickadmin.route').'.partneragent.index');
	}

	/**
	 * Remove the specified partneragent from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		PartnerAgent::destroy($id);

		return redirect()->route(config('quickadmin.route').'.partneragent.index');
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
            PartnerAgent::destroy($toDelete);
        } else {
            PartnerAgent::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.partneragent.index');
    }

}
