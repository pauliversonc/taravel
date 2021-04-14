<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\CategoryFilter;
use App\Http\Requests\CreateCategoryFilterRequest;
use App\Http\Requests\UpdateCategoryFilterRequest;
use Illuminate\Http\Request;

use App\Category;


class CategoryFilterController extends Controller {

	/**
	 * Display a listing of categoryfilter
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $categoryfilter = CategoryFilter::with("category")->get();

		return view('admin.categoryfilter.index', compact('categoryfilter'));
	}

	/**
	 * Show the form for creating a new categoryfilter
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $category = Category::pluck("id", "id")->prepend('Please select', 0);

	    
	    return view('admin.categoryfilter.create', compact("category"));
	}

	/**
	 * Store a newly created categoryfilter in storage.
	 *
     * @param CreateCategoryFilterRequest|Request $request
	 */
	public function store(CreateCategoryFilterRequest $request)
	{
	    
		CategoryFilter::create($request->all());

		return redirect()->route(config('quickadmin.route').'.categoryfilter.index');
	}

	/**
	 * Show the form for editing the specified categoryfilter.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$categoryfilter = CategoryFilter::find($id);
	    $category = Category::pluck("id", "id")->prepend('Please select', 0);

	    
		return view('admin.categoryfilter.edit', compact('categoryfilter', "category"));
	}

	/**
	 * Update the specified categoryfilter in storage.
     * @param UpdateCategoryFilterRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateCategoryFilterRequest $request)
	{
		$categoryfilter = CategoryFilter::findOrFail($id);

        

		$categoryfilter->update($request->all());

		return redirect()->route(config('quickadmin.route').'.categoryfilter.index');
	}

	/**
	 * Remove the specified categoryfilter from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		CategoryFilter::destroy($id);

		return redirect()->route(config('quickadmin.route').'.categoryfilter.index');
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
            CategoryFilter::destroy($toDelete);
        } else {
            CategoryFilter::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.categoryfilter.index');
    }

}
