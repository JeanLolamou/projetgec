@extends('pages.Default')
@section('content')
          <div class="main-panel">
        <div class="content-wrapper">
  @if (session('success'))
              <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <div class="d-flex align-items-center justify-content-start">
                <i class="icon ion-ios-checkmark alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                <span>{{session('success') }}</span>
              </div><!-- d-flex -->
            </div><!-- alert -->                   
                    @endif

               <div class="sh-pagetitle">
        <div class="input-group">
          
        </div><!-- input-group -->
       <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="fa fa-envelope"></i></div>
 <div class="sh-pagetitle-title">
            
            <h2>Liste des Courriers Départ</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->


               
               
               <!-- <div class="card-header bg-primary tx-white">Liste des Courriers Départ</div> -->
         
           @if(count($courriers)==0)
          <h4 style="color: green; font-weight: bolder;"> Aucun courrier</h4>
         <img src="{{asset('images/listevide.gif')}}"/>
          @endif
          @if(count($courriers)!=0)
         
           
              
                  <div class="sh-pagebody">
                  <div class="card bd-primary mg-t-20">
         
          <div class="card-body pd-sm-30">
             <h4 class="card-title" style="text-transform: initial;font-size:15pt">Télécharger au format:</h4>
                  <div class="table-responsive mg-t-25">

                           <table id="datatable1" class="table display responsive">
                                    <thead class="bg-info">
                               <tr>
                                            <th style="">N°Courrier</th>
                                             <th style="width:5px;">Objet</th>
                                            <th style="width:6px;">Origine</th>
                                              <th style="">Date Enregistrement</th>
                                               <th >En Charge de Suivie</th>
  					                                     <th >Date Retour</th>
					                                       <th >Statut</th>
                                               <th >Action</th> 
                                        </tr>

                                    </thead>

                                    <tfoot class="bg-info" >
                                        <tr>
                                          <th style="">N°Courrier</th>
                                           <th style="width:5px;">Objet</th>
                                            <th style="width:6px;">Origine</th>
                                          <th style="">Date Enregistrement</th>
                                          <th style="">En Charge de Suivie</th>
   				                           	    <th style="">Date Retour</th>
  					                               	<th style="">Statut</th>         
                                            <th style="">Action</th>                        
                                         </tr>

                                    </tfoot>

                                    <tbody>

                                        @foreach($courriers as $courrier) 

                                        <tr>

                                           <td> <a href="{{route('detailCourrier',$courrier->id)}}" class="btn btn-success waves-effect">{{ $courrier->numero }}</a></td>
                                             <td>{{ $courrier->objet }}</td>

                                            <td>{{ $courrier->destinataire }}</td>
                                             <td>{{ $courrier->date_arrivee }}</td>
                                              <td>{{ $courrier->sigle }}</td>
                           <td>{{ $courrier->date_traitement }}</td>



                                             @if($courrier->courrier_etat=="decharge")
                                             <td class="pr-0 text-right"><div class="badge  badge-primary"><i class="mdi mdi-checkbox-marked mr-2"></i>{{ $courrier->courrier_etat }}</div></td>
                                             @endif
                                             @if($courrier->courrier_etat=="expedié")
                                              <td class="pr-0 text-right"><div class="badge badge-warning btn"><i class="mdi mdi-checkbox-marked mr-2"></i>{{ $courrier->courrier_etat }}</div></td>
                                             @endif
                                            <td>
                                             <a href="{{route('detailCourrier',$courrier->id)}}" class="btn btn-success waves-effect"><i class="mdi mdi-eye"></i>

                                    <span>Detail</span> </a>
                                     @if(Auth::user()->user_role==4)
                                       @if($courrier->courrier_etat=="expedié")

                                                <a href="{{route('dechargeCourrier',$courrier->id)}}" class="btn  btn-primary waves-effect"><i class="mdi mdi-share-variant"></i>

                                    <span>Enregistrer la decharge</span> 
                                    @endif
                               @endif
                                            </td>

                                            

                                        </tr>

                                         @endforeach

                                        

                                    </tbody>

                                </table>            </div><!-- table-wrapper -->
          </div><!-- card-body -->
        </div><!-- card -->

                            </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div>
          </div><!-- sh-pagebody -->

 <!-- <script src=" {{asset('assets/lib/popper.js/popper.js')}} "></script> -->
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