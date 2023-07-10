             
 <br><br>
        <p><img src="images/armorie1.png" style="position: absolute;left: 5px;top: -20px;width:150px;height:150px;"/></p>
        <br><br><br>

<p style="text-align:center; font-size:20pt;" ><b><h3><u>Plan d'Actions Opérationnel 2022</u></h3></b>
<br><center>Agence de Promotion des Investissements Privés (APIP-GUINEE)</center></p>
 
<img src="images/logo.png" style="position: absolute;right: 20px;top: -20px;width:170px;height:160px;"/>
              <table width="100%" style="border-collapse: collapse; border:0px;" >
<thead class="bg-info">
           <tr style="background-color:#beeaf8;">
            <th style="">Directions</th>
          <th style="" width="40%">Activités</th>     
          <th style="">Statuts</th>
          <th style="">Niveau d'avancement</th>
          <th style="">Début</th>
           <th style="">Fin</th>
           <th style="">Budget</th>
          
          
                </tr>
        </thead>
                <tbody>
                   @foreach ($data["activite"] as $activites)

                    @php

                    $statut = "";

                    if ($activites->statut==0) 
                      $activites->statut = "Non démarré";
                    
                    
                    if($activites->statut==1) 
                      $activites->statut="En Cours";
                    

                    if ($activites->statut==2) 
                      $activites->statut="Terminé";
                    

                    if ($activites->statut==3) 
                      $activites->statut = "Retardé";
                    

                    if($activites->statut==4) 
                      $activites->statut = "Annulé";
                    

                    @endphp

                  <tr>
                    <td><b>{{$activites->sigle}}</b></td> 
                  <td>{{$activites->libelle}}</td>
                  <td>{{ $activites->statut }}</td>
                  <td style="text-align: center;">{{$activites->niveau}}%</td>
                  <td>{{ $activites->date_debut }}</td>

                  <td>{{ $activites->date_fin }}</td>
                  <td>{{$activites->budget}}</td>            
                </tr>
                @endforeach               
                </tbody>
              </table>