 <!-- partial:partials/_footer.html -->
        
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="{{asset('template/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset('template/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{asset('template/vendors/simplemde/simplemde.min.js') }}"></script>
      <script src="{{asset('template/vendors/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{asset('template/js/editorDemo.js') }}"></script>

  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('template/js/off-canvas.js') }}"></script>
  <script src="{{asset('template/js/hoverable-collapse.js') }}"></script>
  <script src="{{asset('template/js/template.js') }}"></script>
  <script src="{{asset('template/js/settings.js') }}"></script>
  <script src="{{asset('template/js/todolist.js') }}"></script>
    <script src="{{asset('template/vendors/c3/c3.js') }}"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="{{asset('template/js/c3.js')}}"></script>
      <!-- Jquery DataTable Plugin Js -->
    <!-- <script src="{{ asset('assets/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script> -->

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
  
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->


  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="{{asset('template/js/dashboard.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );

 

           
$('#typeannotation').on('change',function(e){
  var saisie =document.getElementById("typeannotation").value;

 
           document.getElementById("commentaire").value=saisie ;

           //  var comment= document.getElementById("commentaire").value+saisie ;
           // document.getElementById("commentaire").value=comment ;
     
            });



        // $("#affecter").click(function() {

         
        //     $('#direction').append("<option > Selectionner</option>");

        //     $.get('/json-direction',function(data){
        //         console.log(data);
            
        //       $.each(data, function(index, directionObj){
                 
        //         $('#direction').append('<option value="'+directionObj.id+'" >'+directionObj.nom  +'</option>');

               
        //     });
            
        //       });

           
        //     $('#employe').append("<option value=''> Selectionner</option>");

        //     });

        $var="<div id='Elementvisible'>"+
        "<p class='mb-2 control-label'>Courrier Visible par SG</p>"+
                      "<label class='toggle-switch'>"+
                       "<input type='checkbox' name='courrierVsg' value='visible' >"+
                        "<span class='toggle-slider round'></span>"+
                      "</label>" +
                      "<p class='mb-2 control-label'>Courrier Visible par Chef Cabinet</p>"+
                      "<label class='toggle-switch'>"+
                       "<input type='checkbox' name='courrierVcfc' value='visible' >"+
                        "<span class='toggle-slider round'></span>"+
                      "</label>"+
                      "</div>" ;

                       $varservice="<div id='Elementvisible'>"+
                       "<p class='mb-2 control-label'>Courrier Visible par SG</p>"+
                      "<label class='toggle-switch'>"+
                       "<input type='checkbox' name='courrierVsg' value='visible' >"+
                        "<span class='toggle-slider round'></span>"+
                      "</label>" +
                      "<p class='mb-2 control-label'>Courrier Visible par Chef Cabinet</p>"+
                      "<label class='toggle-switch'>"+
                       "<input type='checkbox' name='courrierVcfc' value='visible' >"+
                        "<span class='toggle-slider round'></span>"+
                      "</label>"+
                       "<p class='mb-2 control-label'>Courrier Visible par Chef Departement</p>"+
                      "<label class='toggle-switch'>"+
                       "<input type='checkbox' name='courrierVdepartement' value='visible' >"+
                        "<span class='toggle-slider round'></span>"+
                      "</label>"+
                      "</div>" ;

        
            
$('#direction').on('change',function(e){
   $('#Elementvisible').remove();
  
           console.log(e);
            var direction = e.target.value;
            if(direction>3)
            {
              $('#visibleH').append( $var);
            }
            else
            {
              $('#Elementvisible').remove();
            }

            });

$('#service').on('change',function(e){
   $('#Elementvisible').remove();
  
           console.log(e);
            var direction = e.target.value;
            
              $('#visibleH').append( $varservice);

            });

$('#groupe').on('change',function(e){

   $('#Elementvisible').remove();
  
           
              $('#visibleH').append( $var);
            

            });
  </script>

  
<script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>
<script>
CKEDITOR.replace('editor1', {
  fullPage: true,
  extraPlugins: 'docprops',
  // Disable content filtering because if you use full page mode, you probably
  // want to  freely enter any HTML content in source mode without any limitations.
  allowedContent: true,
  height: 320
});
CKEDITOR.replace('editor2', {
  fullPage: true,
  extraPlugins: 'docprops',
  // Disable content filtering because if you use full page mode, you probably
  // want to  freely enter any HTML content in source mode without any limitations.
  allowedContent: true,
  height: 320
});
CKEDITOR.replace('editor3', {
  fullPage: true,
  extraPlugins: 'docprops',
  // Disable content filtering because if you use full page mode, you probably
  // want to  freely enter any HTML content in source mode without any limitations.
  allowedContent: true,
  height: 320
});
</script>