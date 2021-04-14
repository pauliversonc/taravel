<script src="{{url('js/jquery-1.11.3.min.js')}}"></script>
{{-- <script src="{{url('js/jquery.min.js')}}"></script> --}}
<script src="{{url('js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('js/jquery-ui.min.js')}}"></script>
<script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
<script src="{{ url('js/jquery-ui-timepicker-addon.min.js')}}"></script>
<script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
<script src="{{ url('quickadmin/js') }}/bootstrap.min.js"></script>
<script src="{{ url('quickadmin/js') }}/main.js"></script>
<script src="{{ url('js/toastr.min.js') }}"></script>
{{-- <script src="{{ url('js/jquery.nestable')}}"></script>

<script src="{{url('js/ui-nestable.js')}}"></script> --}}

<script>
    toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                    };

            $(document).ready(function() {
                @if(session()->has('success'))
                toastr.success('{{ Session::get('success') }}','');
                @endif
                @if(session()->has('error'))
                toastr.error('{{ Session::get('error') }}','');
                @endif
                @if(session()->has('warning'))
                toastr.warning('{{ Session::get('warning') }}','');
                @endif
            });

    $('.datepicker').datepicker({
        autoclose: true,
        dateFormat: "{{ config('quickadmin.date_format_jquery') }}"
    });

    $('.datetimepicker').datetimepicker({
        autoclose: true,
        dateFormat: "{{ config('quickadmin.date_format_jquery') }}",
        timeFormat: "{{ config('quickadmin.time_format_jquery') }}"
    });

    $('#datatable').dataTable( {
        "language": {
            "url": "{{ trans('quickadmin::strings.datatable_url_language') }}"
        }
    });

</script>

