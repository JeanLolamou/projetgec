@extends('pages.Default')
@section('content')

  
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
              <form action="{{ route('statistique')}}" method="POST" class="form-inline">
                {{ csrf_field() }}
                <input type="hidden" name="page" value="2">
                    <!--    <div class="form-group">
                            <label class="control-label" for="select">Diréction</label>
                            
                        <select id="select" name="direction" class="form-control" size="1">
                          <option value="-1">Aucune</option>
                            @foreach ($direction as $directions)
                             @if(isset($exist_dir) and ($exist_dir!=-1) and ($directions->id==$exist_dir))
           <option value="{{$directions->id}}" selected>{{$directions->nom}}</option>
          @else
          <option value="{{$directions->id}}">{{$directions->nom}}</option>
          @endif
                            @endforeach

                           

                                </select>
                        </div> -->
                    
                        <div class="form-group">
                            <label class="control-label" for="input-small">Debut</label>
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

                     <div id="statistique"></div>

                     <?php 
                     $realise=0;
                     $non_realise=0;
                     $nb=count($activite);
                     foreach ($activite as $activites) {
                      $realise+=$activites->niveau;
                      }

                      $non_realise+=($nb*100)-$realise;

                       ?>

             
            </div>
          </div>
        </div><!--/col-->
      
      </div><!--/row-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="components/highstock/highstock.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
      <script>
       Highcharts.chart('statistique', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        @if((count($activite)<=0) and ($activite!=null))
        text: 'Veuillez sélectionner une direction!!'
        @else
        text: '<?php echo nom_direction($exist_dir); ?>'
        @endif
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'Realisé',
            y: <?php echo $realise; ?>,
            sliced: true,
            selected: true
        }, {
            name: 'Non realisé',
            y: <?php echo $non_realise; ?>
        }]
    }]
});
      </script> 
      
         @stop