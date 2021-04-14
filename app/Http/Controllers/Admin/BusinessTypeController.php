<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\BusinessType;
use App\Http\Requests\CreateBusinessTypeRequest;
use App\Http\Requests\UpdateBusinessTypeRequest;
use Illuminate\Http\Request;



class BusinessTypeController extends Controller {

	/**
	 * Display a listing of businesstype
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $businesstype = BusinessType::all();

		return view('admin.businesstype.index', compact('businesstype'));
	}

	/**
	 * Show the form for creating a new businesstype
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{


	    return view('admin.businesstype.create');
	}

	/**
	 * Store a newly created businesstype in storage.
	 *
     * @param CreateBusinessTypeRequest|Request $request
	 */
	public function store(CreateBusinessTypeRequest $request)
	{

		BusinessType::create($request->all());

		return redirect()->route(config('quickadmin.route').'.businesstype.index');
	}

	/**
	 * Show the form for editing the specified businesstype.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$businesstype = BusinessType::find($id);


		return view('admin.businesstype.edit', compact('businesstype'));
	}

	/**
	 * Update the specified businesstype in storage.
     * @param UpdateBusinessTypeRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateBusinessTypeRequest $request)
	{
		$businesstype = BusinessType::findOrFail($id);



		$businesstype->update($request->all());

		return redirect()->route(config('quickadmin.route').'.businesstype.index');
	}

	/**
	 * Remove the specified businesstype from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		BusinessType::destroy($id);

		return redirect()->route(config('quickadmin.route').'.businesstype.index');
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
            BusinessType::destroy($toDelete);
        } else {
            BusinessType::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.businesstype.index');
    }



}
