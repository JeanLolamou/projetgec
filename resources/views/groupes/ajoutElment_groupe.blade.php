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
         <h6 style="text-transform: uppercase;font-weight: bolder;text-align: center;">Choisir les éléments du groupe</h6>
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
                         <form id="form_validation" method="POST" class="pt-3" action="{{ route('ajout_elementduGroupe') }}">
                                      {{ csrf_field() }}

                          <label class="control-label" for="typeannotatio">Choisir un Groupe</label>
                          <select name="groupe" id="typeannotatio" autocomplete="off" class="form-control" required="required">
                          <option>-- Selectionnez</option>
                           @foreach($departements as $key =>$departement)
                                <option value="{{$departement->id}}">{{$departement->nom}}</option>
                            @endforeach 
                         </select>
                          <button class="btn btn-primary" type="submit" value="Submit"> Valider </button>
                     </form>
</div>
                        </div>
         

      
             
             @endif
          </div>
        </div>
          @stop