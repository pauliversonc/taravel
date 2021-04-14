@include('admin.partials.header3')
<link href="{{asset('fontawesome/css/all.min.css')}}" rel="stylesheet">
@yield('head')

<div class="clearfix"></div>
<div class="page-container">



    <div class="page-content-wrapper">
        <div class="page-content">

            {{-- <h3 class="page-title">
                {{ preg_replace('/([a-z0-9])?([A-Z])/','$1 $2',str_replace('Controller','',explode("@",class_basename(app('request')->route()->getAction()['controller']))[0])) }}
            </h3> --}}

            {{-- <div class="row">
                <div class="col-md-12"> --}}

                    {{-- @if (Session::has('message'))
                        <div class="note note-info">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                    @endif --}}

                    @yield('content')

                {{-- </div>
            </div> --}}

        </div>
    </div>
</div>

<div class="scroll-to-top"
     style="display: none;">
    <i class="fa fa-arrow-up"></i>
</div>
@include('admin.partials.javascripts3')

@yield('footer')
@yield('javascript')
@include('admin.partials.footer3')


