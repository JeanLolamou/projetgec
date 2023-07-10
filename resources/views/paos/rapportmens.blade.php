@extends('pages.Default')
@section('content')

        @if(session()->has('message'))
      <div class="row">
     <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Succés!</strong> {{session()->get('message')}}.
              </div>
              </div>
              @endif   


             


                    <div class="sh-pagetitle">
        <div class="input-group">
          
        </div><!-- input-group -->
       <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="icon ion-compose"></i></div>
 <div class="sh-pagetitle-title">
            
            <h2>Rapport Mensuel</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->
        
         <div class="sh-pagebody">
          <!-- <div class="card-header bg-primary tx-white">RAPPORT</div>  --> 
           <div class="row">
        <div class="col-lg-12">
          <ol class="breadcrumb">
             <div class="col-sm-6 col-md-2">
 @if((Auth::user()->user_role==5)||(Auth::user()->user_role==6)||(Auth::user()->user_role==3))
                <a style="text-decoration:none" href="addrapportmen"><button  class="btn btn-outline-primary btn-block">

            <span class="title"></span><i class="fa fa-plus mg-r-10"></i>Ajout Rapport</button></a>
            @endif
                
              </div><!-- col-sm -->

              <div class="col-sm-6 col-md-2">
              
                <a style="text-decoration:none" href="/dashboard"><button  class="btn btn-outline-primary btn-block">

            <span class="title"></span><i class="fa fa-home"></i> Accueil</button></a>
                
              </div><!-- col-sm -->

             
           
</div>
                        
          </ol>
         </div> 
     

<div class="card body">

                           <div class="mb 2">
                             <form action="" method="" class="form-inline">
                      
                            <label class="control-label" for="id_direction"><b>Direction &nbsp;</b> </label>
                            
                        <select id="id_direction" name="direction" class="form-control" size="1">
                          <option value="">Selectionnez la direction</option>
                           @foreach ($direction as $directions)
                             @if(isset($exist_dir) and ($exist_dir!=-1) and ($directions->id==$exist_dir))
           <option value="{{$directions->id}}" selected>{{$directions->sigle}}</option>
          @else
          <option value="{{$directions->id}}">{{$directions->sigle}}</option>
          @endif
                            @endforeach
                                </select>
                       
          <label class=" control-label" for="date"><b>Date &nbsp;</b></label>
                         
                      @if(isset($exist_date))
                               <input type="date" id="date" name="date" class="form-control input-sm" value="{{$exist_date}}">
                              @else
                              <input type="date" id="date" name="date" class="form-control input-sm" placeholder="">
                              @endif



                        
                            <label class=" control-label" for="mois"><b>Mois &nbsp;</b></label>
                         
                            <select id="mois" name="mois" class="form-control" size="">
                              <option value="">Selectionnez le mois</option>
                              @foreach ($rapportmen as $rapportmens)
                             @if(isset($exist_mois) and ($exist_mois!=-1) and ($rapportmens->id==$exist_mois))
           <option value="{{$rapportmens->id}}" selected>{{$rapportmens->mois}}</option>
          @else
          <option value="{{$rapportmens->id}}">{{$rapportmens->mois}}</option>
          @endif
                            @endforeach
                                </select>


                               <!--  <label class=" control-label" for="semaine"><b>Semaine &nbsp;</b></label>
                         
                            <select id="semaine" name="semaine" class="form-control" size="">
                              <option value="">select semaine</option>
                               @foreach ($rapportmen as $rapportmens)
                             @if(isset($exist_semaine) and ($exist_semaine!=-1) and ($rapportmens->id==$exist_semaine))
           <option value="{{$rapportmens->id}}" selected>{{$rapportmens->semaine}}</option>
          @else
          <option value="{{$rapportmens->id}}">{{$rapportmens->semaine}}</option>
          @endif
                            @endforeach
                                </select> -->
                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-dot-circle-o"></i> Filtrer</button>
                                <br>
                    <a target="_blank" href="{{ route('export_rapportmens').'?'.$query }}" 
              class="btn btn-sm btn-warning">
              <i class="fa fa-print"></i> 
            Imprimer
          </a>
                    <br>
                     @if(Auth::user()->user_role==2)
                     <a class="btn btn-danger" href="/globalrapportmens">Rapport Global</a>
                     @endif
                     @if(Auth::user()->user_role==5)
                     <a class="btn btn-danger" href="/manglobalrapportmens">Rapport Global</a>
                     @endif
                     <!-- <button type="button" href="/globalpdfrapportmensunique" class="btn btn-danger">Global</button>
                       <a class="btn btn-danger" href="/dynamic_pdf/pdf-globalrapportmens-unique">Global</a> -->
                  </form>



                        </div>

            
            <div class="panel-body">
             
              <div class="table-responsive mg-t-25">

                           <table id="datatable1" class="table display responsive">
                <thead class="bg-info">
                  <tr style="background: #0b0e69;color: white;">
                    <th>Date de Réalisation</th>                    
                    <th>Direction</th>
                    <th>Responsable</th>
                    <th>Titre du Rapport Mensuel</th>
                    <th>Mois</th>
                    <!-- <th style="width:5px;">Rapport</th>  -->               
                    <th>Actions</th>
                  </tr>
                </thead>   
<tfoot class="bg-info">
                  <tr>
                    <th>Date de Réalisation</th>
                    <th>Direction</th>
                    <th>Responsable</th>
                    <th>Titre du Rapport Mensuel</th>
                    <th>Mois</th>
                    <!-- <th style="width:5px;">Rapport</th> -->
                    <th>Actions</th>
                  </tr>
                </tfoot>   

                <tbody>   
                 @foreach ($rapportmen as $rapportmens)            
                <tr>
                  <td>{{(new DateTime($rapportmens->date))->format("d/m/Y")}}</td>
                 
                  <td><b> {!!$rapportmens->sigle!!}</b></td>
                  <td>{!!$rapportmens->responsable!!}</td>
                  <td>{!!$rapportmens->activite_pao!!}</td>
                   <td>{!!$rapportmens->mois!!}</td>
                  
         
                  <td>
                    <a class="btn btn-success" href="{{ route ('rapportshowmen', $rapportmens->id)}}" title="Details" data-rel="tooltip">
                      <i class="fa fa-search-plus "></i>                                            
                    </a>

                     <a target="_blank" href="{{route('pdfrapportmensunique', $rapportmens->id)}}" class="btn btn-sm btn-warning" title="Imprimer" data-rel="tooltip"><i class="fa fa-print"></i>
                     </a>

        @if((Auth::user()->user_role==5)||(Auth::user()->user_role==6)||(Auth::user()->user_role==3))
                    <a class="btn btn-info" href="{{ route ('editRapportmen', $rapportmens->id)}}" title="Modifier" data-rel="tooltip">
                      <i class="fa fa-edit "></i>                                            
                    </a>
                 
                    <a class="btn btn-danger" data-toggle="modal" data-target="#myModalexpo{{$rapportmens->id}}" title="Supprimer" data-rel="tooltip">
                      <i class="fa fa-trash-o " style="color: white;"></i>

                    </a>
                    @endif
                     <!-- Suppression -->

                    <div class="modal fade" id="myModalexpo{{$rapportmens->id}}">
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
          <form action="{{ route ('rapportupdatemen', $rapportmens->id)}}" method="post" >
               {{ csrf_field() }}
              {{ method_field('PUT') }}
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button class="btn btn-primary" type=" button submit"><i class="fa fa-trash"></i> SUPPRIMER</button>
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

                    <!-- Fin participants -->
          
       
    
   

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

    

      // console.log(query);


    </script>

   
         @stop