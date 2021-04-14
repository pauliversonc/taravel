<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use File;
use Session;
use App\Permit;
use Carbon\Carbon;
use App\businessTagsLib;
use App\RegionLib;
use Response;
use Illuminate\Support\Facades\Input;
use App\Region;
class businessContentController extends Controller
{
    //
    public function get(){
        $business = DB::table('business_profile')
        ->where('user_id',Auth::user()->id)
        ->get();

        return view('modules.upload_photo')
        ->withBusiness($business);
    }
    public function postPicture(Request $req){

        $image_filename = $req->file->getClientOriginalName();
        // dd($image_filename);
        $id = Auth::user()->id;
        // dd($id);
        if (!is_null($id)) {
          $profile_image              = $req->file;
        if($profile_image){
            /*Prepares the directory, creates if not existing*/
            $image_folder           = $id;
            $image_path             = public_path().'/business/gallery/'.$image_folder;

            File::isDirectory($image_path) or File::makeDirectory($image_path, 0777,true,true);

            /*Copies the uploaded image to Profile Photos Directory*/

            $profile_image->move($image_path,$req->file->getClientOriginalName());
            $profile_image_path        = '/business/gallery/'.$image_folder."/".$req->file->getClientOriginalName();

            DB::table('business_gallery')->insert(
                [
                'business_profile_id' =>$req->business_id,
                'user_id'=>$id,
                'photo_url'=>$profile_image_path
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

public function getProfile(){

    $categoryTags = DB::table('category as cat')
    ->select('cat.name as cat_name','catT.buss_type as catT_type','cat.id as cat_id','catT.id as catT_id','catT.name as catT_name')
    ->leftJoin('categorytags as catT','catT.category_id','cat.id')
    ->get();
    $category = DB::table('category as cat')
    ->select('cat.*')
    ->get();
    ;

    $tags = DB::table('business_tags_lib')
    ->select("*")
    ->where('user_id',Auth::user()->id)
    ->get();

    $type = DB::table('businesstype')
    ->select('*')
    ->get();

    $region = Region::all();
    // $is_business = DB::table('business_profile')
    // ->where('user_id',Auth::user()->id)
    // ->first();
    // dd($is_business);
    return view('modules.taravel_business_profile')
    ->withCategory($category)
    ->withCategoryTags($categoryTags)
    ->withBusiness(null)
    ->withTags($tags)
    ->withType($type)
    ->withRegion($region);
}
public function updateProfile($id){

    $categoryTags = DB::table('category as cat')
    ->select('cat.name as cat_name','catT.buss_type as catT_type','cat.id as cat_id','catT.id as catT_id','catT.name as catT_name')
    ->leftJoin('categorytags as catT','catT.category_id','cat.id')
    ->get();
    $category = DB::table('category as cat')
    ->select('cat.*')
    ->get();
    ;

    $tags = DB::table('business_tags_lib')
    ->select("*")
    ->where('user_id',Auth::user()->id)
    ->where('business_profile_id',$id)
    ->get();
    // dd($tags);
    $type = DB::table('businesstype')
    ->select('*')
    ->get();
    $is_business = DB::table('business_profile')
    ->where('user_id',Auth::user()->id)
    ->where('id',$id)
    ->first();

    $regLib = RegionLib::where('user_id',Auth::user()->id)
    ->where('business_profile_id',$id)
    ->get();

    $region = Region::all();
    return view('modules.taravel_business_profile')
    ->withCategory($category)
    ->withCategoryTags($categoryTags)
    ->withBusiness( $is_business)
    ->withTags($tags)
    ->withRegion($region)
    ->withRegLib($regLib)
    ->withType($type);
}

public function addProfile(){
    $business = DB::table('business_profile')
    ->where('user_id',Auth::user()->id)
    ->get();
    return view('modules.taravel_index')
    ->withBusiness($business);
}
public function postProfile( businessTagsLib $lib,RegionLib $reg){

    // $is_business = DB::table('business_profile')
    // ->where('user_id',Auth::user()->id)
    // ->first();

    // $id =  DB::table('business_profile')->where('user_id',Auth::user()->id)->first();

    if(request()->update == 'null' ){

    if(!is_null(request()->business_profile)){
        $date =  Carbon::now()->toDateString();

    // $business = DB::table('business_profile')
    // ->where('user_id', Auth::user()->id)
    // ->first();

    $file_folder           = Auth::user()->id;
    $file_path             = public_path().'/business/profile/documents/'.$file_folder;

    File::isDirectory($file_path) or File::makeDirectory($file_path, 0777,true,true);

    $docu = request()->business_profile;
    $ext = pathinfo($docu->getClientOriginalName(),PATHINFO_EXTENSION);

    $document_name          = $docu->getClientOriginalName();

    // $profile_image->move($image_path,$req->file->getClientOriginalName());
    $new_name = request()->business_name.'_profilepic_'.$date.$this->generate_refCode(3).'.'.$ext;
    $docu->move($file_path,$document_name);
    // $docu->rename($file_path,Auth::user()->id);
    // url on database

    rename($file_path.'/'.$document_name ,$file_path.'/'.$new_name);

    $document_url           = '/business/profile/documents/'.$file_folder.'/'.$new_name;

    }else{
        $document_url = '';
    }
   $buss = DB::table('business_profile')
    ->insert([
        'user_id'       =>Auth::user()->id,
         'profile_pic' =>       $document_url,
         'business_type_id' => request()->business_type,
        'business_name' => request()->business_name,
        'business_owner'=> request()->business_owner,
        'business_address'=> request()->business_address,
        'business_zip'=> request()->business_zip,
        'business_city'=> request()->business_city,
        'business_brgy'=> request()->business_brgy,
        'business_landmarks'=> request()->business_landmarks,
        'business_website'  => request()->business_website,
        'business_number'=> request()->business_number,
        'attraction_details' => request()->attraction_details,
        'business_price'  => request()->business_price,
        'lat' => request()->lat,
        'lng' => request()->lng
    ]);

        // dd(request()->attraction_details)

 if(!is_null(request()->category_tags)){


    foreach (request()->category_tags as $key => $cat) {
        $fields = explode('_', $cat);

        $cat = $fields[0];
        $catT = $fields[1];
        DB::table('business_tags_lib')
        ->insert([
            'user_id' => Auth::user()->id,
            'category_id' => $cat,
            'category_tags_id' => $catT,
            'business_id' => request()->business_type,

        ]);
        # code...
    }
}


}
else{

    $buss = DB::table('business_profile')
    ->where('user_id',Auth::user()->id)
    ->where('id', request()->update)
    ;
    $pic = DB::table('business_profile')
    ->where('user_id',Auth::user()->id)
    ->first()
    ;
    if(!is_null(request()->business_profile)){
        $date =  Carbon::now()->toDateString();

    $business = DB::table('business_profile')
    ->where('user_id', Auth::user()->id)
    ->first();

    $file_folder           = Auth::user()->id;
    $file_path             = public_path().'/business/profile/documents/'.$file_folder;

    File::isDirectory($file_path) or File::makeDirectory($file_path, 0777,true,true);

    $docu = request()->business_profile;
    $ext = pathinfo($docu->getClientOriginalName(),PATHINFO_EXTENSION);

    $document_name          = $docu->getClientOriginalName();

    // $profile_image->move($image_path,$req->file->getClientOriginalName());
    $new_name = request()->business_name.'_profilepic_'.$date.$this->generate_refCode(3).'.'.$ext;
    $docu->move($file_path,$document_name);
    // $docu->rename($file_path,Auth::user()->id);
    // url on database

    rename($file_path.'/'.$document_name ,$file_path.'/'.$new_name);

    $document_url           = '/business/profile/documents/'.$file_folder.'/'.$new_name;

    }else{
        $document_url = $pic->profile_pic;
    }

    if(!is_null($buss->first())){



    $buss->update([
        'user_id'       =>Auth::user()->id,
        'profile_pic' =>       $document_url,
       'business_name' => request()->business_name,
       'business_owner'=> request()->business_owner,
       'business_address'=> request()->business_address,
       'business_zip'=> request()->business_zip,
        'business_city'=> request()->business_city,
        'business_brgy'=> request()->business_brgy,
        'business_landmarks'=> request()->business_landmarks,
       'business_type_id' => request()->business_type,
       'business_website'  => request()->business_website,
       'business_number'=> request()->business_number,
       'attraction_details' =>request()->attraction_details,
       'business_price'  => request()->business_price,
       'lat' => request()->lat,
       'lng' => request()->lng
    ]);

    }
    $lib->where('user_id','=',Auth::user()->id)->where('business_profile_id','=',request()->update)->delete();
    if(!empty(request()->category_tags)){

        foreach (request()->category_tags as $key => $cat) {
            $fields = explode('_', $cat);

            $cat = $fields[0];
            $catT = $fields[1];

            DB::table('business_tags_lib')
            ->insert([
                'user_id' => Auth::user()->id,
                'category_id' => $cat,
                'category_tags_id' => $catT,
                'business_id' => request()->business_type,
                'business_profile_id' => request()->update
            ]);
            # code...
        }

    }
    // dd(request()->region);
    $reg->where('user_id','=',Auth::user()->id)->where('business_profile_id','=',request()->update)->delete();
    if(!is_null(request()->region)){
        foreach (request()->region as $value) {


            $regionLib = new RegionLib();
            $regionLib->user_id = Auth::user()->id;
            $regionLib->region_id =$value;
            $regionLib->business_profile_id = request()->update;
            $regionLib->save();
        }
    }

}

Session::flash('success','Save Succeccfully');
return redirect()->back();

}
public function generate_refCode($length) {
    $random = '';
    for ($i = 0; $i < $length; $i++) {
        $random .= chr(rand(ord('a'), ord('z')));
    }
    return $random;
}

public function getDetails($id){
    $user = Auth::user();
    $user_id = null;
        if($user){
           $user_id = $user->id;
        }
        DB::table('views')
            ->insert([
            'place_id'=>$id,
            'user_id'=>$user_id,
            'lib_place_type_id'=>1,
            'date'=>date(now()),
        ]);

    $details = DB::table('business_profile')
    ->select('*')
    ->where('id',$id)
    ->first();
    $comments = DB::table('comment_business as cb')
    ->select('cb.*','upi.*')
    ->where('post_id',$id)
    ->leftJoin('user_personal_information as upi','upi.user_id','=','cb.user_id')
    ->get();
    $rates = DB::table('rate_business as rb')
    ->select('rb.*','rb.user_id as rate_user_id')
    ->where('rb.post_id',$id)
    // ->leftJoin('user_personal_information as upi','upi.user_id','=','rb.user_id')
    ->get();
    // dd($rates);
    $check = DB::table('business_profile')
    ->select('*')
    ->where('id','!=',$id)
    ->get();
    if(count($check)>=4){
        $suggested = DB::table('business_profile')
        ->select('*')
        ->where('id','!=',$id)
        ->get()
        ->random(4);
    }else{
        $suggested = DB::table('business_profile')
        ->select('*')
        ->where('id','!=',$id)
        ->get()
        ->random(count($check));
    }
    // $rand = array();
    // $rand[0]=rand(1,$suggested->count());
    // $rand[1]=rand(2,$suggested->count());
    // $rand[2]=rand(3,$suggested->count());
    // $rand[3]=rand(4,$suggested->count());
    //     if($suggested->count()>0){
    // while($rand[0]==$rand[1] || $rand[0]==$rand[2] ||$rand[0]==$rand[3] || $rand[1]==$rand[2] || $rand[1]==$rand[3]|| $rand[2]==$rand[3]){
    //     $rand[0]=rand(1,$suggested->count());
    //     $rand[1]=rand(2,$suggested->count());
    //     $rand[2]=rand(3,$suggested->count());
    //     $rand[3]=rand(4,$suggested->count());
    // }
    //     }
        $tags=DB:: table('business_tags_lib as bt')
        ->where('bt.business_profile_id','=',$id)
        ->leftJoin('categorytags as ct', 'ct.id', 'bt.category_tags_id')
                ->get();
        // dd($suggested);
        // dd($details);
        return view('modules.taravel_details')
    ->withDetails($details)
    ->withComments($comments)
    ->withRates($rates)
    // ->withRand($rand)
    ->withTags($tags)
    ->withSuggested($suggested);
}
public function getGallery($i){

    $gallery = DB::table('business_gallery')
    ->where('user_id',$i)
    ->get();

    $business = DB::table('business_profile')
    ->where('user_id',$i)
    ->get();

    if(is_null($business) || is_null($gallery)){
        Session::flash('error','Please update your business profile and upload photos to your gallery!');
        return back();
    }

    return view('modules.taravel_business_gallery')
    ->withBusiness($business)
    ->withGallery($gallery);
}

public function getpostGallery($i){

    $gallery = DB::table('business_gallery')
    ->where('business_profile_id',$i)
    ->get();

    $buss = DB::table('business_profile')
    ->where('id',$i)
    ->first();
    // dd($buss);
    return view('modules.taravel_business_post_gallery')
    ->withBuss($buss)
    ->withGallery($gallery);
}
public function agency($id){
    $details = DB::table('agencu')
        ->select('*')
        ->where('partner_id',$id)
        ->paginate(4);
    $partner= DB::table('partneragent')
    ->select('*')
    ->where('id','=',$id)
    ->get();
// dd($partner);
    if(!empty(Auth::user()->id)){
        $rates = DB::table('rate_agency')
        ->where('user_id',Auth::user()->id)
        ->get();
        $agentrate = DB::table('rate_partner_agent')
        ->where('user_id',Auth::user()->id)
        ->get();
    }
    else{
        $rates = DB::table('rate_agency')
        ->select('*')
        ->get();
        $agentrate = DB::table('rate_partner_agent')
        ->select('*')
        ->get();
    }
    $aveAgentrate = DB::table('rate_partner_agent as rpa')
    ->select([
        'rpa.partneragent_id',DB::raw("IFNULL(sum(rpa.rate)/count(rpa.partneragent_id),0) as total")
    ])
    ->where( 'rpa.partneragent_id','=',$id)
    ->groupBy('rpa.partneragent_id')
    ->orderBy('total', 'desc')
    ->get();
    // dd($aveAgentrate);
    $popagency = DB::table('rate_agency as rt')
    ->select([
        'rt.post_id',DB::raw("IFNULL(sum(rt.rate)/count(rt.post_id),0) as total")
    ])
    ->groupBy('rt.post_id')
    ->orderBy('total', 'desc')
    ->get();
    // dd($popagency);
    // dd($details);
   return view('modules.taravel_agency')
   ->withAgentrate($agentrate)
   ->withAveAgentrate($aveAgentrate)
   ->withAgency($details)
   ->withPartner($partner)
   ->withRates($rates)
   ->withPopagency($popagency);
}
public function partnerAgent(){

    $partner= DB::table('partneragent')->select('*')->get();
    // dd($partner);
    return view('modules.taravel_agency_partner')
    ->withPartner($partner);
}
public function verify($id,$p_id){
    DB::table('business_profile')
            ->where('id',$id)

            ->update([
            'is_verified' => 1,
        ]);
        $res=Permit::where('id',$p_id)->delete();
        Session::flash('success','Verified');
        return redirect()->back();
}
public function viewFile($str){
    $files =  public_path('/uploads/'.$str);
    // dd($pathToFile);

    $file = File::get($files);

    $response = Response::make($file, 200);
    $response->header('Content-Type', 'application/pdf');
    return $response;
        // return response()->file( $files);
//         return response()->file($pathToFile, $headers);
}
}
