@extends('pages.Default')
@section('content')

<table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                  <tr style="background: #0b0e69;color: white;">
                    <th>Date</th>
                    <th>Direction</th>
                    <th>Rapport</th>
                    <th>Responsable</th>
                    <th>Actions</th>
                  </tr>
                </thead>   
                <tbody>   
                 @foreach ($rapport as $rapports)            
                <tr>
                  <td>{{(new DateTime($rapports->date))->format("d/m/Y")}}</td>
                  <td>{!!$rapports->nom!!}</td>
                  <td>{!!$rapports->rapport!!}</td>
          
                  <td>{!!$rapports->responsable!!}</td>
                  <td>
                    <a class="btn btn-success" href="{{ route ('rapportshow', $rapports->id)}}" title="Details" data-rel="tooltip">
                      <i class="fa fa-search-plus "></i>                                            
                    </a>
                    <a class="btn btn-info" href="{{ route ('editRapport', $rapports->id)}}" title="Modifier" data-rel="tooltip">
                      <i class="fa fa-edit "></i>                                            
                    </a>

                     <a target="_blank" href="{{route('pdfrapportunique', $rapports->id)}}" class="btn btn-sm btn-warning" title="Imprimer" data-rel="tooltip"><i class="fa fa-print"></i></a>
                   
                  
                    <a class="btn btn-danger" data-toggle="modal" data-target="#myModalexpo{{$rapports->id}}" title="Supprimer" data-rel="tooltip">
                      <i class="fa fa-trash-o "></i>

                    </a>
                     <!-- Suppression -->

                    <div class="modal fade" id="myModalexpo{{$rapports->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Voulez-vous vraiment supprimer cet element ?</h4>
        </div>
        <div class="modal-body">
          <p>Cliquer sur SUPPRIMER si c'est le cas !</p>
        </div>
        <div class="modal-footer">
          <form action="{{ route ('Rapport.update', $rapports->id)}}" method="post" >
               {{ csrf_field() }}
              {{ method_field('PUT') }}
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button class="btn btn-primary" type=" button submit"><i class="fa fa-trash"></i> SUPPRIMER</button>
                        <input type="hidden" name="sup" value="0">
          </form>
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
                  </td>
                </tr>
                @endforeach
                
                </tbody>
              </table>   

              <script >
          fetch_customer_data();
          $(document).ready(function(){
          function fetch_customer_data(query='')
          {
            $.ajax({
              url:"{{route('Live_search.action')}}",
              method:'GET',
              data:{query:query},
              dataType:'json'
              success:function(data)
              {

                $('tbody').html(data.table_data);
                $('#total_records').text(data.total_data);
              }

            })
          }

                   });
        </script>        

              @stop