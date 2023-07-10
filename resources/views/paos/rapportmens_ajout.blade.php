@extends('pages.Default')
@section('content')

        @if(session()->has('message'))
      <div class="row">
     <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Succés!</strong> {{session()->get('message')}}.
              </div>
              </div>
              @endif 
              <div class="sh-pagebody">
               <div class="card-header bg-primary tx-white">Ajouter PAO</div>   

 <div class="row">
        <div class="col-lg-12">
         
          <ol class="breadcrumb">
             <div class="col-sm-6 col-md-3 ">
              
                <a style="text-decoration:none" href="Liste-activités"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i> Accueil</button></a>
                
              </div><!-- col-sm -->

                 <div class="col-sm-6 col-md-3 ">
              
                <a style="text-decoration:none" href="/Liste-rapportmens"><button class="btn btn-primary btn-block mg-b-10">

            <span class="title"></span><i class="fa fa-home"></i> Rapports Mensuels</button></a>
                
              </div><!-- col-sm -->

            
          </ol>
        </div>
      </div>



        

     <div class="row">
        
         <div class="col-md-12" style="">
                 
                    <div class="panel panel-default">                               
                        <div class="panel-heading">
                            <h2 style="font-size:20pt;"><i class="fa fa-edit red"></i><strong>Ajout Rapport Mensuel</strong></h2>
                             
                        </div>
                        <div class="panel-body">
                          <form method="POST" action="ajoutrapportmen" enctype="multipart/form-data">
                        @csrf
         <div class="card"><div class="card-body">              

 <div class="form-group">
                        <div class="row">

                            <div class="col-lg-4">
                           <label for="type_rapport"><b>Type Rapport *</b></label>
                        <select id="type_rapport" name="type_rapport" autocomplete="off" class="form-control" required="required" >
                    <option value="">Selectionner</option>
                    <option value="Hebdomadaire">Hebdomadaire</option>
                    <option value="Mensuel">Mensuel</option>
                    
                  </select>
                   </div>


                    <div class="col-lg-4">
                           <label for="mois"><b>Mois *</b></label>
                        <select id="mois" name="mois" autocomplete="off" class="form-control" required="required" >
                    <option value="">Selectionner</option>
                    <option value="Janvier">Janvier</option>
                    <option value="Février">Février</option>
                    <option value="Mars">Mars</option>
                    <option value="Avril">Avril</option>
                    <option value="Mai">Mai</option>
                    <option value="Juin">Juin</option>
                    <option value="Juillet">Juillet</option>
                    <option value="Août">Août</option>
                    <option value="Septembre">Septembre</option>
                    <option value="Octobre">Octobre</option>
                    <option value="Novembre">Novembre</option>
                    <option value="Décembre">Décembre</option>
                    
                  </select>
                   </div>

                   <div id="semaine" class="col-lg-4">
                           <label for="semaine"><b>Semaine *</b></label>
                        <select  name="semaine" autocomplete="off" class="form-control" >
                    <option value="">Selectionner</option>
                    <option value="Semaine1">Semaine 1</option>
                    <option value="Semaine2">Semaine 2</option>
                    <option value="Semaine3">Semaine 3</option>
                    <option value="Semaine4">Semaine 4</option>
                    
                  </select>
                   </div>


                   </div>
                   </div>



                        <div class="form-group">
                        <div class="row">
                         <!--  <div class="col-lg-6">
                           <div class="form-group">
                            <label for="textarea-input">Responsable</label>
                            <input type="text" name="responsable" class="form-control">
                        </div> </div> --> 

                        <div class="col-lg-6">
                            <label class="control-label" for="input-small"><b> Titre du Rapport Mensuel</b></label>
                           <input type="text" id="input-small" name="activite_pao" class="form-control input-sm" placeholder="">
                            </div>

                       <div class="col-lg-6">

                            
                            <label for="textarea-input"><b>Date de Réalisation</b></label>
                            <input type="date" name="date" class="form-control">
                        </div> 
                      </div>
                      </div></div></div>

                        <!-- <div class="form-group">
                            <label class="control-label" for="input-small">Projet</label>
                           <input type="text" id="input-small" name="activite_pao" class="form-control input-sm" placeholder="">
                                </div> -->

                                

                                 <!-- <div class="row">
                          
                        <div class="col-lg-5">
                            <div class="form-group">
                                 <label for="textarea-input">Delai</label>
                            <input type="date" name="delai" class="form-control">
                        </div> </div>
                        </div> -->
<div class="card"><div class="card-body">  
                         <div class="form-group">
                            <label for="textarea-input"><b>Activités Mensuelles réalisées</b></label>
                            <div class="">

<!-- <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor"></textarea> -->

                                <textarea  name="rapport"  id="summary-ckeditor" rows="15" class="form-control" placeholder="Faites votre rapport ici.."></textarea>
                            </div>
                        </div>  

                        <div class="form-group">
                            <label for="textarea-input"><b> Priorités pour le mois prochain</b> </label>
                            <div class="">

<!-- <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor"></textarea> -->

                                <textarea  name="rapportplan"  id="summary-ckeditor1" rows="15" class="form-control" placeholder="Faites votre rapport planifié ici.."></textarea>
                            </div>
                        </div> 

                         <div class="form-group">
                            <label for="textarea-input"><b> Qu'est-ce qui va bien?</b> </label>
                            <div class="">

<!-- <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor"></textarea> -->

                                <textarea  name="positif"  id="summary-ckeditor2" rows="15" class="form-control" placeholder="Notez les aspects positifs ici.."></textarea>
                            </div>
                        </div> 

                         <div class="form-group">
                            <label for="textarea-input"><b> Quels sont les principaux défis?</b> </label>
                            <div class="">

<!-- <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor"></textarea> -->

                                <textarea  name="defis"  id="summary-ckeditor3" rows="15" class="form-control" placeholder="Rédigez les principaux défis ici.."></textarea>
                            </div>
                        </div> 

                         <div class="form-group">
                            <label for="textarea-input"><b> Que faire pour relever ces défis?</b> </label>
                            <div class="">

<!-- <textarea class="form-control" id="summary-ckeditor" name="summary-ckeditor"></textarea> -->

                                <textarea  name="solution"  id="summary-ckeditor4" rows="15" class="form-control" placeholder="Mentionnez vos solutions ici.."></textarea>
                            </div>
                        </div> 
      
      
                              <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </div>          
                                
                                        
                            </form>
                        </div>
                    </div>

                  
                        </div>
                    </div>
          
        </div><!--/.col-->
      
      </div><!--/.row profile-->  
</div>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
  <script src="jquery.js"></script>
<script>
CKEDITOR.replace( 'summary-ckeditor' );
CKEDITOR.replace( 'summary-ckeditor1' );
CKEDITOR.replace( 'summary-ckeditor2' );
CKEDITOR.replace( 'summary-ckeditor3' );
CKEDITOR.replace( 'summary-ckeditor4' );

$(document).ready(function(){
  var semaine=$('#semaine');
$('#type_rapport').change(function() {
  var idType_courrier=($(this).val());
if(idType_courrier=="Mensuel"){
semaine.hide ();

}
else{
 semaine.show();
}

});

} );

</script>
   
         @stop