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
            
            <h2>Choisir les éléments du groupe:@foreach($departements as $departement) <b>{{$departement->nom_groupe}}</b>
          @endforeach</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->

      <div class="sh-pagebody">

        
           @if(count($utilisateurs)==0)
          <h4 style="color: green; font-weight: bolder;">  La liste est vide</h4>
         <img src="{{asset('images/listevide.gif')}}"/>
          @endif
          @if((count($utilisateurs)!=0)&&(count($departements)!=0))
   
                     <div class="row" >
            <div class="col-md-6" id="groupe">
                        <div class="form-group" id="groupe"> 
                          @if(session()->has(' errore'))
        <div class="alert alert-fill-primary" role="alert" style="background: red">
           <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color: black">&times;</a>
                    <i class="mdi mdi-alert-circle"></i>
                    <strong></strong> {{session()->get(' errore')}}
                  </div>

                 <!--    #082c10   -->   
               @endif

</div>
                        </div>
         

       
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
                                            <th style="color: white;font-weight: bolder">Prénom et Nom</th>
                                            <th style="color: white;font-weight: bolder">Poste</th>
                                             <th style="color: white;font-weight: bolder">Direction</th>
                                   
                                            <th style="color: white;font-weight: bolder">Email</th>
                                            <th style="color: white;font-weight: bolder">Elément</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot class="bg-info">
                                        <tr>
                                            <th>Numéro</th>
                                            <th>Prénom et Nom</th>
                                            <th>Poste</th>
                                            <th>Direction</th>
  
                                            <th>Email</th>
                                            <th>Elément</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
 @foreach($utilisateurs as $key =>$utilisateur) 
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $utilisateur->name }}</td>
                                            <td>{{ $utilisateur->User_poste  }}</td>
                                            <td>{{ $utilisateur->nom }}</td>
                                            <td>{{ $utilisateur->email}}</td>
                                            <td> 
                                        <form id="form_validation" method="POST" class="pt-3" action="{{ route('elementduGroupe') }}">
                                      {{ csrf_field() }}
                                      {{ method_field('PUT') }}
                                      <input type="hidden" name="id" value="{{ $utilisateur->id }}">
                                       <input type="hidden" name="id_groupe" id="id_groupe" value="{{$groupes}}">

                        @if($utilisateur->groupe_id==$groupes)                       
 <input type="hidden" name="choix" value=1>              
     <button  type="submit" style="background: green" class="btn btn-primary waves-effect" data-toggle="tooltip" data-placement="Bottom" title="Retirer l'élèment du groupe"><i class="mdi mdi-checkbox-marked"></i>Membre</button>            
                               @else          
             <input type="hidden" name="choix" value=0>                      <button  type="submit" style="background: red" class="btn btn-primary waves-effect" data-toggle="tooltip" data-placement="Bottom" title="Ajouter l'élèment au groupe"><i class="mdi mdi-checkbox-blank-outline"></i></button>                       @endif                          
                        
                      
                 
                            <!-- <a href="" type="button"class="btn bg-red waves-effect">
                                    <i class="material-icons">delete</i>
                                    <span>Delete</span>
                                </a> -->
  </form>
                              </td>
                                        </tr>
                                         @endforeach

                                        

                                    </tbody>

                                </table>

                            </div>

                  </div>
                </div>
              </div>
            </div>
             
             @endif
          </div>
        </div>
         </div><!-- sh-pagebody -->

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