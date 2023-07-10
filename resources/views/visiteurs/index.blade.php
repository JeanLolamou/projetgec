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
          <h4 class="">{{$texte}}</h4>
           @if(count($visiteurs)==0)
          <h4 style="color: green; font-weight: bolder;">  La liste est vide</h4>
         <img src="{{asset('images/listevide.gif')}}"/>
          @endif
          @if(count($visiteurs)!=0)
         
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Télecharger</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="example">
                                    <thead>

                                        <tr style="background:#fbcb0d; ">
                                        
                                           
                                            <th style="color: black;font-weight: bolder">Numéro</th> 
                                            <th style="color: black;font-weight: bolder">Code</th>
                                            <th style="color: black;font-weight: bolder;font-size: 10px">Rendez-vous</th>
                                             <th style="color: black;font-weight: bolder">Société</th>
                                            <th style="color: black;font-weight: bolder;font-size: 10px">Nom Visiteur</th>
                                            <th style="color: black;font-weight: bolder">Téléphone</th>
                                             <th style="color: black;font-weight: bolder">Email</th>
                                            <th style="color: black;font-weight: bolder">Motif</th>
                                            
                                            <th style="color: black;font-weight: bolder">Actions</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                         <th>Numéro</th>
                                         <th>Code</th>
                                            <th>Rendez-vous</th>
                                             <th>Société</th>
                                            <th>Nom Visiteur</th>
                                            <th>Téléphone</th>
                                             <th>Email</th>
                                            <th>Motif</th>
                                            
                                            <th>Actions</th>
                                           
                                           
                                        </tr>
                                    </tfoot>

                                    <tbody>
                         @foreach($visiteurs as $key =>$visiteur) 
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                              @if($visiteur->statut=="Attente")
                                                      <td> <a href="{{route('editRendez_vous',$visiteur->id)}}" type="button" class="btn btn-primary waves-effect">
                               {{ $visiteur->numerovisite }}
                                </a>
                            </td>
                            @endif
                                     @if($visiteur->statut=="Présent")
                                                      <td> <a href="{{route('editRendez_vous',$visiteur->id)}}" type="button" class="btn btn-success waves-effect">
                               {{ $visiteur->numerovisite }}
                                </a>
                            </td>
                            @endif
                                             <td>{{ $visiteur->date_rendez_vous }}</td>
                                               <td>{{ $visiteur->entreprisevisiteur }}</td>
                                               <td>{{ $visiteur->nomvisiteur }}</td>
                                               <td>{{ $visiteur->telephonevisiteur }}</td>
                                               <td>{{ $visiteur->emailvisiteur }}</td>
                                               <td>{{ $visiteur->motif }}</td>
                                         
                                           @if($visiteur->statut=="Attente")
                                            <td> <a href="{{route('editRendez_vous',$visiteur->id)}}" type="button" class="btn btn-primary waves-effect">
                                    <i class="mdi mdi-eye"></i>
                                    <span>Detail</span>
                                </a>
                            </td>
                            @endif
                                      @if($visiteur->statut=="Présent")
                                            <td> <a href="{{route('editRendez_vous',$visiteur->id)}}" type="button" class="btn btn-success waves-effect">
                                    <i class="mdi mdi-eye"></i>
                                    <span>Detail</span>
                                </a>
                            </td>
                            @endif

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