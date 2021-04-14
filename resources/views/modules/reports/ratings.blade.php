
@extends('admin.layouts.master')

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@section('content')


 <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Business Name</th>
                <th>Business Address</th>
                <th>Rated by</th>
                <th>Rate</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ratings as $r)
            <tr>
                <td>{{$r->business_name}}</td>
                <td>{{$r->business_address}}</td>
                <td>{{$r->name}}</td>
                <td>{{$r->rate}}</td>
                <td>{{$r->date}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@section('javascript')
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        var logo ="{!!asset('storage/taravel_header.png')!!}";

     //$('#example').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');
     $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
         'copy',
         {
             extend: 'csv',
             title: 'Taravel Ratings',
             messageTop: 'The information in this table is copyright to Taravel',
         },
         {
             extend: 'excel',
             title: 'Taravel Ratings',
             messageTop: 'The information in this table is copyright to Taravel',
         },
         {
             extend: 'pdf',
             title: 'Taravel Ratings',
             messageTop: 'The information in this table is copyright to Taravel',
         },
         {
             extend: 'print',
             title: 'Ratings',
             messageTop: 'The information in this table is copyright to Taravel',
             customize: function ( win ) {
                 $(win.document.body)
                     .css( 'font-size', '10pt' )
                     .prepend(
                         '<img src="'+logo+'" style="top:0; left:0;width:7.5in;height:.5in;"  />'
                     );

                 $(win.document.body).find( 'table' )
                     .addClass( 'compact' )
                     .css( 'font-size', 'inherit' );
             }
        }
 ]
} );
} );
</script>
@endsection
