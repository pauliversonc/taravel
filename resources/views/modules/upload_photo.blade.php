@extends('admin.layouts.master')

@section('content')

<link rel="stylesheet" href="{{ asset('/css/dropzone.css')}} ">


   <br>
    <div class="portlet box grey-gallery">
        <div class="portlet-title">
        <div class="caption">Upload photo and post in profile</div>
    </div>

    <div class="portlet-body">
        <form action="{{url('/upload/photo')}}" enctype="multipart/form-data" class="dropzone dz-clickable" id="myAwesomeDropzone">
            {{ csrf_field() }}
            <select class="form-control" name="business_id" id="">
            @foreach ($business as $b)
        <option value="{{$b->id}}">{{$b->business_name}}</option>
            @endforeach

        </select>
          <div align="center">
		    <div class="dz-message">Drop files here or click to upload.
	                    <br> <span class="note"><b>Note: </b> <b>(10 MB max file size)</b></span>
            </div></div>
        </form>

    </div>
</div>



<script src="{{asset('js/dropzone.js')}}"></script>
<script type="text/javascript">
Dropzone.options.myAwesomeDropzone = {
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 10, // MB
  acceptedFiles: "image/*",
  addRemoveLinks: true,
  init: function() {
    this.on("addedfile", function(file) {

     });
  }
};

</script>

@endsection


