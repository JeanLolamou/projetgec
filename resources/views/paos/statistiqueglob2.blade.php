@extends('pages.Default')
@section('content')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->

 <div class="sh-pagetitle">
        <div class="input-group">
          
        </div><!-- input-group -->
       <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="fa fa-signal"></i></div>
 <div class="sh-pagetitle-title">
            
            <h2>Taux de réalisation des activités</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->

<div class="sh-pagebody">
  
          <div class="row">
        <div class="col-lg-12">
         
          <ol class="breadcrumb">
<div class="col-sm-6 col-md-2 ">
              
                <a style="text-decoration:none" href="/dashboard"><button  class="btn btn-outline-primary btn-block">

            <span class="title"></span><i class="fa fa-home"></i> Accueil</button></a>
                
              </div><!-- col-sm -->
            <!--  <li><i class="fa fa-signal"></i>Statistique Globale</li>   -->              
          </ol>
        </div>
      </div>
   

       

       <div class="row">   
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h2 style="font-size:20pt; color: black;" ><img src="{{asset('images/sta.jpg')}}" style="height: 70px;"> <span class="break"></span><strong>Statistique PAO</strong></h2>
              
            </div>
            <div class="panel-body">
            <form action="{{ route('filtrestatistiqueGlob')}}" method="POST" class="form-inline">
                {{ csrf_field() }}
                <input type="hidden" name="page" value="2">
                       
                    
                        <div class="form-group">
                            <label class="control-label" for="input-small">Début</label>
                             @if(isset($exist_debut))
                               <input type="date" id="input-small" name="date_debut" class="form-control input-sm" value="{{$exist_debut}}">
                              @else
                              <input type="date" id="input-small" name="date_debut" class="form-control input-sm" placeholder="">
                              @endif
                                
                            
                        </div>
                         <div class="form-group">
                            <label class="control-label" for="input-small">Fin</label>
                              @if(isset($exist_fin))
                                <input type="date" id="input-small" name="date_fin" class="form-control input-sm" value="{{$exist_fin}}">
                              @else
                               <input type="date" id="input-small" name="date_fin" class="form-control input-sm" placeholder="">
                              @endif
                               
                            
                        </div>
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-dot-circle-o"></i> Filtrer</button>
                       <?php 
                       if (!isset($exist_dir)) {
                          $exist_dir=-1;
                        }

                        if (!isset($exist_statut)) {
                          $exist_statut=-1;
                        }

                        if (!isset($exist_debut)) {
                          $exist_debut=-1;
                        }

                        if (!isset($exist_fin)) {
                          $exist_fin=-1;
                        }

                         ?>
         
                    </form>
                    <br>
            

                       <table id="datatable1" class="table display responsive ">
                <thead class="bg-info">
                  <tr style="background: #0b0e69;color: white;">
                    <th style="width:45px;">Directions</th>
                    <th style="width:45px;">Taux de réalisation des activités</th>
                  </tr>
                </thead>   
                <tbody>   
                 @foreach ($direction as $directions)            
                <tr>
                  <td> {{nom_direction($directions->id)}}</td>
                  <td>
                   <?php
                      $realise=realise($directions->id,$exist_debut,$exist_fin);
                      $non_realise=non_realise($directions->id,$exist_debut,$exist_fin);
                      $nb=$realise+$non_realise;
                      if ($nb>0) {
                        $niveau=($realise/$nb)*100;
                      }else{

                        $niveau=0;

                      }
                    ?>

                    @if($niveau==0)
                       <div class="progress" title="0%" data-rel="tooltip">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                          0%
                        </div>
                      </div>
                    @elseif($niveau==100) 
                     <div class="progress" title="100%" data-rel="tooltip">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                          100%
                        </div>
                      </div>
                    @else
                     <div class="progress" title="{{$niveau}}%" data-rel="tooltip">
                   <?php 

                   echo' <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$niveau.'" aria-valuemin="0" aria-valuemax="100" style="width: '.number_format($niveau,2).'%;">
                          '.number_format($niveau,2).'%
                        </div>';
                    ?>
                      </div>
                    @endif
                 
                  </td>
                
                </tr>
                @endforeach
                
                </tbody>
              </table>          

             
            </div>
          </div>
        </div><!--/col-->
      
      </div><!--/row-->

      
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