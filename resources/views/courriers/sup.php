<a class="btn btn-danger" data-toggle="modal" href="javascript:delete_post({{route('rapportdelete', $rapports->id)}}) "  title="Supprimer" data-rel="tooltip">
                      <i class="fa fa-trash-o "></i>

                    </a>



<script type="text/javascript">
  CKEDITOR.replace( 'rapport' );
                     function delete_post(url){

    swal({
      title: "Are you sure?"
      text: "Once deleted, you will not be able to recover this post!",
      icon:"warning",
      buttons:true,
      dangerMode:true,
    })
    .then((willDelete)=>{
      if(willDelete) {
        $('#post_delete_form').attr('action',url);
        $('#post_delete_form').submit();
      }
    } );
  }
  </script>