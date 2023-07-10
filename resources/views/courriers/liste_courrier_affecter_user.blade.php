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
            
            <h2>Liste des Courriers Affectés</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->

               
               <div class="sh-pagebody">
              <!--  <div class="card-header bg-primary tx-white">Liste des Courriers Affectés</div> -->
          
            @if(count($courriers)==0)
          <h4 style="color: green; font-weight: bolder;">  Aucun courrier</h4>
         <img src="{{asset('images/listevide.gif')}}"/>
          @endif
          @if(count($courriers)!=0)
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Télecharger</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive mg-t-25">
 <!-- <table id="datatable1" class="table display responsive nowrap"> -->

                                <table id="datatable1" class="table display responsive ">
                                    <thead class="bg-info">

                                        <tr>

                                            <th>Numero</th>
                                           <!--  <th>Reference</th> -->
                                            <th>Objet</th>
                                            <th>Origine</th>
                                           <!--  <th>Email</th>
                                            <th>Télephone</th> -->
                                            
                                            <th>Date Enregistrement</th>
                                            <th>Date Anotation</th>
                                            <th>Action</th> 

                                            

                                        </tr>

                                    </thead>

                                    <tfoot class="bg-info">

                                        <tr>

                                           <th>Numero Lettre</th>
                                           <!--  <th>Reference</th> -->
                                            <th>Objet</th>
                                            <th>Origine</th>
                                          <!--   <th>Email</th>
                                            <th>Télephone</th> -->
                                            
                                            <th>Date Enregistrement</th>
                                            <th>Date Anotation</th>
                                            <th>Action</th>                            

                                         </tr>

                                    </tfoot>

                                    <tbody>

                                        @foreach($courriers as $courrier) 

                                        <tr>
                                           
                                            <td><a href="{{route('detailAnnotationCourrier',$courrier->id)}} "class="btn btn-success waves-effect">{{ $courrier->numero }}</a>
                                            @if($courrier->id_priorite==1)  
 <img class="blink" src="{{asset('images/urgents.png')}}" style="height: 50px;">
          @endif 
         
</td>

                                             <!--  <td>{{ $courrier->reference }}</td> -->
                                               <td>{{ $courrier->objet }}</td>

                                            <td>{{ $courrier->destinataire }}</td>

                                           <!--  <td>{{ $courrier->email}}</td>

                                            <td>{{ $courrier->telephone }}</td> -->
                                            
                                            <td>{{ $courrier->date_affectation }}</td>
                                            <td>{{ $courrier->date_arrivee }}</td>
                                           

                                             

                                            <td> <a href="{{route('detailAnnotationCourrier',$courrier->id)}} "class="btn btn-success waves-effect"><i class="mdi mdi-eye"></i>
                                    <span>Detail</span> </a>


<a href="{{route('RepondreCourrier',$courrier->id)}} "class="btn btn-primary waves-effect"><i class="mdi mdi-eye"></i>
                                    <span>Reponse</span> </a>

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
          @stop