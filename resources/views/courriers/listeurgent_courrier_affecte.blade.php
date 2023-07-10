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
            
            <h2>Liste des Courriers Urgents En Attente de Traitement</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->

               <div class="sh-pagebody">
               <!-- <div class="card-header bg-primary tx-white">Liste des Courriers En Attente de Traitement</div> -->
        
           @if(count($courriers)==0)
          <h4 style="color: green; font-weight: bolder;">  Aucun courrier</h4>
         <img src="{{asset('images/listevide.gif')}}"/>
          @endif
          @if(count($courriers)!=0)
         
          <div class="card">
            <div class="card-body">
            <h4 class="card-title" style="text-transform: initial; font-size:15pt">Télécharger au format:</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive mg-t-25">

                           <table id="datatable1" class="table display responsive">
                                    <thead class="bg-info">

                                        <tr style="background:#fbcb0d; text-transform: uppercase;font-size: 10px">

                                            <th width="20%">N°Courrier</th>
                                             <th >Objet</th>
                                            <th >Origine</th>
                                          <th>Date Enregistrement</th>
                                          <th >Date Annotation</th>
                                       
                                            <!-- <th style="color: black;font-weight: bolder;font-weight: bolder;font-size: 10px;">Reférence</th>  -->
                                           
                                          <!--   <th style="color: black;font-weight: bolder;font-weight: bolder;font-size: 10px;">Email</th>
                                            <th style="color: black;font-weight: bolder;font-weight: bolder;font-size: 10px;">Téléphone</th> -->
                                            <th > Direction</th>
                                           <!--  <th>Collaborateur</th> -->
                                           
                                            
                                            
                                            <th >Action</th> 

                                            

                                        </tr>

                                    </thead>

                                    <tfoot class="bg-info">

                                        <tr>
                                          <th width="20%">N°Courrier</th>
                                            <th >Objet</th>
                                            <th >Origine</th>
                                             <th style="font-size-adjust: 11px;">Date Enregistrement </th>
                                               <th >Date Annotation</th>
                                               
                                           <!--  <th >Refèrence</th>  -->
                                          
                                           <!--  <th >Email</th>
                                            <th>Télèphone</th> -->
                                            <th > Direction</th>
                                           <!--  <th>Collaborateur</th> -->
                                         
                                          
                                            
                                            <th >Action</th> 
                                         </tr>

                                    </tfoot>

                                    <tbody>

                                        @foreach($courriers as $courrier) 

                                        <tr>
                 
                                          <td><a href="{{route('detailAnnotationCourrier',$courrier->id)}} "class="btn btn-success waves-effect">{{ $courrier->numero }}</a>
                         @if($courrier->id_priorite==1)  
 <img title="Courrier Urgent" src="{{asset('images/urgents.png')}}" style="height: 30px;">
          @endif
          </td>
                                           <td>{{ $courrier->objet }}</td>

                                            <td>{{ $courrier->destinataire }}</td>
                                           <td>{{ $courrier->date_arrivee }}</td>
                                           <td>{{ $courrier->date_affectation }}</td>

                                            

                                              <!-- <td>{{ $courrier->reference }}</td>  -->
                                              

                                          <!--   <td>{{ $courrier->email}}</td>

                                            <td>{{ $courrier->telephone }}</td> -->
                                            <td>{{ $courrier->sigle }}</td>

                                          
                                           
                                            
                                            
                                         
                                           

                                             

                                            <td> <a href="{{route('detailAnnotationCourrier',$courrier->id)}} "class="btn btn-success waves-effect"><i class="mdi mdi-eye"></i>
                                    <span>Detail</span> </a>
                                    <!-- @if(Auth::user()->user_role=="DIRECTEUR GENERAL")

                                                <form class="forms-sample" method="POST" action="/anotationdirection" enctype='multipart/form-data' >
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $courrier->id}}">
<button class="btn btn-primary btn-lg" type="submit" id="affecter"><i class="mdi mdi-share-variant"></i> Relanse</button>
</form>
@endif
@if((Auth::user()->user_role=="DIRECTEUR GENERAL")||(Auth::user()->user_role=='MANAGER'))
<a href="{{route('RepondreCourrier',$courrier->id)}} "class="btn btn-success waves-effect"><i class="mdi mdi-eye"></i>

   <span>Reponse</span> </a>
  @endif -->

                                            </td>

                                            

                                        </tr>

                                         @endforeach

@if($courrier->affecter_groupe>0)
            @foreach($courrierGroupes as $courrier) 

                                        <tr>
                 
                                          <td><a href="{{route('detailAnnotationCourrier',$courrier->id)}} "class="btn btn-success waves-effect">{{ $courrier->numero }}</a>
                         @if($courrier->id_priorite==1)  
 <img src="{{asset('images/urgents.png')}}" style="height: 30px;">
          @endif
          </td>
                                           <td>{{ $courrier->objet }}</td>

                                            <td>{{ $courrier->destinataire }}</td>
                                           <td>{{ $courrier->date_arrivee }}</td>
                                           <td>{{ $courrier->date_affectation }}</td>

                                            

                                              <!-- <td>{{ $courrier->reference }}</td>  -->
                                              

                                          <!--   <td>{{ $courrier->email}}</td>

                                            <td>{{ $courrier->telephone }}</td> -->
                                            <td>{{ $courrier->nom_groupe }}</td>

                                          
                                           
                                            
                                            
                                         
                                           

                                             

                                            <td> <a href="{{route('detailAnnotationCourrier',$courrier->id)}} "class="btn btn-success waves-effect"><i class="mdi mdi-eye"></i>
                                    <span>Detail</span> </a>
                                    <!-- @if(Auth::user()->user_role=="DIRECTEUR GENERAL")

                                                <form class="forms-sample" method="POST" action="/anotationdirection" enctype='multipart/form-data' >
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $courrier->id}}">
<button class="btn btn-primary btn-lg" type="submit" id="affecter"><i class="mdi mdi-share-variant"></i> Relanse</button>
</form>
@endif
@if((Auth::user()->user_role=="DIRECTEUR GENERAL")||(Auth::user()->user_role=='MANAGER'))
<a href="{{route('RepondreCourrier',$courrier->id)}} "class="btn btn-success waves-effect"><i class="mdi mdi-eye"></i>

   <span>Reponse</span> </a>
  @endif -->

                                            </td>

                                            

                                        </tr>

                                         @endforeach
 @endif

                                        

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