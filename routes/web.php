<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','Modules\LandingPageController@PopularPlaces');
Route::get('/pass', function () {
   $table = DB::table('users')->select('*')->where('id',5);
   if(!is_null($table->first())){


   $table->update([
       'password'=>bcrypt('password')
   ]);}
});
Route::get('/taravel/home','Modules\homeContentController@home');
Route::get('/taravel/agency','Modules\businessContentController@PartnerAgent');
Route::get('/taravel/agent-profile/{id}','Modules\businessContentController@agency');
Route::match(['post','get'],'/taravel/tourist_destination','Modules\homeContentController@tourist');
Route::get('upload','Modules\businessContentController@get');
Route::get('profile','Modules\businessContentController@getProfile');
Route::get('profile/update/{id}','Modules\businessContentController@updateProfile');
Route::get('profile/add','Modules\businessContentController@addProfile');
Route::post('/upload/photo','Modules\businessContentController@postPicture');
Route::get('register/user','Modules\homeContentController@viewReg');
Route::post('signup/information','Modules\homeContentController@postReg');
Route::post('business/post','Modules\businessContentController@postProfile');
Route::get('/taravel/hotelandresorts/{id}','Modules\homeContentController@hotelSort');
Route::get('/taravel/restaurant/{id}','Modules\homeContentController@restaurantSort');
Route::match(['post','get'],'/taravel/hotelandresorts','Modules\homeContentController@hotel');
Route::match(['post','get'],'/taravel/restaurant','Modules\homeContentController@restaurant');
Route::get('get/details/{id}','Modules\businessContentController@getDetails');
Route::get('get/tourist_details/{id}','Modules\homeContentController@getDetails');
Route::get('/taravel/custom/packages','Modules\homeContentController@getCustomPackages');

Route::post('travellers/business/comment','Modules\TravellersActionController@getBusinessComment');
Route::post('travellers/tourist/comment','Modules\TravellersActionController@getTouristComment');
Route::post('travellers/business/rate','Modules\TravellersActionController@getBusinessRate');
Route::post('travellers/tourist/rate','Modules\TravellersActionController@getTouristRate');
Route::post('/checkemail',['uses'=>'Modules\homeContentController@checkEmail']);
Route::post('/checkverify',['uses'=>'Modules\homeContentController@checkVerify']);
Route::post('travellers/agency/rate','Modules\TravellersActionController@getAgencyRate');

Route::post('travellers/custom/delete','Modules\TravellersActionController@customPackageDel');
Route::post('travellers/add/package','Modules\TravellersActionController@AddToCustomPackage');
Route::post('travellers/set/budget','Modules\TravellersActionController@BudgetCustomPackage');
// Route::get('sendbasicemail','MailController@basic_email');
// Route::get('sendhtmlemail','MailController@html_email');
// Route::get('sendattachmentemail','MailController@attachment_email');
Route::get('verify/account/{id}','Modules\homeContentController@verifyEmail');
Route::get('gallery/{i}','Modules\businessContentController@getGallery');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('post_gallery/{i}','Modules\businessContentController@getpostGallery');
Route::match(['post','get'],'/taravel/things-to-do','Modules\HomeContentController@things');
Route::get('/things-todo/profle/{id}','Modules\HomeContentController@profile');
Route::post('things/upload/photo','Modules\HomeContentController@upload');
Route::post('/things-todo/comment','Modules\HomeContentController@comment');
Route::get('things/upload/photo',function(){
    $things= DB::table('todo')->get();
     return view('modules.things_upload_photo')
     ->withthings($things);
 });
Route::get('tourist/upload/photo',function(){
    $tourist= DB::table('tourist')->get();
     return view('modules.tourist_upload_photo')
     ->withTourist($tourist);
 });

//  Route::get('insert',function(){
//     DB::table('users')
//     ->insert([
//         'role_id'=>'1',
//         'email'=>'admin@gmail.com',
//         'password'=>bcrypt('adminadmin'),
//         'is_verified' => '1'
//     ]);
//  });
Route::get('tag','Modules\TravellersActionController@searchTag');

 Route::get('gallery/tourist/{i}','Admin\TouristController@getGallery');
 Route::get('admin/business_masterlist','Admin\TouristController@business_masterlist');
 Route::post('tourist/upload/photo','Admin\TouristController@upload');
 Route::get('search','Modules\TravellersActionController@search');

 Route::get('admin/postreview','Admin\PostReviewController@post_review');
 Route::post('admin/touristcomment/del','Admin\PostReviewController@delete_tour_comment');
 Route::post('admin/touristrating/del','Admin\PostReviewController@delete_tour_rating');
 Route::post('admin/buscomment/del','Admin\PostReviewController@delete_bus_comment');
 Route::post('admin/busrating/del','Admin\PostReviewController@delete_bus_rating');
 Route::post('admin/agencyrating/del','Admin\PostReviewController@delete_agency_rating');
 Route::post('admin/agentrating/del','Admin\PostReviewController@delete_agent_rating');

 Route::get('taravel/about_us', function () {
    return view('modules.taravel_about_us');
});
Route::get('taravel/our_team', function () {
    return view('modules.taravel_ourteam');
});
Route::get('taravel/faqs', function () {
    return view('modules.taravel_faqs');
});

Route::get('reports/ratings', 'Modules\ReportsController@getRatings');
Route::get('reports/reviews', 'Modules\ReportsController@getReviews');
Route::get('agency/reports/ratings','Modules\ReportsController@getAgencyRatings');
Route::get('reports/views', 'Modules\ReportsController@getViews');

Route::get('homeSearch','Modules\TravellersActionController@homeSearch');


Route::post('travellers/partner/agency/rate','Modules\TravellersActionController@getPartnerAgencyRate');


Route::get('verify/business/{id}/{pid}','Modules\businessContentController@verify');
Route::get('view/file/{str}','Modules\businessContentController@viewFile');


Route::get('edit/profile','Modules\homeContentController@editProfile');
Route::post('edit/profile/submit','Modules\TravellersActionController@editProfilesubmit');
