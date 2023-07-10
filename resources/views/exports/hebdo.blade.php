 <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br>

<p style="text-align:center; font-size:18pt;"><b><h3><u>Rapport Hebdomadaire</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
<table width="100%" style="border-collapse: collapse; border:0px;" >
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="">Date de Réalisation</th>                    
                    <th style="">Direction</th>
                    <th style="">Titre du Rapport Hebdomadaire</th>
                    <th style="">Activités réealisées cette semaine</th>
                    <th style="">Activités prévues pour la semaine prochaine</th>
                    <th style="">Principaux défis/risques</th>
                    <th style="">Démarche de mitigation</th>
                    <th style="">Décisions clés requises</th>             
                  </tr>
                </thead> 
                <tbody>
                   @foreach ($data["rapport"] as $rapports)
 <tr>
                  <td>{{$rapports->date}}</td>
                 
                  <td><b> {{$rapports->sigle}}</b></td>
                  <td>{{$rapports->activite_pao}}</td>
                   <td>{{$rapports->rapport}}</td>   
                   <td>{{$rapports->rapportplan}}</td> 
                   <td>{{$rapports->defis}}</td>
                   <td>{{$rapports->demarche}}</td> 
                   <td>{{$rapports->decision}} </td>  
                </tr>            
                
                @endforeach               
                </tbody>

              </table>