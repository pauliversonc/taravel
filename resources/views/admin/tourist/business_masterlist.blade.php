@extends('admin.layouts.master')

@section('content')


@if ($business->count())
    <div class="portlet box grey-gallery">
        <div class="portlet-title">
            <div class="caption">List of Businesses</div>
        </div>
        <div class="portlet-body" style="overflow:auto;">
            <table class="table table-striped table-hover table-responsive  datatable" id="datatables"">
                <thead>
                    <tr>

<th nowrap>Name</th>
<th nowrap>Email</th>
<th nowrap>Owner</th>
<th nowrap>Type</th>
<th nowrap>status</th>
<th nowrap>Address</th>
<th nowrap>Landmarks</th>
<th nowrap>Zip Code</th>
<th nowrap>Latitude</th>
<th nowrap>Longitude</th>
<th nowrap>Website</th>
<th nowrap>Number</th>
<th nowrap>Attraction Details</th>
<th nowrap>Photo</th>

                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($business as $row)
                        <tr>

<td nowrap>{{ $row->business_name }}</td>
<td nowrap>{{ $row->usr_email }}</td>
<td nowrap>{{ $row->business_owner }}</td>
<td nowrap>{{ $row->type }}</td>
<td nowrap>@if (!is_null($row->is_verified))
    <span class="badge badge-success">Verified</span>
    @else
    <span class="badge badge-warning">Pending</span>
    @endif
</td>
<td nowrap>{{ $row->business_address }},{{$row->business_brgy}},{{ $row->business_city }}</td>
<td nowrap>{{ $row->business_landmarks }}</td>
<td nowrap>{{ $row->business_zip }}</td>
<td nowrap>{{ $row->lat }}</td>
<td nowrap>{{ $row->lng }}</td>
<td nowrap>{{ $row->business_website }}</td>
<td nowrap>{{ $row->business_number }}</td>
<td nowrap>{!! str_limit($row->attraction_details, $limit = 150, $end = '...') !!}</td>
<td nowrap>@if($row->profile_pic != '')<img src="{{ asset('uploads/thumb') . '/'.  $row->profile_pic }}">@endif</td>


                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
	</div>
@else
    {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
@endif

@endsection

