

<div class="sh-footer">
  <div><a href="http://themepixels.me"></a></div>
        <div class="mg-t-10 mg-md-t-0" > Copyright &copy; APIP Guinée 2022. All Rights Reserved. </div>
        
      </div><!-- sh-footer -->
   
<script src=" {{asset('assets/lib/jquery/jquery.js')}} "></script>
    <script src=" {{asset('assets/lib/popper.js/popper.js')}} "></script>
    <script src=" {{asset('assets/lib/bootstrap/bootstrap.js')}} "></script>
    <script src="{{asset('assets/lib/jquery-ui/jquery-ui.js')}} "></script>
    <script src=" {{asset('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}} "></script>
    <script src=" {{asset('assets/lib/moment/moment.js')}} "></script>
    <script src="{{asset('assets/lib/Flot/jquery.flot.js')}} "></script>
    <script src="{{asset('assets/lib/Flot/jquery.flot.resize.js')}} "></script>
    <script src="{{asset('assets/lib/flot-spline/jquery.flot.spline.js')}} "></script>

    <script src=" {{asset('assets/js/shamcey.js')}} "></script>
    <script src=" {{asset('assets/js/dashboard.js')}}"></script>
    <script src=" {{asset('assets/lib/datatables/jquery.dataTables.js')}} "></script>
    <script src=" {{asset('assets/lib/datatables-responsive/dataTables.responsive.js')}} "></script>

     <script src=" {{asset('assets/lib/bootstrap-4.6.1/js/bootstrap.js')}}"></script>
     <script src="{{asset('assets/lib/select2/js/select2.min.js')}}"></script>

    <script src="{{asset('assets/js/shamcey.js')}}"></script>

   <!--   <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script> -->
     <script>
      $(function() {
        'use strict';

        $('#datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });

        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>