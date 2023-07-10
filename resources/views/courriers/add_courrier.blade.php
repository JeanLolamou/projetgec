@extends('pages.Default')
@section('content')
        
               <div class="main-panel">
        <div class="content-wrapper">
           @if(session()->has('success'))
        <div class="alert alert-fill-primary" role="alert" style="background:green">
           <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color: white">&times;</a>
                    <i class="mdi mdi-alert-circle"></i>
                   {{session()->get('success')}}
                  </div>

                 <!--    #082c10   -->   
               @endif
               <div class="sh-pagebody">
               <div class="card-header bg-primary tx-white">Ajouter un nouveau courrier:</div>
         

               <div class="row grid-margin">
            <div class="col-lg-12 col-md-12">
              <div class="card" style="background:  #FFFFFF;">
                <div class="card-body">
                  <h4 class="card-title"></h4>
                  <form class="" id="signupForm" method="post" action="/courrierArriver" enctype="multipart/form-data">
                     {{ csrf_field() }}
                    <fieldset>
                      <input type="hidden" name="categorie" value="Autres">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                        <label for="numero">Numéro *</label>
                        <input id="numero" class="form-control" name="numero" type="text" value="{{$numero}}"  disabled style="background: white;" required="required">
                      </div>
                      <div class="form-group">
                        <label for="type_courrier">Type Courrier *</label>
                        <select id="type_courrier" name="type_courrier" autocomplete="off" class="form-control" required="required" style="background: white;">
                    <option value="">Selectionner</option>
                    <option value="Arrivée">Arrivée</option>
                    <option value="Départ">Départ</option>
                    
                  </select>
                        
                      </div>
                      <div class="form-group">
                        <label for="reference">Référence *</label>
                        <input id="reference" class="form-control" name="reference" type="text" required="required" style="background: white;">
                      </div>
                      <div class="form-group">
                        <label for="objet">Objet *</label>
                        <input id="objet" class="form-control" name="objet" type="text" required="required" style="background: white;">
                      </div>
                      <div class="form-group">
                        <label for="synthese">Synthèse</label>
                        <textarea id="synthese" class="form-control" name="synthese"  style="background: white;"></textarea> 
                      </div>
                      
                        </div>
                         <div class="col-md-6">
                          <div class="form-group">
                        <label for="destinataire">Origine *</label>
                        <input id="destinataire" class="form-control" name="destinataire" type="text" required="required" style="background: white;">
                      </div>
                      <div class="form-group">
                        <label for="email">Email Origine *</label>
                        <input id="email" class="form-control" name="email" type="email"  style="background: white;" required="required">
                      </div>
                           <div class="form-group">
                        <label for="telephone">Téléphone Origine</label>
                        <input id="telephone" class="form-control bfh-phone" name="telephone" type="text"  style="background: white;" data-format="ddd dd-dd-dd" required="required">
                      </div>
                      
                      
                      <div class="form-group">
                        <label for="file_path">Joindre Courrier *</label>
                        <input id="file_path" class="form-control" name="file_path" type="file" required="required" style="background: white;">
                      </div>

                      

                        
                       
                      
                     <div id="suiv"  class="form-group form-float">
                          <label class="form-label">Suivie Courrier *</label>
                          <div class="form-line" style="background: white;">
                        <select  class="form-control" name="suivie"  style="background: white;" required="required">
                 <option>-- Selectionnez</option>
                            @foreach($departements as $departement)
                           
                                <option value="{{$departement->id}}">{{$departement->nom}}</option>
                                
                            @endforeach 
</select>
</div>
</div>


                       

                    

                   

                         </div>
                      </div>
                      
                      
                      
                      <button class="btn btn-primary" type="submit" value="Submit"> Enregistrer </button>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
          </div>
          </div>
</div><!-- sh-pagebody -->


<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>

<script src="jquery.js"></script>
<script>


$(document).ready(function(){
  var suiv=$('#suiv');
$('#type_courrier').change(function() {
  var idType_courrier=($(this).val());
if(idType_courrier=="Arrivée"){
suiv.hide ();

}
else{
 suiv.show();
}

});

} );
</script>





          @stop