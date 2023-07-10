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
         <!--  <input type="search" class="form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn"><i class="fa fa-search"></i></button>
          </span> -->
        </div>
        <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="icon ion-person-stalker"></i></div>
          <div class="sh-pagetitle-title">
           
            <h2>Liste des Utilisateurs</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->
<div class="sh-pagebody">
<!--  <div class="card-header bg-primary tx-white">Liste des Utilisateurs</div> -->

          
           @if(count($utilisateurs)==0)
          <h4 style="color: green; font-weight: bolder;">  La liste est vide</h4>
         <img src="{{asset('images/listevide.gif')}}"/>
          @endif
          @if(count($utilisateurs)!=0)
         
          <div class="card">
            <div class="card-body"> <h4 class="card-title" style="text-transform: initial;font-size:15pt">Télécharger au format:</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive mg-t-25">

                           <table id="datatable1" class="table display responsive">
                                    <thead class="bg-info">

                                        <tr style="background:#fbcb0d; ">
                                        
                                           
                                            <th style="color: white;font-weight: bolder">Numéro</th>
                                            <th style="color: white;font-weight: bolder">Prénom et Nom</th>
                                            <th style="color: white;font-weight: bolder">Poste</th>
                                             <th style="color: white;font-weight: bolder">Direction</th>
                                            <!--  <th style="color: white;font-weight: bolder">Service</th> -->
                                   
                                            <th style="color: white;font-weight: bolder">Email</th>
                                            <th style="color: white;font-weight: bolder">Actions</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot class="bg-info">
                                        <tr>
                                            <th style="color: white;font-weight: bolder">Numéro</th>
                                            <th style="color: white;font-weight: bolder">Prénom et Nom</th>
                                            <th style="color: white;font-weight: bolder">Poste</th>
                                            <th style="color: white;font-weight: bolder">Direction</th>
                                           <!--  <th style="color: white;font-weight: bolder">Service</th> -->
                                            <th style="color: white;font-weight: bolder">Email</th>
                                            <th style="color: white;font-weight: bolder">Actions</th>
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
                                            <td> <a href="{{route('editUser',$utilisateur->id)}}" type="button" class="btn btn-primary waves-effect">
                                   <i class="mdi mdi-border-color"></i>
                                    <span>Modifier</span>
                                </a>
                                 <form id="form_validation" method="POST" class="pt-3" action="{{ route('updateActif') }}">
                                      {{ csrf_field() }}
                                      {{ method_field('PUT') }}
                                      <input type="hidden" name="id" value="{{ $utilisateur->id }}">

                                @if($utilisateur->user_statut==1)
                        
                   
 <!-- <a href="{{ route ('activiteshow', $utilisateur->id)}}" title="Voir une activite"><button class="btn btn-success"><i class="fa fa-search-plus "></i></button></a> -->
                   
                     <button  type="submit"  class="btn btn-danger waves-effect" style=""><i class="mdi mdi-account-off"></i>Desactiver</button> 
                      @endif 
                         @if($utilisateur->user_statut==0)
                         
                                
                        
                       
                      <button  type="submit"  class="btn btn-succes waves-effect" style=""><i class="mdi mdi-account-outline"></i>Activer</button> 
                      @endif 
                      
                    </form>
                            <!-- <a href="" type="button"class="btn bg-red waves-effect">
                                    <i class="material-icons">delete</i>
                                    <span>Delete</span>
                                </a> --></td>
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