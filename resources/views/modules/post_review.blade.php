@extends('admin.layouts.master')

@section('content')


    <div class="portlet box grey-gallery">
        <div class="portlet-title">
            <div class="caption">List of Comments in Tourist Destination</div>
        </div>
        <div class="portlet-body" style="overflow:auto;">
            <table  class="table table-striped table-hover table-responsive">
                <thead>
                    <tr>
                <th nowrap>No.</th>
                <th nowrap>Name</th>
                <th nowrap>Comment</th>
                <th nowrap>User</th>
                <th nowrap>Date</th>
                <th nowrap>Action</th>

                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                        @if ($tourcomment->count()>0)
                        @php $count=1; @endphp
                    @foreach ($tourcomment as $row)
                        <tr>
                            <form action="{{url('admin/touristcomment/del')}}" method="POST" >
                                {{ csrf_field() }}
                            <input type="hidden" value="{{$row->ct_id}}" name="ct_id">
                            <td nowrap>{{ $count++ }}</td>
                            <td nowrap>{{ $row->name }}</td>
                            <td nowrap>{{ $row->comment }}</td>
                            @php
                                $user=DB::table('users')->where('id',$row->user)->get();
                            @endphp
                            <td nowrap>{{ $user[0]->name}}</td>
                            <td nowrap>{{$row->date}}</td>
                            <td nowrap><button type="submit" class="btn btn-danger btn-xs">delete</button></td>
                            </form>
                           
                        </tr>
                    @endforeach
                    @else
                        {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
                    @endif
                </tbody>
            </table>
        
        </div>
	</div>



    <div class="portlet box grey-gallery">
        <div class="portlet-title">
            <div class="caption">Rating of Tourist Destination</div>
        </div>
        <div class="portlet-body" style="overflow:auto;">
            <table  class="table  table-striped table-hover table-responsive">
                <thead>
                    <tr>
                <th nowrap> No. </th>
                <th nowrap>Name</th>
                <th nowrap>Rating</th>
                <th nowrap>User</th>
                <th nowrap>Date</th>
                <th nowrap>Action</th>

                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                        @if ($tourrate->count()>0)
                    @php $count=1; @endphp
                    @foreach ($tourrate as $row)
                        <tr>
                            <form action="{{url('admin/touristrating/del')}}" method="POST" >
                                {{ csrf_field() }}
                            <input type="hidden" value="{{$row->rt_id}}" name="rt_id">
                            <td nowrap>{{ $count++ }}</td>
                            <td nowrap>{{ $row->name }}</td>
                            <td nowrap>{{ $row->rate }}</td>
                            @php
                            $user=DB::table('users')->where('id',$row->user)->get();
                            @endphp
                        <td nowrap>{{ $user[0]->name}}</td>
                            <td nowrap>{{ $row->date }}</td>
                            <td nowrap><button type="submit" class="btn btn-danger btn-xs">delete</button></td>
                            </form>
                           
                        </tr>
                    @endforeach
                    @else
                        {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
                    @endif
                </tbody>
            </table>
        
        </div>
	</div>




    <div class="portlet box grey-gallery">
        <div class="portlet-title">
            <div class="caption">List of Comments in Business</div>
        </div>
        <div class="portlet-body" style="overflow:auto;">
            <table class="table  table-striped table-hover table-responsive">
                <thead>
                    <tr>
                <th nowrap>No.</th>
                <th nowrap>Name</th>
                <th nowrap>Comment</th>
                <th nowrap>User</th>
                <th nowrap>Date</th>
                <th nowrap>Action</th>

                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                        @if ($buscomment->count()>0)
                        @php $count=1; @endphp
                    @foreach ($buscomment as $row)
                        <tr>
                            <form action="{{url('admin/buscomment/del')}}" method="POST" >
                                {{ csrf_field() }}
                            <input type="hidden" value="{{$row->cb_id}}" name="cb_id">
                            <td nowrap>{{ $count++ }}</td>
                            <td nowrap>{{ $row->business_name }}</td>
                            <td nowrap>{{ $row->comment }}</td>
                            @php
                            $user=DB::table('users')->where('id',$row->user)->get();
                            @endphp
                        <td nowrap>{{ $user[0]->name}}</td>
                            <td nowrap>{{$row->date}}</td>
                            <td nowrap><button type="submit" class="btn btn-danger btn-xs">delete</button></td>
                            </form>
                           
                        </tr>
                    @endforeach
                    @else
                            {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
                        @endif
                </tbody>
            </table>
        
        </div>
	</div>



    <div class="portlet box grey-gallery">
        <div class="portlet-title">
            <div class="caption">Rating of Business</div>
        </div>
        <div class="portlet-body" style="overflow:auto;">
            <table class="table table-striped table-hover table-responsive">
                <thead>
                    <tr>
                <th nowrap> No. </th>
                <th nowrap>Name</th>
                <th nowrap>Rating</th>
                <th nowrap>User</th>
                <th nowrap>Date</th>
                <th nowrap>Action</th>

                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                        @if ($busrate->count()>0)
                    @php $count=1; @endphp
                    @foreach ($busrate as $row)
                        <tr>
                            <form action="{{url('admin/busrating/del')}}" method="POST" >
                                {{ csrf_field() }}
                            <input type="hidden" value="{{$row->rb_id}}" name="rb_id">
                            <td nowrap>{{ $count++ }}</td>
                            <td nowrap>{{ $row->business_name }}</td>
                            <td nowrap>{{ $row->rate }}</td>
                            @php
                            $user=DB::table('users')->where('id',$row->user)->get();
                            @endphp
                            <td nowrap>{{ $user[0]->name}}</td>
                            <td nowrap>{{ $row->date }}</td>
                            <td nowrap><button type="submit" class="btn btn-danger btn-xs">delete</button></td>
                            </form>
                           
                        </tr>
                    @endforeach
                    
                    @else
                    {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
                    @endif
                </tbody>
            </table>
        
        </div>
	</div>


    <div class="portlet box grey-gallery">
        <div class="portlet-title">
            <div class="caption">Rating of Agency Packages</div>
        </div>
        <div class="portlet-body" style="overflow:auto;">
            <table class="table table-striped table-hover table-responsive">
                <thead>
                    <tr>
                <th nowrap> No. </th>
                <th nowrap>Name</th>
                <th nowrap>Rating</th>
                <th nowrap>User</th>
                <th nowrap>Date</th>
                <th nowrap>Action</th>

                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                        @if ($agencyrate->count()>0)
                    @php $count=1; @endphp
                    @foreach ($agencyrate as $row)
                        <tr>
                            <form action="{{url('admin/agencyrating/del')}}" method="POST" >
                                {{ csrf_field() }}
                            <input type="hidden" value="{{$row->ra_id}}" name="ra_id">
                            <td nowrap>{{ $count++ }}</td>
                            <td nowrap>{{ $row->name }}</td>
                            <td nowrap>{{ $row->rate }}</td>
                            @php
                            $user=DB::table('users')->where('id',$row->user)->get();
                            @endphp
                            <td nowrap>{{ $user[0]->name}}</td>
                            <td nowrap>{{ $row->date }}</td>
                            <td nowrap><button type="submit" class="btn btn-danger btn-xs">delete</button></td>
                            </form>
                           
                        </tr>
                    @endforeach
                    @else
                        {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
                    @endif
                </tbody>
            </table>
        
        </div>
	</div>



    <div class="portlet box grey-gallery">
        <div class="portlet-title">
            <div class="caption">Rating of Agency Packages</div>
        </div>
        <div class="portlet-body" style="overflow:auto;">
            <table class="table table-striped table-hover table-responsive">
                <thead>
                    <tr>
                <th nowrap> No. </th>
                <th nowrap>Name</th>
                <th nowrap>Rating</th>
                <th nowrap>User</th>
                <th nowrap>Date</th>
                <th nowrap>Action</th>

                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                        @if ($agentrate->count()>0)
                    @php $count=1; @endphp
                    @foreach ($agentrate as $row)
                        <tr>
                            <form action="{{url('admin/agentrating/del')}}" method="POST" >
                                {{ csrf_field() }}
                            <input type="hidden" value="{{$row->rpa_id}}" name="rpa_id">
                            <td nowrap>{{ $count++ }}</td>
                            <td nowrap>{{ $row->name }}</td>
                            <td nowrap>{{ $row->rate }}</td>
                            @php
                            $user=DB::table('users')->where('id',$row->user)->get();
                            @endphp
                            <td nowrap>{{ $user[0]->name}}</td>
                            <td nowrap>{{ $row->date }}</td>
                            <td nowrap><button type="submit" class="btn btn-danger btn-xs">delete</button></td>
                            </form>
                           
                        </tr>
                    @endforeach
                    @else
                        {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
                    @endif
                </tbody>
            </table>
        
        </div>
	</div>




@endsection

