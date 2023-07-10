@extends('pages.Default')
@section('content')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
   <div class="sh-pagetitle">
        <div class="input-group">
          
        </div><!-- input-group -->
       <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="fa fa-envelope"></i></div>
 <div class="sh-pagetitle-title">
            
            <h2>Parametre</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->

         <!--  <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-cog"></i> Parametre</h3>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{route('home')}}">Accueil</a></li> 
             <li><i class="fa fa-cog"></i>Parametre</li>                
          </ol>
        </div>
      </div> -->
   <div class="sh-pagebody">
    <div class="row">
        <div class="col-lg-12">
          <ol class="breadcrumb">

              <div class="col-sm-6 col-md-2">
              
                <a style="text-decoration:none" href="/dashboard"><button  class="btn btn-outline-primary btn-block">

            <span class="title"></span><i class="fa fa-home"></i> Accueil</button></a>
                
              </div><!-- col-sm -->         
</div></div>

      @foreach ($parametre as $parametres)
     <div class="row">
        
        <!-- <div class="col-md-5 col-sm-5 col-xs-6 col-xxs-12">
          <div class="smallstat red-bg">
            <a href="#" data-toggle="modal" data-target="#ajout"><i class="fa fa-edit white-bg"></i>

            <span class="title">Modifier Session</span></a>
          
          </div>
        </div> --><!--/.col-->

          <!-- modal -->
             <div class="modal fade" id="ajout">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Modification Session</h4>
        </div>
        <div class="modal-body">
         <form action="{{ route ('Parametre.update', $parametres->id)}}" method="post" enctype="multipart/form-data" >
                       {{ csrf_field() }}
                        {{ method_field('PUT') }}
          <p>         <div class="form-group">
                            <label for="textarea-input">Année</label>
                            <div class="">
                               <select name="annee" class="form-control">
                                 <option value="{{$parametres->annee}}">{{$parametres->annee}}</option>
                                 <option value="2020">2020</option>
                                 <option value="2021">2021</option>
                                 <option value="2022">2022</option>
                                 <option value="2023">2023</option>
                                 <option value="2024">2024</option>
                                 <option value="2025">2025</option>
                               </select>
                            </div>
                        </div>

                       

                       

                        

                          </p>
        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button class="btn btn-primary" type=" button submit"><i class="fa fa-trash"></i> Modifier</button>
                        <input type="hidden" name="valide" value="0">
          </form>
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

            <!-- fin modal -->
      </div>


       

       <div class="row">   
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h2><i class="fa fa-table red"></i><span class="break"></span><strong>Session</strong></h2>
              <div class="panel-actions">
                <a href="table.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                <a href="table.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                <a href="table.html#" class="btn-close"><i class="fa fa-times"></i></a>
              </div>
            </div>
            <div class="panel-body">
             
              <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                  <tr style="background: #0b0e69;color: white;">
                   
                    <th>Session en cours</th>
                    <th>Action</th>
                  </tr>
                </thead>   
                <tbody>   
                            
                <tr>
                 
                  <td>{{$parametres->annee}}</td>
                  <td>
                     <a class="btn btn-info" title="Modifier" data-rel="tooltip" href="#" data-toggle="modal" data-target="#ajout"><i class="fa fa-edit"></i></a>
                  </td>
                 
                </tr>
                
                
                </tbody>
              </table>            
            </div>
          </div>
        </div><!--/col-->
      
      </div><!--/row-->

      @endforeach

      <script>
         $(document).ready(function(){
            $("#demo").on("keyup", function() {
               var value = $(this).val().toLowerCase();
               $("#test tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
               });
            });
         });
      </script> 
      
         @stop