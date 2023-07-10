//Controller
foreach ($request->direction as $value) {
  if((Auth::user()->user_role==2)||(Auth::user()->user_role==8)){
     $courrier = Affectation::create(['user_dg'=>Auth::user()->id,'courrier_id'=>$request->id,'date_affectation'=>date("Y-m-d H:i:s"),'direction_affectation'=> $value,'lu'=>"non",'commentaire'=>$request->commentaire,'statut_courrier'=>'Affecté']);

  }

//Vue
   <div class="col-md-8" id="selectdirection">
   <div class="form-group" id="affectdirection"> 
  <label class="control-label" for="direction">Affecter à une ou plusieurs Directions</label>
  <select class=" form-control js-example-basic-multiple" name="direction[]" multiple="multiple">
  <option>-- Selectionnez une ou plusieurs directions</option>
                            @foreach($directions as $direction)
                            @if($direction->id!=1)
                                <option value="{{$direction->id}}">{{$direction->nom}}</option>
                                @endif
                            @endforeach 
</select>
</div>
</div>