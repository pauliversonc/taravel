<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Agencu;
use Auth;
use App\Http\Requests\CreateAgencuRequest;
use App\Http\Requests\UpdateAgencuRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use DB;

class AgencuController extends Controller {

	/**
	 * Display a listing of agencu
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $agencu = Agencu::select('*')->where('user_id',Auth::user()->id)->whereNull('deleted_at')->get();

		// dd($agencu);
		return view('admin.agencu.index', compact('agencu'));
	}

	/**
	 * Show the form for creating a new agencu
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

        $partner = DB::table('partneragent')->where('user_id',Auth::user()->id)->whereNull('deleted_at')->get();

        return view('admin.agencu.create')
        ->withPartner($partner);
	}

	/**
	 * Store a newly created agencu in storage.
	 *
     * @param CreateAgencuRequest|Request $request
	 */
	public function store(CreateAgencuRequest $request)
	{
	    $request = $this->saveFiles($request);
		Agencu::create($request->all());

		return redirect()->route(config('quickadmin.route').'.agencu.index');
	}

	/**
	 * Show the form for editing the specified agencu.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$agencu = Agencu::find($id);
        $partner = DB::table('partneragent')->where('user_id',Auth::user()->id)->whereNull('deleted_at')->get();
        // dd($agencu);
		return view('admin.agencu.edit', compact('agencu','partner'));
	}

	/**
	 * Update the specified agencu in storage.
     * @param UpdateAgencuRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateAgencuRequest $request)
	{
		$agencu = Agencu::findOrFail($id);

        $request = $this->saveFiles($request);

		$agencu->update($request->all());

		return redirect()->route(config('quickadmin.route').'.agencu.index');
	}

	/**
	 * Remove the specified agencu from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Agencu::destroy($id);

		return redirect()->route(config('quickadmin.route').'.agencu.index');
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
            Agencu::destroy($toDelete);
        } else {
            Agencu::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.agencu.index');
    }

}
