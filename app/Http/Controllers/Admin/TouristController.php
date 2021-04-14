<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use File;
use DB;
use App\Tourist;
use App\Http\Requests\CreateTouristRequest;
use App\Http\Requests\UpdateTouristRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\CategoryTags;
use App\Region;
use Auth;
use App\TourRegion;
class TouristController extends Controller {

	/**
	 * Display a listing of tourist
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $tourist = Tourist::with("categorytags")->get();


		return view('admin.tourist.index', compact('tourist'));
    }
    public function business_masterlist()
    {
        $business = DB::table('business_profile as bp')
        ->select("bp.*",'btype.name as type','usr.email as usr_email')
        ->leftJoin('users as usr','usr.id','bp.user_id')
        ->leftJoin('businesstype as btype','btype.id','bp.business_type_id')
        ->get();
        return view('admin.tourist.business_masterlist')
        ->withBusiness($business);
	}

	/**
	 * Show the form for creating a new tourist
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
        $categorytags = CategoryTags::whereIn('category_id',[6,7,8])->pluck("name", "id")->prepend('Please select', 0);
        $region =   Region::all();
	    return view('admin.tourist.create', compact("categorytags","region"));
	}

	/**
	 * Store a newly created tourist in storage.
	 *
     * @param CreateTouristRequest|Request $request
	 */
	public function store(CreateTouristRequest $request)
	{

	    $request = $this->saveFiles($request);
        $tour = Tourist::create($request->all());
        if(!is_null(request()->region)){
        foreach (request()->region as $key => $value) {
            DB::table('tourist_region')
            ->insert([
                'user_id' => Auth::user()->id,
                'region_id'=>$value,
                'tourist_id'=>$tour->id
            ]);
        }
    }
		return redirect()->route(config('quickadmin.route').'.tourist.index');
	}

	/**
	 * Show the form for editing the specified tourist.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$tourist = Tourist::find($id);
	    $categorytags = CategoryTags::whereIn('category_id',[6,7,8])->pluck("name", "id")->prepend('Please select', 0);

        $region =   Region::all();
        $regions = DB::table('tourist_region')->where('tourist_id',$id)->get();

		return view('admin.tourist.edit', compact('tourist', "categorytags",'region','regions'));
	}

	/**
	 * Update the specified tourist in storage.
     * @param UpdateTouristRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateTouristRequest $request,TourRegion $tour)
	{

		$tourist = Tourist::findOrFail($id);

        $request = $this->saveFiles($request);

        $tourist->update($request->all());

        $tour->where('user_id','=',Auth::user()->id)->where('tourist_id','=',$id)->delete();

if(!is_null(request()->region)){
        foreach (request()->region as $key => $value) {
            DB::table('tourist_region')
            ->insert([
                'user_id' => Auth::user()->id,
                'region_id'=>$value,
                'tourist_id'=>$id
            ]);
        }}
		return redirect()->route(config('quickadmin.route').'.tourist.index');
	}

	/**
	 * Remove the specified tourist from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Tourist::destroy($id);

		return redirect()->route(config('quickadmin.route').'.tourist.index');
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
            Tourist::destroy($toDelete);
        } else {
            Tourist::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.tourist.index');
    }


    public function upload(Request $req){
        $image_filename = $req->file->getClientOriginalName();
        // dd($image_filename);
        $id = $req->tour_d;
        // dd($id);
        if (!is_null($id)) {
          $profile_image              = $req->file;
        if($profile_image){
            /*Prepares the directory, creates if not existing*/
            $image_folder           = $id;
            $image_path             = public_path().'/tourist/gallery/'.$image_folder;

            File::isDirectory($image_path) or File::makeDirectory($image_path, 0777,true,true);

            /*Copies the uploaded image to Profile Photos Directory*/

            $profile_image->move($image_path,$req->file->getClientOriginalName());
            $profile_image_path        = '/tourist/gallery/'.$image_folder."/".$req->file->getClientOriginalName();

            DB::table('tourist_gallery')->insert(
                [
                'tourist_id' => $id,
                'photo_url' => $profile_image_path
                ]
            );
                }
        return response()->json(array(
            'code'      =>  200,
            'filename'   =>  $image_filename
        ), 200);
        }

        //else null
        else{
                return response()->json(array(
            'code'      =>  500,
            'filename'   =>  $image_filename
        ), 500);
        }
    }
    public function getGallery($id){
        $gallery = DB::table('tourist_gallery')
        ->where('tourist_id',$id)
        ->get();
        $tourist = DB::table('tourist')
        ->where('id',$id)
        ->first();
        // dd($gallery);
        return view('modules.tourist_gallery')
        ->withTourist($tourist)
        ->withGallery($gallery);
    }
}
