<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Festival;
use App\Http\Requests\CreateFestivalRequest;
use App\Http\Requests\UpdateFestivalRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use DB;

class FestivalController extends Controller {

	/**
	 * Display a listing of festival
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $festival = Festival::all();

		return view('admin.festival.index', compact('festival'));
	}

	/**
	 * Show the form for creating a new festival
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
       $fest =  DB::table('todo')
        ->select('*')
        ->get();
        // dd($fest);
        return view('admin.festival.create')
        ->withFestival($fest);
	}

	/**
	 * Store a newly created festival in storage.
	 *
     * @param CreateFestivalRequest|Request $request
	 */
	public function store(CreateFestivalRequest $request)
	{
	    $request = $this->saveFiles($request);
		Festival::create($request->all());

		return redirect()->route(config('quickadmin.route').'.festival.index');
	}

	/**
	 * Show the form for editing the specified festival.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$festival = Festival::find($id);


		return view('admin.festival.edit', compact('festival'));
	}

	/**
	 * Update the specified festival in storage.
     * @param UpdateFestivalRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFestivalRequest $request)
	{
		$festival = Festival::findOrFail($id);

        $request = $this->saveFiles($request);

		$festival->update($request->all());

		return redirect()->route(config('quickadmin.route').'.festival.index');
	}

	/**
	 * Remove the specified festival from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Festival::destroy($id);

		return redirect()->route(config('quickadmin.route').'.festival.index');
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
            Festival::destroy($toDelete);
        } else {
            Festival::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.festival.index');
    }

}
