@extends('pages.Default')
@section('content')

  
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
<div class="sh-pagetitle">
        <div class="input-group">
          
        </div><!-- input-group -->
       <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="fa fa-signal"></i></div>
 <div class="sh-pagetitle-title">
            
            <h2>Taux de Traitement des Courriers</h2>
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
              <h2 style="font-size:20pt; color: black;" ><img src="{{asset('images/sta.jpg')}}" style="height: 70px;"> <span class="break"></span><strong>Statistique Courrier</strong></h2>
              
            </div>
            <div class="panel-body">

                     <div id="statistique"></div>

                     <?php 
                     $traite=0;
                     $non_traite=0;
                      $requete="select * from courriers where courrier_etat='Traité'";

        $count=DB::SELECT($requete);
     
        $traite=0;

        $traite= count($count);
                    
$requeten="select * from courriers where courrier_etat='Affecte'";

        $countn=DB::SELECT($requeten);
     
        $non_traite=0;

        $non_traite= count($countn);
                     

                       ?>

             
            </div>
 <br><br>

 <div class="panel-body">
            
                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>

                     <?php 
                     $traite=0;
                     $non_traite=0;
                      $requete="select * from courriers where courrier_etat='Traité'";

        $count=DB::SELECT($requete);
     
        $traite=0;

        $traite= count($count);
                    
$requeten="select * from courriers where courrier_etat='Affecte'";

        $countn=DB::SELECT($requeten);
     
        $non_traite=0;

        $non_traite= count($countn);


$requetedesi="select * from affectations where direction_affectation=2 and  statut_courrier='Traité'";
        $countdesi=DB::SELECT($requetedesi);
        $traitedesi=0;
        $traitedesi= count($countdesi);

$requetedae="select * from affectations where direction_affectation=4 and  statut_courrier='Traité'";
        $countdae=DB::SELECT($requetedae);
        $traitedae=0;
        $traitedae= count($countdae);

$requetedpi="select * from affectations where direction_affectation=1 and  statut_courrier='Traité'";
        $countdpi=DB::SELECT($requetedpi);
        $traitedpi=0;
        $traitedpi= count($countdpi);

$requetegu="select * from affectations where direction_affectation=6 and  statut_courrier='Traité'";
        $countgu=DB::SELECT($requetegu);
        $traitegu=0;
        $traitegu= count($countgu);

$requetesaf="select * from affectations where direction_affectation=11 and  statut_courrier='Traité'";
        $countsaf=DB::SELECT($requetesaf);
        $traitesaf=0;
        $traitesaf= count($countsaf); 

$requetedga="select * from affectations where direction_affectation=5 and  statut_courrier='Traité'";
        $countdga=DB::SELECT($requetedga);
        $traitedga=0;
        $traitedga= count($countdga);  

$requetedesiaff="select * from affectations where direction_affectation=2 and  statut_courrier='Affecté'";
        $countdesiaff=DB::SELECT($requetedesiaff);
        $traitedesiaff=0;
        $traitedesiaff= count($countdesiaff);

$requetedaeaff="select * from affectations where direction_affectation=4 and  statut_courrier='Affecté'";
        $countdaeaff=DB::SELECT($requetedaeaff);
        $traitedaeaff=0;
        $traitedaeaff= count($countdaeaff);

$requetedpiaff="select * from affectations where direction_affectation=1 and  statut_courrier='Affecté'";
        $countdpiaff=DB::SELECT($requetedpiaff);
        $traitedpiaff=0;
        $traitedpiaff= count($countdpiaff);

$requeteguaff="select * from affectations where direction_affectation=6 and  statut_courrier='Affecté'";
        $countguaff=DB::SELECT($requeteguaff);
        $traiteguaff=0;
        $traiteguaff= count($countguaff);

$requetesafaff="select * from affectations where direction_affectation=11 and  statut_courrier='Affecté'";
        $countsafaff=DB::SELECT($requetesafaff);
        $traitesafaff=0;
        $traitesafaff= count($countsafaff); 

$requetedgaaff="select * from affectations where direction_affectation=5 and  statut_courrier='Affecté'";
        $countdgaaff=DB::SELECT($requetedgaaff);
        $traitedgaaff=0;
        $traitedgaaff= count($countdgaaff);  

$requetedgaaff="select * from affectations where direction_affectation=5 and  statut_courrier='Affecté'";
        $countdgaaff=DB::SELECT($requetedgaaff);
        $traitedgaaff=0;
        $traitedgaaff= count($countdgaaff);      

                     

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
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

      <script>
       Highcharts.chart('statistique', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
       
      text: "Taux de Traitement des Courriers"
       
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
            name: 'Courrier Traité',
            y: <?php echo $traite; ?>,
            sliced: true,
            selected: true
        }, {
            name: 'Courrier Non Traité',
            y: <?php echo $non_traite; ?>
        }]
    }]
});


window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  exportEnabled: true,
  title:{
    text: "Traitement des Courriers par Département"
  },
   axisY: {
    title: "Courrier Traité",
    titleFontColor: "#4F81BC",
    lineColor: "#4F81BC",
    labelFontColor: "#4F81BC",
    tickColor: "#4F81BC"
  },
  axisY2: {
    title: "Courrier Non Traité",
    titleFontColor: "#C0504E",
    lineColor: "#C0504E",
    labelFontColor: "#C0504E",
    tickColor: "#C0504E"
  },
  toolTip: {
    shared: true
  },
  legend: {
    cursor:"pointer",
    itemclick: toggleDataSeries
  },  
  data: [{
    type: "column", //change type to bar, line, area, pie, etc
    //indexLabel: "{y}", //Shows y value on all Data Points
    name: "Courrier Traité",
    legendText: "Courrier Traité",
    showInLegend: true, 
    dataPoints: [
      {label: "DESI", y: <?php echo $traitedesi; ?>},
      {label: "DAE", y: <?php echo $traitedae; ?>},
      {label: "DPI", y: <?php echo $traitedpi; ?>},
      {label: "GU", y: <?php echo $traitegu; ?>},
      {label: "SAF", y: <?php echo $traitesaf; ?>},
      {label: "DGA", y: <?php echo $traitedga; ?>}
      
    ]
  },
{
   type: "column",  
    name: "Courrier Non Traité",
    legendText: "Courrier Non Traité",
    axisYType: "secondary",
    showInLegend: true,
    dataPoints: [
      {label: "DESI", y:<?php echo $traitedesiaff; ?>},
      {label: "DAE", y:<?php echo $traitedaeaff; ?>},
      {label: "DPI", y:<?php echo $traitedpiaff; ?>},
      {label: "GU", y:<?php echo $traiteguaff; ?>},
      {label: "SAF", y:<?php echo $traitesafaff; ?>},
      {label: "DGA", y:<?php echo $traitedgaaff; ?>}
      
    ]
    }
  ]
});
chart.render();

function toggleDataSeries(e) {
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else {
    e.dataSeries.visible = true;
  }
  chart.render();
}



}
  
      </script> 
      
         @stop