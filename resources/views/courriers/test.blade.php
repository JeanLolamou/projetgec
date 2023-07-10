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
               <div class="card-header bg-primary tx-white">Tester</div>
         

               <div class="row grid-margin">
            <div class="col-lg-12 col-md-12">
              <div class="card" style="background:  #FFFFFF;">
                <div class="card-body">
                  <h4 class="card-title"></h4>
                  <form class="" id="signupForm" method="post" action="/courierArriv" enctype="multipart/form-data">
                     {{ csrf_field() }}
                    <fieldset>
                      <input type="hidden" name="categorie" value="Autres">
                     
                      
                      
                      <div class="form-group">
                        <label for="file_path">Joindre Courrier *</label>
                        <input id="file_path" class="form-control" name="file_path" type="file" required="required" style="background: white;">
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










          @stop