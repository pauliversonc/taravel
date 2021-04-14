<br>
<div  class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu"
            data-keep-expanded="false"
            data-auto-scroll="true"
            data-slide-speed="200">

            @if(Auth::user()->role_id == 3 )
            <script>window.location = "{{url('/')}}";</script>
                @endif

                @if(Auth::user()->is_verified != 1)
                <script>window.location = "{{ url('logout')}}";</script>
                    @endif
            @if(Auth::user()->role_id == '0')
                <li @if(Request::path() == config('quickadmin.route').'/menu') class="active" @endif>
                    <a href="{{ url(config('quickadmin.route').'/menu') }}">
                        <i class="fa fa-list"></i>
                        <span class="title">{{ trans('quickadmin::admin.partials-sidebar-menu') }}</span>
                    </a>
                </li>
                   <li @if(Request::path() == 'roles') class="active" @endif>
                    <a href="{{ url('roles') }}">
                        <i class="fa fa-gavel"></i>
                        <span class="title">{{ trans('quickadmin::admin.partials-sidebar-roles') }}</span>
                    </a>
                </li>
                 @endif
                 @if(Auth::user()->role_id == '1')
                 <li @if(Request::path() == 'roles') class="active" @endif>
                    <a href="{{ url('roles') }}">
                        <i class="fa fa-gavel"></i>
                        <span class="title">{{ trans('quickadmin::admin.partials-sidebar-roles') }}</span>
                    </a>
                </li>
                 @endif
                @if(Auth::user()->role_id == config('quickadmin.defaultRole'))
                <li @if(Request::path() == 'users') class="active" @endif>
                    <a href="{{ url('users') }}">
                        <i class="fa fa-users"></i>
                        <span class="title">{{ trans('quickadmin::admin.partials-sidebar-users') }}</span>
                    </a>
                </li>

                {{-- <li @if(Request::path() == config('quickadmin.route').'/actions') class="active" @endif>
                    <a href="{{ url(config('quickadmin.route').'/actions') }}">
                        <i class="fa fa-users"></i>
                        <span class="title">{{ trans('quickadmin::admin.partials-sidebar-user-actions') }}</span>
                    </a>
                </li> --}}
            @endif
            @foreach($menus as $menu)
                @if(($menu->menu_type != 2  && $menu->id != 3 ) && is_null($menu->parent_id))
                    @if(Auth::user()->role->canAccessMenu($menu))
                        <li @if(isset(explode('/',Request::path())[1]) && explode('/',Request::path())[1] == strtolower($menu->name)) class="active" @endif>
                            <a href="{{ route(config('quickadmin.route').'.'.strtolower($menu->name).'.index') }}">
                                <i class="fa {{ $menu->icon }}"></i>
                                <span class="title">{{ $menu->title }}</span>
                            </a>
                        </li>
                    @endif
                @else
                    @if(Auth::user()->role->canAccessMenu($menu) && !is_null($menu->children()->first()) && is_null($menu->parent_id))
                        <li>
                            <a href="#">
                                <i class="fa {{ $menu->icon }}"></i>
                                <span class="title">{{ $menu->title }}</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                @foreach($menu['children'] as $child)
                                    @if(Auth::user()->role->canAccessMenu($child))
                                        <li
                                                @if(isset(explode('/',Request::path())[1]) && explode('/',Request::path())[1] == strtolower($child->name)) class="active active-sub" @endif>
                                            <a href="{{ route(strtolower(config('quickadmin.route').'.'.$child->name).'.index') }}">
                                                <i class="fa {{ $child->icon }}"></i>
                                                <span class="title">
                                                    {{ $child->title  }}
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endif
            @endforeach
            @if(Auth::user()->role_id == 7)
            <li>
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span class="title">Reports</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu">
                <li class="">
                    <a href="{{ url('/agency/reports/ratings') }}" target="_blank">
                        <i class="fa  fa-sign-in"></i>
                        <span class="title">
                            Ratings
                        </span>
                    </a>
                </li>
            </ul>
        </li>
            @endif
            @if(Auth::user()->role_id ==1)
            <li @if(Request::path() == 'things/upload/photo') class="active" @endif>
                <a href="{{ url('/things/upload/photo') }}">
                    <i class="fa fa-image"></i>
                    <span class="title">
                        Upload Festivals
                    </span>
                </a>
            </li>
            <li @if(Request::path() == 'tourist/upload/photo') class="active" @endif>
                <a href="{{ url('tourist/upload/photo') }}">
                    <i class="fa fa-image"></i>
                    <span class="title">
                        Upload Photos
                    </span>
                </a>
            </li>
            <li @if(Request::path() == 'admin/business_masterlist') class="active" @endif>
                <a href="{{ url('admin/business_masterlist') }}">
                    <i class="fa fa-list"></i>
                    <span class="title">
                       Business Masterlist
                    </span>
                </a>
            </li>
            <li @if(Request::path() == 'admin/postreview') class="active" @endif>
                <a href="{{ url('admin/postreview') }}">
                    <i class="fa fa-gear"></i>
                    <span class="title">
                       Posts Comment/Rate
                    </span>
                </a>
            </li>
            @endif
            @if(Auth::user()->role_id != 1 && Auth::user()->role_id != 7 )
            <li>
                    <a href="#">
                        <i class="fa fa-gears"></i>
                        <span class="title">Bussiness Management</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                    <li class="">
                        <a href="{{ url('profile/add') }}">
                            <i class="fa  fa-sign-in"></i>
                            <span class="title">
                                Business Profile
                            </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('upload') }}">
                            <i class="fa  fa-sign-in"></i>
                            <span class="title">
                                Upload photos
                            </span>
                        </a>
                    </li>
                    <li class="">
                            <a href="{{ url('gallery/'.Auth::user()->id) }}">
                                <i class="fa fa-image"></i>
                                <span class="title">
                                    Gallery
                                </span>
                            </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span class="title">Reports</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu">
                <li class="">
                    <a href="{{ url('reports/ratings') }}" target="_blank">
                        <i class="fa  fa-sign-in"></i>
                        <span class="title">
                            Ratings
                        </span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ url('reports/reviews') }}" target="_blank">
                        <i class="fa  fa-sign-in"></i>
                        <span class="title">
                            Reviews
                        </span>
                    </a>
                </li>
                <li class="">
                        <a href="{{ url('reports/views') }}">
                            <i class="fa  fa-sign-in"></i>
                            <span class="title">
                                Views Stat
                            </span>
                        </a>
                    </li>
            </ul>
        </li>
        <li>
            <a href="{{url('edit/profile')}}">
                <i class="fa fa-gears"></i>
                <span class="title">Edit Profile</span>
                
            </a>
        </li>
            @endif
            <li>
                {{-- {!! Form::open(['url' => 'logout']) !!} --}}
                <button  onclick="sayHello()"  type="submit" class="logout">
                    <i class="fa fa-sign-out fa-fw"></i>
                    <span class="title">{{ trans('quickadmin::admin.partials-sidebar-logout') }}</span>
                </button>
                {{-- {!! Form::close() !!} --}}
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript">
    function sayHello()
    {
        var retVal = confirm("Do you want to logout ?");
        if( retVal == true ){
            window.location = "{{url('logout')}}"
            // return true;
        }else{
            // Document.write ("User does not want to continue!");
            return false;
        }
    //  document.write ("Hello there!");

    }
    </script>
