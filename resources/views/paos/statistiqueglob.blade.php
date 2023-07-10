@extends('pages.Default')
@section('content')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
  
          <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-signal"></i> Statistique Globale</h3>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="{{route('home')}}">Accueil</a></li> 
             <li><i class="fa fa-signal"></i>Statistique Globale</li>                
          </ol>
        </div>
      </div>
   

       

       <div class="row">   
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h2><i class="fa fa-table red"></i><span class="break"></span><strong>Statistique PAOA</strong></h2>
              <div class="panel-actions">
                <a href="table.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                <a href="table.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                <a href="table.html#" class="btn-close"><i class="fa fa-times"></i></a>
              </div>
            </div>
            <div class="panel-body">
            <form action="{{ route('filtrestatistiqueGlob')}}" method="POST" class="form-inline">
                {{ csrf_field() }}
                <input type="hidden" name="page" value="2">
                       
                    
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

             
            </div>
          </div>
        </div><!--/col-->
      
      </div><!--/row-->

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
        text: 'Niveau taux de réalisation'
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
        data: [
        @foreach ($direction as $directions)
        {
            name: '<?php echo nom_direction($directions->id) ?>',
            y: <?php echo realise($directions->id,$exist_debut,$exist_fin); ?>
        }@if (! $loop->last)
         , 
          @endif
    @endforeach]
    }]
});
      </script> 
      
         @stop