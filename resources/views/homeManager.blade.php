@extends('templates/page/default')
 @section('contenu')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
 <div class="main-panel" style="">
        <div class="content-wrapper p-0">
         

         @if(session()->has('success'))
        <div class="alert alert-fill-primary" role="alert" style="background: green">
           <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color: white">&times;</a>
                    <i class="mdi mdi-alert-circle"></i>
                    <strong>Succés!</strong> {{session()->get('success')}}
                  </div>

                 <!--    #082c10   -->   
               @endif
          <div class="welcome-message">
            <div class="d-lg-flex justify-content-between align-items-center">
              <div class="pr-5 image-border" style="background: white"><img src="{{asset('images/armorieP.png') }}" alt="welcome"  width="240px"; height="150px"></div>
              <div class="pl-4">
                <h2 class="text-white font-weight-bold mb-3" style="color: black!important;margin-left: 140px;">Bienvenue sur</h2>
                <h1 class="text-white font-weight-bold mb-3" style="color: black!important;">Gestion Electronique des Courriers</h1>
                
                <p></p>
              </div>
              <div class="pl-4">
                
              </div>
            </div>
          </div>

          <div class="tab-content home-tab-content">
            <div class="tab-pane fade show active" id="" role="tabpanel" aria-labelledby="Dashboards-tab">
              <div class="d-sm-flex justify-content-between align-items-center ">
                <h1  class="btn btn-block btn-primary font-weight-medium auth-form-btn" style="background: black;
    font-weight: bolder; border-color: black;font-size: 30px">Statistiques de Traitement des Courriers</h1>
                <!-- <div class="link-btn-group d-flex justify-content-start align-items-start">
                  <button type="button" class="btn btn-link text-dark py-0 pl-0">Add info</button>
                  <button type="button" class="btn btn-link text-dark py-0">Get updated by email</button>
                  <button type="button" class="btn btn-link text-dark py-0">See more</button>
                </div> -->
              </div>
              <div class="row">
                
                 <div class="col-xl-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <!--  <a href="listeCourrierArrive"  >
                          <p class="text-dark font-weight-medium btn btn-primary" style=" background:#ffc107; border-color: #ffc107; color: white!important;font-weight: bolder;">Total Courriers Arrivé</p> <span style=" font-size: 35px;font-weight: bolder; border-radius: 5px;margin-left: 100px ;color: #ffc107; "  >{{count($courriers)+count($courrierTRAITEs)}}</span></a> -->

                      
                    <figure class="highcharts-figure">
  <div id="containerArrive"></div>
 <!--  <p class="highcharts-description">
    All color options in Highcharts can be defined as gradients or patterns.
    In this chart, a gradient fill is used for decorative effect in a pie
    chart.
  </p> -->
</figure>
              
                        </div>
                      </div>  </div>
          

              
              
                  <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Repartition des Courriers Arrivée</h4>

<figure class="highcharts-figure">
  <div id="container"></div>

</figure>
 </div>
              </div>
            </div>
          
            
          </div>
        </div>
<style type="text/css">
  .highcharts-figure, .highcharts-data-table table {
  min-width: 320px; 
  max-width: 660px;
  margin: 1em auto;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #EBEBEB;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
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