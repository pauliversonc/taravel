@extends('admin.layouts.master')

@section('content')

@if(Auth::user()->role_id == 1)
    <h1><b>HELLO ADMINISTRATOR</b></h1>
    <br>
    <h4><b>Admin Panel</b></h4>
    <div style="color:gray; font-size:15px;">
    <ul>
        <li>Users</li>
            <div style="margin-left:5%;">
                    <p><i>ADD NEW</i>. This button is use to add your New user.
                    Fillup all the required fields like email and password.
                    User roles can be change.</p>
                    <p><i>USER LIST</i>. You can see the list of the users here in Taravel.</p>
                    <p><i>EDIT</i>. Change/Update the user information.</p>
                    <p><i>DELETE</i>. Delete user account.</p>
                    <p><i>SEARCH</i>. This an act of looking for specific user names.</p>
            </div>
            <br>
        <li>Tourist Destination</li>
            <div style="margin-left:5%;">
                    <p><i>ADD NEW</i>. This button is use to add your New Tourist Destination.
                    Fillup all the required fields like Coordinates, upload also a good thumbnail.</p>
                    <p><i>TOURIST DESTINATION LIST</i>. You can see the list of the Tourist Destination.</p>
                    <p><i>EDIT</i>. Change/Update the Tourist Destination information.</p>
                    <p><i>DELETE</i>. Delete Tourist Destination.</p>
                    <p><i>SEARCH</i>. This an act of looking for specific Tourist Destination.</p>
            </div>
            <br>
        <li>Things to Do</li>
            <div style="margin-left:5%;">
                <p>This function is to upload post for Things to Do section.</p>
             </div>
             <br>
        <li>Festival and Events</li>
             <div style="margin-left:5%;">
                 <p>This function is to upload post for Festival and Events section.</p>
              </div>
              <br>    
        <li>Upload Things to Do</li>
            <div style="margin-left:5%;">
                <p>This function is to upload image photos to the selected Things to Do event/activity.</p>
             </div>
             <br>
        <li>Upload Photos</li>
            <div style="margin-left:5%;">
                <p>This function is to upload image photos to the selected Tourist Destination.</p>
             </div>
             <br>
        <li>Business Masterlist</li>
             <div style="margin-left:5%;">
                 <p>You can  see the list of the businesses that is posted in the website.</p>
              </div>
        <li>Posts Comment/Rate</li>
              <div style="margin-left:5%;">
                  <p>This is where you can manage Comments/Reviews and Ratings of every posts.</p>
               </div>
               <br>
    </ul>
    </div>

 @endif

 @if(Auth::user()->role_id == 2)
 <h1><b>HELLO BUSINESS OWNER</b></h1>
    <br>
    <h4><b>Business Management</b></h4>
    <div style="color:gray; font-size:15px;">
    <ul>
        <li>Business Profile</li>
            <div style="margin-left:5%;">
                    <p><i>ADD NEW</i>. This button is use to add your business.
                    Fillup all the required fields so that the user can see what does your business have.</p>
                    <p><i>TABLE</i>. You can see the list of your business with its business name, business address, and business website.</p>
                    <p><i>EDIT</i>. Change the information of your business.</p>
                    <p><i>SHOW ENTRIES</i>. This will allow the business owner to see their business by number of rows.</p>
                    <p><i>SEARCH</i>. This an act of looking for specific business(es).</p>
            </div>
            <br>
        <li>Upload Photos</li>
            <div style="margin-left:5%;">
                    <p><i>UPLOAD PHOTOS AND POST IN PROFILE</i>. This allows the user to upload images in business gallery.</p>
            </div>
            <br>  
        <li>Gallery</li>
            <div style="margin-left:5%;">
                <p><i>GALLERY</i>. This will redirect the business owner to the list of business with its gallery.</p>
        </div>    
            
    </ul>
    </div>
    <h4><b>Reports</b></h4>
    <div style="color:gray; font-size:15px;">
    <ul>
            <li>Ratings</li>
            <div style="margin-left:5%;">
                <p><i>Ratings</i>. This will give you rating report of your business .</p>
        </div>    
            <li>Reviews</li>
            <div style="margin-left:5%;">
                <p><i>Reviews</i>. This will give you comment/review report of your business.</p>
            </div>
    </ul>
    </div>
 @endif

 @if(Auth::user()->role_id == 7)
 <h1><b>HELLO TRAVEL AGENT!</b></h1>
 <br>
 <h4><b>Agency</b></h4>
 <div style="color:gray; font-size:15px;">
         <div style="margin-left:5%;">
             <p>This is where you can post and manage your posts.</p>
     </div>    
 
 </div>
 @endif

@endsection