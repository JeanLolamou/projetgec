@extends('pages.Default')
@section('content')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->

  <div class="sh-pagetitle">
        <div class="input-group">
          
        </div><!-- input-group -->
       <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="icon ion-clipboard"></i></div>
 <div class="sh-pagetitle-title">
            
            <h2>Compte Rendu</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->
  
 <div class="sh-pagebody">
              <!--  <div class="card-header bg-info tx-white" >Compte Rendu</div> -->   

          <div class="row">
        <div class="col-lg-12  ">
          
          <ol class="breadcrumb">
            <div class="col-sm-6 col-md-2 ">
              
                <a style="text-decoration:none" href="/dashboard"><button  class="btn btn-outline-primary btn-block">

            <span class="title"></span><i class="fa fa-home"></i> Accueil</button></a>
                
              </div><!-- col-sm -->

               @if((Auth::user()->user_role==1)||(Auth::user()->user_role==8)||(Auth::user()->user_role==9))
              <div class="smallstat red-bg">
            <a style="text-decoration:none" href="#" data-toggle="modal" data-target="#ajout"><button  class="btn btn-outline-primary btn-block">

            <i class="fa fa-plus white-bg"></i> <span class="title">Créer un CR</span></button></a>   
          
          </div><!--/.smallstat-->
@endif
          
                          
          </ol>
        </div>
      </div>
     <div class="row">
        
       

          <!-- modal -->
             <div class="modal fade" id="ajout">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">Création CR</h4> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
        <form method="POST" action="ajoutreunion" enctype="multipart/form-data">
                        @csrf
          <p>         <div class="form-group">
                            <label for="textarea-input">Libelle</label>
                            <div class="">
                               <input type="text" name="libelle" class="form-control" value="" required>
                            </div>
                        </div>

                       

                        <div class="form-group">
                            <label for="textarea-input">Date de la reunion</label>
                            <div class="">
                               <input type="date" name="date" class="form-control" value="" required>
                            </div>
                        </div>
                           <div class="form-group">
                            <label for="textarea-input">Debut séance</label>
                            <div class="">
                               <input type="time" name="debut_seance" class="form-control" value="" required>
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="textarea-input">Levée séance</label>
                            <div class="">
                               <input type="time" name="leve_seance" class="form-control" value="" required>
                            </div>
                        </div>

                          </p>
        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button class="btn btn-primary" type=" button submit"><i class="fa fa-trash"></i> Ajouter</button>
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
             <!--  <h2><i class="fa fa-table red"></i><span class="break"></span><strong>Reunions</strong></h2> -->
             <!--  <div class="panel-actions">
                <a href="table.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                <a href="table.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                <a href="table.html#" class="btn-close"><i class="fa fa-times"></i></a>
              </div> -->
            </div>
            <div class="panel-body">
             <div class="table-responsive mg-t-25">

                           <table id="datatable1" class="table display responsive nowrap">
                <thead class="bg-info">
                  <tr style="background: #0b0e69;color: white;">
                    <th>Reunions</th>
                    <th>Date</th>
                    <th>Debut Séance</th>
                    <th>Levée Séance</th>
                    <th>Actions</th>
                  </tr>
                </thead>   
                <tbody>   
                 @foreach ($reunion as $reunions)            
                <tr>
                  <td>{{$reunions->libelle}}</td>
                  <td>{{(new DateTime($reunions->date))->format("d/m/Y")}}</td>
                  <td>{{$reunions->debut_seance}}</td>
                  <td>{{$reunions->leve_seance}}</td>
                  <td>
                    <a target="_blank" class="btn btn-success" href="{{route('pdfreunion',[$reunions->id])}}" title="Details" data-rel="tooltip">
                      <i class="fa fa-search-plus "></i>                                            
                    </a>
                   @if((Auth::user()->user_role==1)||(Auth::user()->user_role==8)||(Auth::user()->user_role==9))
                     <a class="btn btn-warning" href="{{ route ('parametrerReunion', $reunions->id)}}" title="Parametrer" data-rel="tooltip">
                      <i class="fa fa-plus"></i>                                            
                    </a>

                    <a class="btn btn-info" href="{{ route ('editReunion', $reunions->id)}}" title="Modifier" data-rel="tooltip">
                      <i class="fa fa-edit "></i>                                            
                    </a>
                    <a class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$reunions->id}}" title="Supprimer" data-rel="tooltip">
                      <i class="fa fa-trash-o " style="color: white;"></i> 
                    </a>
                    @endif
                     <!-- Suppression -->

                    <div class="modal fade" id="myModal{{$reunions->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Voulez-vous vraiment supprimer cet element ?</h4>
        </div>
        <div class="modal-body">
          <p>Cliquer sur SUPPRIMER si c'est le cas !</p>
        </div>
        <div class="modal-footer">
          <form action="{{ route ('Reunion.update', $reunions->id)}}" method="post" >
               {{ csrf_field() }}
              {{ method_field('PUT') }}
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button class="btn btn-primary" type=" button submit"><i class="fa fa-trash"></i> SUPPRIMER</button></a>
                        <input type="hidden" name="sup" value="0">
          </form>
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
                  </td>
                </tr>
                @endforeach
                
                </tbody>
              </table>            
            </div>
          </div>
        </div><!--/col-->
      
      </div><!--/row-->
    </form>
  </div>
</div>


      

      <script src="{{asset('assets/lib/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/lib/popper.js/popper.js')}}"></script>
    <script src="{{asset('assets/lib/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
    <script src="{{asset('assets/lib/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
    <script src="{{asset('assets/lib/select2/js/select2.min.js')}}"></script>

    <script src="{{asset('assets/lib/select2/js/select2.min.js')}} ../js/shamcey.js"></script>
    <script>
      $(function() {
        'use strict';

        $('#datatable1').DataTable({
          responsive: false,
          language: {
            searchPlaceholder: 'Recherchez...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });

        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true
        });

        // // Select2
        // $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>
      
         @stop