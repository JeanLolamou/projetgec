@extends('pages.Default')
@section('content')
          <div class="main-panel">
        <div class="content-wrapper">
           @if(session()->has('success'))
        <div class="alert alert-fill-primary" role="alert" style="background: green">
           <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color: white">&times;</a>
                    <i class="mdi mdi-alert-circle"></i>
                    <strong>Succés!</strong> {{session()->get('success')}}
                  </div>

                 <!--    #082c10   -->   
               @endif

               <div class="sh-pagetitle">
        <div class="input-group">
          
        </div><!-- input-group -->
       <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="icon ion-person-add"></i></div>
 <div class="sh-pagetitle-title">
            
            <h2>Choisir les éléments du groupe:</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->

              
           @if(count($utilisateurs)==0)
          <h4 style="color: green; font-weight: bolder;">  La liste est vide</h4>
         <img src="{{asset('images/listevide.gif')}}"/>
          @endif
          @if((count($utilisateurs)!=0)&&(count($departements)!=0))
   
                     <div class="row" >
            <div class="col-md-6" id="groupe">
                        <div class="form-group" id="groupe"> 
                          @if(session()->has(' errore'))
        <div class="alert alert-fill-primary" role="alert" style="background: red">
           <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color: white">&times;</a>
                    <i class="mdi mdi-alert-circle"></i>
                    <strong></strong> {{session()->get(' errore')}}
                  </div>


                 <!--    #082c10   -->   
               @endif
                  </div>
                     </div>
                        </div>
                           <form id="form_validation" method="POST" class="pt-3" action="{{ route('liste_groupe') }}">
                                      {{ csrf_field() }}
                                      <div class="row">
                                        
                         <!--  <label class="control-label" for="typeannotatio">Choisir un Groupe</label> -->
                          <div class="col-md-6">
<select name="groupe" id="typeannotatio" autocomplete="off" class="form-control" required="required">
  <option>-- Selectionnez</option>
                           @foreach($departements as $key =>$departement)
                                <option value="{{$departement->id}}">{{$departement->nom_groupe }}</option>
                            @endforeach 
</select>
</div>
<div class="col-md-4">
 <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit"> Afficher la liste</button>
</div>
</div>
</form>
</div>
                     
         

             
             @endif
          </div>
        </div>
          @stop