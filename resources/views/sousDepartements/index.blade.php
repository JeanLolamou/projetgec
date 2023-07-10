@extends('pages.Default')
@section('content')





	<div class="sh-pagetitle">
        <div class="input-group">
        <!--   <input type="search" class="form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn"><i class="fa fa-search"></i></button>
          </span>-->
        </div><!-- input-group -->
        <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="icon ion-ios-list"></i></div>
          <div class="sh-pagetitle-title">
            
            <h2>Liste des Sous Departements</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->
      <div class="sh-pagebody">

        <div class="card bd-primary mg-t-20">
         <!--  <div class="card-header bg-primary tx-white">Liste des Sous Départements</div> -->
          <div class="card-body pd-sm-30">
           <!--  <p class="mg-b-20 mg-sm-b-30">Searching, ordering and paging goodness will be immediately added to the table, as shown in this example.</p> -->

            <div class="table-responsive mg-t-25">
              <table id="datatable1" class="table display responsive nowrap">
                <thead class="bg-info">
                  <tr>
                    <th class="wd-15p">id</th>
                    <th class="wd-15p">Nom du Sous Département</th>
                     <th class="wd-15p">Nom du Département </th>
                     <th>Actions</th>
                    
                  </tr>
                </thead>
                <tbody>
                	@foreach($sousdepartements as $item)
                  <tr>
                    <td>{{$loop->iteration}} </td>
                    <td>{{$item->sousdepartement_name}}</td>
                    <td>{{$item->nom}}</td>
                    <td>
                      <a href="{{ Route('ModifierSousdepartement',$item->id) }}" title="Modifier un Sous Département"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier</button></a>
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

    