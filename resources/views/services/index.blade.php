@extends('pages.Default')
@section('content')
          <div class="main-panel">
        <div class="content-wrapper">
       <h6 style="text-transform: uppercase;font-weight: bolder;text-align: center;">Liste des Services:</h6>
           @if(count($services)==0)
          <h4 style="color: green; font-weight: bolder;">  La liste est vide</h4>
         <img src="{{asset('images/listevide.gif')}}"/>
          @endif
          @if(count($services)!=0)
         
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
                                             <th style="color: black;font-weight: bolder">Nom Service</th>
                                              <th style="color: black;font-weight: bolder">Sigle</th>
                                            <th style="color: black;font-weight: bolder">Nom  Direction</th>
                                           
                                            
                                            <th style="color: black;font-weight: bolder">Actions</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Numéro</th>
                                            <th>Nom Service</th>
                                             <th>Sigle</th>
                                            <th>Nom Direction</th>
                                           
                                            
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
 @foreach($services as $key =>$service) 
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $service->nom_service }}</td>
                                           <td>{{ $service->sigle }}</td>
                                            
                                            <td>{{ $service->nom  }}</td>
                                            <td> <a href="#" type="button" class="btn btn-primary waves-effect">
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