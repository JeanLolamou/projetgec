@extends('templates/page/default')
 @section('contenu')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
 <div class="main-panel"  >
        <div class="content-wrapper p-0" >
         
              <div style="background-image: url('{{asset('images/bg_tp.png')}}'); background-repeat: no-repeat;">

                <div style="margin-left: 40%">
                <h1 style="font-weight: bolder; font-weight: 280%;margin-left: 20%">TABLEAU DE BORD </h1>
                  <h1 style="text-align: center;font-weight: bolder; font-weight: 280%">GEC</h1>
                  <h3 style="color: #0271ba;font-weight: bolder;margin-left: 20% ">Gestion Electonique des Courriers</h3>
                  <h6 style="text-align: center;margin-left: 10%">Statistiques de Traitement des Courriers</h6>
                   <div class="row">
               
                 <div class="col-md-6 ">
                  
                       <a href="listeCourrierArrive"  >
                          <p class="" ><span class="btn" style="background: #039afd; color: white;font-weight: bolder;" >COURRIER ARRIVEES</span> <span class="btn" style="background: black;color: white;font-weight: bolder;" >{{count($courriers)+count($courrierTRAITEs)}}</span></p> </a>
<div style="height: 10%">
                      
                    <figure class="highcharts-figure">
  <div id="containerArrive"></div>
 <!--  <p class="highcharts-description">
    All color options in Highcharts can be defined style="text-align: center" gradients or patterns.
    In this chart, a gradient fill is used for decorative effect in a pie
    chart.
  </p> -->
</figure>
   </div>           
   </div>
          

               
                <div class="col-md-6 ">
                  
   <p class="card-title" style="font-weight: bolder;">Répartition des Courriers Arrivé</p>

<figure class="highcharts-figure">
  <div id="container"></div>

</figure>


</div>
                  
                 
           
     
              
            
            
          </div>
                </div>
          </div>
              </div>
            
      </div>
<style type="text/css">
    .highcharts-figure, .highcharts-data-table table {
  min-width: 220px; 
  max-width: 460px;
  margin: 1em auto;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #EBEBEB;
  margin: 10px auto;
  text-align: center;
  width: 80%;
  max-width: 400px;
}
.highcharts-data-table text {
  color: white!important;font-weight: bolder;background: #ffc107;
    border-color: #ffc107;
}
.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}
.highcharts-data-table th {
  font-weight: 600;
  padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
  padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}
.highcharts-data-table tr:hover {
  background: #f1f7ff;
}
</style>
<script type="text/javascript">
  // Radialize the colors
Highcharts.setOptions({
  colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
    return {
      radialGradient: {
        cx: 0.5,
        cy: 0.3,
        r: 0.7
      },
      stops: [
        [0, color],
        [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
      ]
    };
  })
});

// Build the chart
Highcharts.chart('container', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
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
        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
        connectorColor: 'silver'
      }
    }
  },
  series: [{
    name: 'Share',
    data: [
     
      { name: 'En Attente de Traitement', y: <?php echo  count($courriers); ?> },
      { name: 'Courrier Traité', y: <?php echo  count($courrierTRAITEs); ?>}
      
    ]
  }]
});




Highcharts.chart('containerArrive', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Répresentation des Courriers Arrivées'
  },
  subtitle: {
    text:''
  },
  xAxis: {
    type: 'category',
    labels: {
      rotation: -45,
      style: {
        fontSize: '13px',
        fontFamily: 'Verdana, sans-serif'
      }
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Nombre Courrier'
    }
  },
  legend: {
    enabled: false
  },
  tooltip: {
    pointFormat: ' <b>{point.y}</b>'
  },
  series: [{
    name: 'Population',
    data: [
    
      ['En Attente de Traitement', <?php echo  count($courriers); ?>],
      ['Courrier Traité', <?php echo  count($courrierTRAITEs); ?>]
      
    ],
    dataLabels: {
      enabled: true,
      rotation: -90,
      color: '#FFFFFF',
      align: 'left',
      format: '', // one decimal
      y: 10, // 10 pixels down from the top
      style: {
        fontSize: '13px',
        fontFamily: 'Verdana, sans-serif'
      }
    }
  }]
});


</script>
@stop