<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Location;
use App\Http\Requests\CreateLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use Illuminate\Http\Request;



class LocationController extends Controller {

	/**
	 * Display a listing of location
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $location = Location::all();

		return view('admin.location.index', compact('location'));
	}

	/**
	 * Show the form for creating a new location
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.location.create');
	}

	/**
	 * Store a newly created location in storage.
	 *
     * @param CreateLocationRequest|Request $request
	 */
	public function store(CreateLocationRequest $request)
	{
	    
		Location::create($request->all());

		return redirect()->route(config('quickadmin.route').'.location.index');
	}

	/**
	 * Show the form for editing the specified location.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$location = Location::find($id);
	    
	    
		return view('admin.location.edit', compact('location'));
	}

	/**
	 * Update the specified location in storage.
     * @param UpdateLocationRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateLocationRequest $request)
	{
		$location = Location::findOrFail($id);

        

		$location->update($request->all());

		return redirect()->route(config('quickadmin.route').'.location.index');
	}

	/**
	 * Remove the specified location from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Location::destroy($id);

		return redirect()->route(config('quickadmin.route').'.location.index');
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
            Location::destroy($toDelete);
        } else {
            Location::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.location.index');
    }

}
