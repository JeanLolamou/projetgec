 <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br><br><br><br>

<p style="text-align:center;"><b><h3><u>Rapport Mensuel</u></h3></b>
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
<table width="100%" style="border-collapse: collapse; border:0px;" >
<thead class="bg-info" >
                  <tr style="background-color:#beeaf8;color: black;">
                    <th style="">Date de Réalisation</th>                    
                    <th style="">Direction</th>
                    <th style="">Titre du Rapport Mensuel</th>
                    <th style="">Activités réealisées</th>
                    <th style="">Priorités pour le prochain mois</th>
                    <th style="">Quest-ce qui va bien?</th>
                    <th style="">Principaux défis?</th>
                    <th style="">Que faire pour relever ces défis ?</th>             
                  </tr>
                </thead> 
                <tbody>
                   @foreach ($data["rapportmen"] as $rapportmens)
 <tr>
                  <td>{{$rapportmens->date}}</td>
                 
                  <td><b> {{$rapportmens->sigle}}</b></td>
                  <td>{{$rapportmens->activite_pao}}</td>
                   <td>{{$rapportmens->rapport}}</td>   
                   <td>{{$rapportmens->rapportplan}}</td> 
                   <td>{{$rapportmens->positif}}</td>
                   <td>{{$rapportmens->defis}}</td> 
                   <td>{{$rapportmens->solution}} </td>  
                </tr>            
                
                @endforeach               
                </tbody>

              </table>