@extends('pages.Default')
@section('content')
          <div class="main-panel">
        <div class="content-wrapper">
           @if(session()->has('success'))
        <div class="alert alert-fill-primary" role="alert" style="background: green">
           <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color: black">&times;</a>
                    <i class="mdi mdi-alert-circle"></i>
                    <strong>Succés!</strong> {{session()->get('success')}}
                  </div>

                 <!--    #082c10   -->   
               @endif

                <div class="sh-pagetitle">
        <div class="input-group">
          
        </div><!-- input-group -->
       <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="icon ion-person-stalker"></i></div>
 <div class="sh-pagetitle-title">
            
            <h2>Liste des Groupes</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->

              
           @if(count($groupes)==0)
          <h4 style="color: green; font-weight: bolder;">  La liste est vide</h4>
         <img src="{{asset('images/listevide.gif')}}"/>
          @endif
          @if(count($groupes)!=0)
         
          <div class="card">
            <div class="card-body">
              <h4 class="card-title" style="text-transform: initial;font-size:15pt">Télécharger au format:</h4>            
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive mg-t-25">

                                <table id="datatable1" class="table display responsive nowrap">
                                    <thead class="bg-info">

                                        <tr style="background:#fbcb0d; ">
                                        
                                           
                                            <th style="color: white;font-weight: bolder">Numéro</th>
                                            <th style="color: white;font-weight: bolder">Nom Groupe</th>
                                            <th style="color: white;font-weight: bolder">Sigle</th>
                                            
                                            <th style="color: white;font-weight: bolder">Actions</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot class="bg-info">
                                        <tr>
                                            <th>Numéro</th>
                                            <th>Nom Groupe</th>
                                            <th>Sigle</th>
                                            
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
 @foreach($groupes as $key =>$groupe) 
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $groupe->nom_groupe }}</td>
                                           <td>{{ $groupe->sigle }}</td>
                                            <td> <a href="{{route('editGroupe',$groupe->id)}}" type="button" class="btn btn-primary waves-effect">
                                  <i class="mdi mdi-border-color"></i>
                                    <span>Modifier</span>
                                </a>
                                <a href="element_groupe" type="button" class="btn btn-primary waves-effect">
                                  <i class="mdi mdi-border-color"></i>
                                    <span>Ajout element</span>
                                </a>
                            </td>
                                        </tr>
                                         @endforeach

                                        

                                    </tbody>

                                </table>

                            </div></table>
                  </div>
                </div>
              </div>
            </div>
             @endif
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

        // // Select2
        // $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>
          @stop