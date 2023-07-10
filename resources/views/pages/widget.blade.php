 @if((Auth::user()->user_role==1)||(Auth::user()->user_role==2))  
    <div class="welcome-message">
      <!-- <div class="sh-pagetitle-title"> -->
    <!--   <img  class="text-logo" src="{{asset('images/armorie1.png')}}" style="height: 60px;"><h2  style="text-align: center"><b style="font-size: 30pt">Ministère du Commerce, de L'Industrie et des PME</b></h2>  --> 
  <!--   </div> -->
            
             <div class="row"><!-- <div class="col-lg-2"> -->
              <!-- <div class="col-lg-3 col-md-3 col-sm-4"><img src="{{asset('images/logo_tp.png')}}" alt="welcome" style="width: 100%;"></div> -->
               <div class="col-lg-5">
               
              <div class="widget" style=" padding: 25px;">
                 <a href="/listeCourrierAttentepresidence" data-toggle="tooltip" data-placement="Bottom" title="Courrier Présidence en Attente d'Annotation">
                <div class="widget-heading clearfix">
                  <div class="pull-left"><b style="color: white;">Courrier Confidentiel</b></div>
                  <div class="pull-right box"> {{count($nbrcourrierAttentePresidence)}}</div>
                </div>
               </a>
                
                <div class="widget-body clearfix">
                  <a href="/listeCourrierArrivepresidence" data-toggle="tooltip" data-placement="Bottom" title="Total Courrier Présidence">
                  <div class="pull-left courrier" data-toggle="tooltip" data-placement="Bottom" title="Total Courrier Présidence">
                  {{count($nbrcourrierPresidence)}}
                  </div>
                   </a>
                  <a href="/listeCourrierAffecterPresidence" data-toggle="tooltip" data-placement="Bottom" title="Courrier Présidence en Attente de traitement">
                  <div class="pull-right number boxcourrier">{{count($nbrcourrierAttenteTraitePresidence)}}</div>
                   </a>
                </div>
            
               
              </div>
             
            </div>
           <!--  <div class="col-lg-4 col-md-4 col-sm-6">
              
              <div class="widget">
                 <a href="/listeCourrierAttenteMinier" data-toggle="tooltip" data-placement="Bottom" title="Courrier Mine en Attente d'Annotation">
                <div class="widget-heading clearfix">
                  <div class="pull-left"><b>Mine</b></div>
                  <div class="pull-right box">{{count($nbrcourrierAttenteMini)}} </div>
                </div>
              </a>
              
                <div class="widget-body clearfix">
                  <a href="/listeCourrierArriveMine" data-toggle="tooltip" data-placement="Bottom" title="Total Courrier Mine">
                  <div class="pull-left courrier" style="color: white">{{count($nbrcourrierMini)}}
                  
                  </div>
                   </a>
                  <a href="/listeCourrierAffecterMine" data-toggle="tooltip" data-placement="Bottom" title="Courrier Mine en Attente de traitement" >
                  <div class="pull-right number boxcourrier">{{count($nbrcourrierAttenteTraiteMini)}}</div>
                   </a>
                </div>
              
               
              </div>
               
            </div> -->
            <div class="col-lg-5">
            
              <div class="widget" style=" padding: 25px;">
                   <a href="/listeCourrierAttente" data-toggle="tooltip" data-placement="Bottom" title=" Autres Courriers en Attente d'Annotation">
                <div class="widget-heading clearfix">
                  <div class="pull-left"><b style="color: white;">Autre Courrier</b></div>
                  <div class="pull-right box">{{count($nbrcourrierAttenteAutre)}}</div>
                </div>
                    </a>
                  
                <div class="widget-body clearfix">
                   <a href="/listeCourrierArrive" data-toggle="tooltip" data-placement="Bottom" title="Total Autres Courriers">
                  <div class="pull-left courrier">
               {{count($nbrcourrierAutre)}}
                  </div>
                  </a>
                   <a href="listeCourrierAffecter" data-toggle="tooltip" data-placement="Bottom" title="Autres Courriers en Attente de traitement">
                  <div class="pull-right number boxcourrier">{{count($nbrcourrierAttenteTraiteAutre)}}</div>
                  </a>
                </div>
                   

               
             
             </div>
          
            </div>
          </div>
@endif
  <style type="text/css">@import url("//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css");
  .courrier{
    color: white;
    font-weight: bolder;
  }
  .boxcourrier{

    width: 15%;
    height: 50%;
    border-radius: 100%;
    font-size: 7px;
      border: 1px solid #FFFFFF;
      background: #FFFFFF;
      font-weight: bolder;
      font-size: 70%;
      color: black;
      text-align: center;
      /*background: #fbcb0d;*/
}
.box{
    width: 15%;
    height: 50%;
    border-radius: 100%;
    font-size: 7px;
      border: 1px solid #FFFFFF;
      background: #FFFFFF;
      font-weight: bolder;
      font-size: 100%;
      color: black;
}

.widget {
    margin: 0 0 25px 25px;
    display: block;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
}
.widget .widget-heading {
    padding: 7px 15px;
    -webkit-border-radius: 2px 2px 0 0;
    -moz-border-radius: 2px 2px 0 0;
    border-radius: 2px 2px 0 0;
    text-transform: uppercase;
    text-align: center;
    background: #6495ED;
    color: black;
    font-size: 15px;
    font-weight: bolder;
    /*background: #fbcb0d;*/
}
.widget .widget-body {
    padding: 10px 15px;
    font-size: 20px;
    font-weight: 300;
    background: #C0C0C0;
    color: white;
    /*background: #034a13;*/
}</style>