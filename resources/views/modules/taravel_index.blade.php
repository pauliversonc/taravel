@extends('admin.layouts.master')

@section('content')

<a href="{{url('profile/')}}" type="button" class="btn btn-success">Add new</a>
@if ($business->count())
<br>
    <div class="portlet box grey-gallery">
        <div class="portlet-title">
            <div class="caption">Business</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                <thead>
                    <tr>
                        <th>Bussiness Name</th>

                        <th>Bussiness Address</th>
                        <th>Bussiness website</th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($business as $b)
                        <tr>
                            <td>
                            {{$b->business_name}}
                            </td>
                            <td>
                                {{$b->business_address}}
                            </td>

                            <td>
                                {{$b->business_website}}
                            </td>
                            <td>
                            <a href="{{url('profile/update/'.$b->id)}}" type="button" class="btn btn-xs btn-info">EDIT</a>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-danger" id="delete">
                    </button>
                </div>
            </div>
                <input type="hidden" id="send" name="toDelete">
        </div>
	</div>
@else
@endif

@endsection

@section('javascript')

@stop
