@extends('templates/page/default')
         @section('contenu')
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
         <h6 style="text-transform: uppercase;font-weight: bolder;">Liste des Directions</h6>
           @if(count($departements)==0)
          <h4 style="color: green; font-weight: bolder;">  La liste est vide</h4>
         <img src="{{asset('images/listevide.gif')}}"/>
          @endif
          @if(count($departements)!=0)
         
          <div class="card">
            <div class="card-body">
       <h4 class="card-title" style="text-transform: initial;">Télécharger au format:</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="example">
                                    <thead>

                                        <tr style="background:#fbcb0d;">
                                        
                                           
                                            <th style="color: black;font-weight: bolder">Numéro</th>
                                            <th style="color: black;font-weight: bolder">Nom  Direction</th>
                                            <th style="color: black;font-weight: bolder">Sigle</th>
                                            
                                            <th style="color: black;font-weight: bolder">Actions</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Numéro</th>
                                            <th>Nom Direction</th>
                                            <th>Sigle</th>
                                            
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
 @foreach($departements as $key =>$departement) 
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $departement->nom }}</td>
                                           <td>{{ $departement->sigle }}</td>
                                            <td> <a href="{{route('editDirection',$departement->id)}}" type="button" class="btn btn-primary waves-effect">
                                 <i class="mdi mdi-border-color"></i>
                                    <span>Modifier</span>
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
          @stop