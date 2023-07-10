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
          <h6 style="text-transform: uppercase;font-weight: bolder;text-align: center;">Liste des Postes: </h6>
           @if(count($postes)==0)
          <h4 style="color: green; font-weight: bolder;">  La liste est vide</h4>
         <img src="{{asset('images/listevide.gif')}}"/>
          @endif
          @if(count($postes)!=0)
         
          <div class="card">
            <div class="card-body">
               <h4 class="card-title" style="text-transform: initial;">Télécharger au format:</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="example">
                                    <thead>

                                        <tr style="background:#fbcb0d; ">
                                        
                                           
                                            <th style="color: black;font-weight: bolder">Numéro</th>
                                            <th style="color: black;font-weight: bolder">Poste</th>
                                            
                                            
                                            <th style="color: black;font-weight: bolder">Actions</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Numéro</th>
                                            <th>Poste</th>
                                           
                                            
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
 @foreach($postes as $key =>$poste) 
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $poste->User_poste }}</td>
                                          
                                            <td> <a href="{{route('editPoste',$poste->id)}}" type="button" class="btn btn-primary waves-effect">
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