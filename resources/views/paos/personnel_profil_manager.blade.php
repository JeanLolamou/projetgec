@extends('pages.Default')
@section('content')
         <!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script> -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
         <style type="text/css">
           .container{
    margin-top:20px;
}
.image-preview-input {
    position: relative;
  overflow: hidden;
  margin: 0px;    
    color: #333;
    background-color: #fff;
    border-color: #ccc;    
}
.image-preview-input input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  padding: 0;
  font-size: 20px;
  cursor: pointer;
  opacity: 0;
  filter: alpha(opacity=0);
}
.image-preview-input-title {
    margin-left:2px;
}
         </style>
        
 <div class="sh-pagetitle">
        <div class="input-group">
          
        </div><!-- input-group -->
       <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="fa fa-user"></i></div>
 <div class="sh-pagetitle-title">
            
            <h2>Profil</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->

      <!-- <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-user"></i>Profil</h3>
          <ol class="breadcrumb">
             <li><i class="fa fa-home"></i><a href="Liste-activités">Accueil</a></li>  
             <li><i class="fa fa-user"></i>Profil</li>      
          </ol>
        </div>
      </div> -->
      <div class="sh-pagebody">

        @foreach($editusers as $key =>$edituser)

      

      <div class="row profile">
        
      
        
        <div class="col-md-10">
        
                    <div class="panel panel-default">                               
                        <div class="panel-heading">
                            <h2><img src="{{asset('images/update.jpg')}}"  style="height: 60px;"><strong>Modifier Votre Profil</strong></h2>
                        </div>
                        <div class="panel-body">
                           <form action="{{ route('modifierprofil') }}" method="post" enctype="multipart/form-data" class="form-vertical hover-stripped" role="form">
                       {{ csrf_field() }}
                        {{ method_field('PUT') }}
                       <input type="hidden" name="id" value="{{ $edituser->id }}">
                                <div class="form-group">
                                    <label class="control-label"><strong>Nom</strong></label>
                                    <input name="name" type="text" class="form-control" value="{{$edituser->name}}" >
                                     
                                </div>
                              
                                <div class="form-group">
                                    <label class="control-label"><strong>Email</strong></label>
                                    <input name="email" type="email" class="form-control" value="{{$edituser->email}}">
                                </div>
                                
               

                              
                                        
                                <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </div>

                                 <div class="form-group pull-left">
                                    <a href="#" data-toggle="modal" data-target="#pass" class="btn btn-danger">Modifier le mot de passe?</a>
                                </div>

                                
                                        
                            </form>
                        </div>
                    </div>


                     <!-- Mot de pass -->

                    <div class="modal fade" id="pass">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Mot de passe</h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <p>   <form action="{{ route('modifierpassword') }}" method="post" enctype="multipart/form-data" class="form-vertical hover-stripped" role="form">
            {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="id" value="{{ $edituser->id }}">
                         <div class="form-group">
                             <label for="direction-w1">Nouveau mot de passe</label>
                          <input type="password" name="password" class="form-control" placeholder="Entrez Mot de passe" required="">
                          
                        </div>

                       

            </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button class="btn btn-primary" type=" button submit"><i class="fa fa-trash"></i> VALIDER</button>
                        <input type="hidden" name="modif_role" value="0">
          </form>
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


                 
          
        </div><!--/.col-->
      
      </div><!--/.row profile-->    
      @endforeach
       <script type="text/javascript">
        $(document).on('click', '#close-preview', function(){ 
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
        }, 
         function () {
           $('.image-preview').popover('hide');
        }
    );    
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse"); 
    }); 
    // Create the preview image
    $(".image-preview-input input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);            
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }        
        reader.readAsDataURL(file);
    });  
});
      </script>
         @stop