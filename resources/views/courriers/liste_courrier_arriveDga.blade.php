@extends('pages.Default')
@section('content')
          <div class="main-panel">
        <div class="content-wrapper">
@if(session()->has('success'))
        <div class="alert alert-fill-primary" role="alert" style="background:green">
           <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color: black">&times;</a>
                    <i class="mdi mdi-alert-circle"></i>
                   {{session()->get('success')}}
                  </div>

                 <!--    #082c10   -->   
               @endif

<div class="sh-pagetitle">
        <div class="input-group">
          
        </div><!-- input-group -->
       <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="fa fa-envelope"></i></div>
 <div class="sh-pagetitle-title">
            
            <h2>Liste des Courriers Arrivés</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->

               <div class="sh-pagebody">
              <!--  <div class="card-header bg-primary tx-white">Liste des Courriers Arrivés</div> -->
          
           @if(count($courriers)==0)
          <h4 style="color: green; font-weight: bolder;"> Aucun courrier</h4>
         <img src="{{asset('images/listevide.gif')}}"/>
          @endif
          @if(count($courriers)!=0)
          <div class="card">
            <div class="card-body">
            <h4 class="card-title" style="text-transform: initial;font-size:15pt">Télécharger au format:</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive mg-t-25">

                           <table id="datatable1" class="table display responsive">
<!-- 
                                  <table id="datatable1" class="table display table-responsive responsive table-striped table-bordered table-hover table-primary mg-b-0"> -->
                             
                                    <thead class="bg-info">

                                         <tr style="background:#fbcb0d; ">
                                          <th style="color: white;font-weight: bolder">N°Courrier</th>
                                            <th style="color: white;font-weight: bolder">Objet</th>
                                            <th style="color: white;font-weight: bolder">Origine</th>
                                          <th style="color: white;font-weight: bolder;font-size-adjust: 11px;">Date Enregistrement</th>
 						<th style="color: white;font-weight: bolder">Date Annotation</th>
                                            
						<th style="color: white;font-weight: bolder">Statut</th>                                         
					 	
                                         <!--    <th style="color: black;font-weight: bolder">Référence</th>  -->
                                          
                                           <!--  <th style="color: black;font-weight: bolder">Email</th>
                                            <th style="color: black;font-weight: bolder">Téléphone</th> -->
                                            
                                           <!--  <th>Collaborateur</th> -->
                                            
                                           
                                            <th style="color: white;font-weight: bolder">Action</th> 

                                          
                                            
                                           

                                            

                                        </tr>

                                    </thead>

                                    <tfoot class="bg-info">

                                        <tr>
                                           <th style="">N°Courrier</th>
                                             <th style="">Objet</th>
                                            <th style="">Origine</th>
                                          <th style="font-size-adjust: 11px;">Date Enregistrement</th>
<th style="">Date Anotation</th>
                                             
                                             <th style="">Statut</th>
                                          
                                           <!--  <th style="">Reference</th>  -->
                                          
                                          <!--   <th style="">Email</th>
                                            <th style="">Téléphone</th> -->
                                            
                                           <!--  <th>Collaborateur</th> -->
                                            
                                            
                                            <th style="">Action</th>                           

                                         </tr>

                                    </tfoot>

                                    <tbody>

                                        @foreach($courriers as $courrier) 

                                        <tr>

                                           <td> @if($courrier->courrier_etat=="Traité")
                                            <a href="{{route('detailCourriertraite',$courrier->id)}} "class="btn btn-success waves-effect">{{ $courrier->numero }} </a>
                                            @endif
                                           @if($courrier->courrier_etat=="Affecté")
                                             <a href="{{route('detailAnnotationCourrier',$courrier->id)}} "class="btn btn-success waves-effect">{{ $courrier->numero }} </a>
                                            @endif
                                            @if($courrier->courrier_etat=="attente")
                                            <a href="{{route('detailCourrier',$courrier->id)}} "class="btn btn-success waves-effect">{{ $courrier->numero }} </a>
                                            @endif
                                            </td>

                                             <td>{{ $courrier->objet }}</td>

                                            <td>{{ $courrier->destinataire }}</td>

                                          <td>{{ $courrier->date_arrivee }}</td>
 					<td>{{ $courrier->date_affectation }}</td>
     @if($courrier->courrier_etat=="attente")
                                            <td class="pr-0 text-right"><div style="text-align:center" class="badge  badge-danger"><i class="mdi mdi-pause-octagon mr-2"></i>{{ $courrier->courrier_etat }}</div></td>
                                            @endif
                                            @if($courrier->courrier_etat==1)
                                            <td class="pr-0 text-right"><div style="text-align:center" class="badge  badge-danger"><i class="mdi mdi-email mr-2"></i>{{ $courrier->courrier_etat }}</div></td>
                                            @endif
                                            @if($courrier->courrier_etat=="Affecté")
                                            <td class="text-right"><div style="text-align:center" class="badge badge-warning btn "><i class="mdi mdi-rotate-right mr-2"></i>{{ $courrier->courrier_etat }}</div></td>
                                            @endif
                                            @if($courrier->courrier_etat=="Traité")
                                            <td class="pr-0 text-right"><div style="text-align:center" class="badge  badge-success"><i class="mdi mdi-checkbox-marked mr-2"></i>{{ $courrier->courrier_etat }}</div></td>
                                            @endif


                                           

                                             <!--  <td>{{ $courrier->reference }}</td> -->
                                              

                                           <!--  <td>{{ $courrier->email}}</td>

                                            <td>{{ $courrier->telephone }}</td> -->
                                            
                                           
                                            
                                           
                                       
                                          <td> 
                                               
                                            @if($courrier->courrier_etat=="Traité")
                                            <a href="{{route('detailCourriertraite',$courrier->id)}} "class="btn btn-success waves-effect"><i class="mdi mdi-eye"></i>
                                    <span>Detail</span> </a>
                                            @endif
                                           @if($courrier->courrier_etat=="Affecté")
                                             <a href="{{route('detailAnnotationCourrier',$courrier->id)}} "class="btn btn-success waves-effect"><i class="mdi mdi-eye"></i>
                                    <span>Detail</span> </a>
                                            @endif
                                            @if($courrier->courrier_etat=="attente")
                                            <a href="{{route('detailCourrier',$courrier->id)}} "class="btn btn-success waves-effect"><i class="mdi mdi-eye"></i>
                                    <span>Detail</span> </a>
                                            @endif
                                           
<!-- @if(($courrier->courrier_etat=="attente")&&( Auth::user()->user_role=="DIRECTEUR GENERAL"))
                                                <form class="forms-sample" method="POST" action="/anotationdirection" enctype='multipart/form-data' >
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $courrier->id}}">
<button class="btn btn-primary btn-lg" type="submit" id="affecter"><i class="mdi mdi-share-variant"></i> Affecter à une Direction</button>
</form>
@endif -->

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