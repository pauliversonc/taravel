<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\CategoryTags;
use App\Http\Requests\CreateCategoryTagsRequest;
use App\Http\Requests\UpdateCategoryTagsRequest;
use Illuminate\Http\Request;
use DB;
use App\Category;


class CategoryTagsController extends Controller {

	/**
	 * Display a listing of categorytags
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $categorytags = CategoryTags::with("category")->get();

		return view('admin.categorytags.index', compact('categorytags'));
	}

	/**
	 * Show the form for creating a new categorytags
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $category = Category::all();
		$btype= DB::table('businesstype')->select('*')->get();

	    return view('admin.categorytags.create')->withBtype($btype)->withCategory($category);
	}

	/**
	 * Store a newly created categorytags in storage.
	 *
     * @param CreateCategoryTagsRequest|Request $request
	 */
	public function store(CreateCategoryTagsRequest $request)
	{

		CategoryTags::create($request->all());

		return redirect()->route(config('quickadmin.route').'.categorytags.index');
	}

	/**
	 * Show the form for editing the specified categorytags.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$categorytags = CategoryTags::find($id);
	    $category = Category::pluck("id", "id")->prepend('Please select', 0);


		return view('admin.categorytags.edit', compact('categorytags', "category"));
	}

	/**
	 * Update the specified categorytags in storage.
     * @param UpdateCategoryTagsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateCategoryTagsRequest $request)
	{
		$categorytags = CategoryTags::findOrFail($id);



		$categorytags->update($request->all());

		return redirect()->route(config('quickadmin.route').'.categorytags.index');
	}

	/**
	 * Remove the specified categorytags from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		CategoryTags::destroy($id);

		return redirect()->route(config('quickadmin.route').'.categorytags.index');
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
            CategoryTags::destroy($toDelete);
        } else {
            CategoryTags::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.categorytags.index');
    }

}
