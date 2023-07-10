@extends('pages.Default')
@section('content')





	<div class="sh-pagetitle">
		<form  action="" class="col-5" >
				<div class="form-group">
					
					
          
				</div>
		</form>
        
        <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="icon ion-ios-list"></i></div>
          <div class="sh-pagetitle-title">
            
            <h2>Liste des Priorités</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->
      <div class="sh-pagebody">



        <div class="card bd-primary mg-t-20">

        <!--   <div class="card-header bg-primary tx-white">Liste des Priorités</div> -->
            <div class="table-responsive mg-t-25">
              <table id="datatable1" class="table display responsive nowrap">
                <thead class="bg-info">
                  <tr>
                    <th class="wd-15p">id</th>
                    <th class="wd-15p">Nom de la Priorité</th>
                    <th class="wd-15p">Couleur</th>
                    <th>Actions</th>
                    
                  </tr>
                </thead>
                <tbody>
                	@foreach($priorites as $item)
                  <tr>
                    <td>{{$loop->iteration}} </td>
                    <td>{{$item->priorite_name}}</td>
                     <td style="color: black"><span class=" card card-body {{$item->couleur_name}}"></span></td>
                    <td>
                    	<a href="{{route('editPriorite',$item->id)}}" title="Modifier une Priorite"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier</button></a>
                    </td>
                    
                  </tr>
                  @endforeach
                  
                    
                </tbody>
              </table>
            </div><!-- table-wrapper -->
          </div><!-- card-body -->
        </div><!-- card -->

      </div><!-- sh-pagebody -->

       <script src="{{asset('assets/lib/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/lib/popper.js/popper.js')}}"></script>
    <script src="{{asset('assets/lib/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
    <script src="{{asset('assets/lib/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
    <script src="{{asset('assets/lib/select2/js/select2.min.js')}}"></script>

    <script src="{{asset('assets/lib/select2/js/select2.min.js')}} ../js/shamcey.js"></script>
    <script>
      $(function() {
        'use strict';

        $('#datatable1').DataTable({
          responsive: false,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });

        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true
        });

        // // Select2
        // $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>
      
    @endsection

    