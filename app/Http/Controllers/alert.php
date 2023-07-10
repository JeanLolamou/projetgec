@if(session()->has('success'))
        <div class="alert alert-fill-primary" role="alert" style="background:green">
           <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color:white">&times;</a>
                    <i class="mdi mdi-alert-circle"></i>
                   {{session()->get('success')}}
                  </div>

                 <!--    #082c10   -->   
               @endif