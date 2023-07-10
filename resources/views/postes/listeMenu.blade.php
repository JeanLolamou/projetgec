@extends('pages.Default')
@section('content')





  <div class="sh-pagetitle">
        <div class="input-group">
          <input type="search" class="form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn"><i class="fa fa-search"></i></button>
          </span><!-- input-group-btn -->
        </div><!-- input-group -->
        <div class="sh-pagetitle-left">
          <div class="sh-pagetitle-icon"><i class="icon ion-ios-list"></i></div>
          <div class="sh-pagetitle-title">
            
            <h2>Liste des Menus</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->
      <div class="sh-pagebody">

        <div class="card bd-primary mg-t-20">
          <div class="card-header bg-primary tx-white">Liste des Menus</div>
          <div class="card-body pd-sm-30">
           <!--  <p class="mg-b-20 mg-sm-b-30">Searching, ordering and paging goodness will be immediately added to the table, as shown in this example.</p> -->

            <div class="table-wrapper">
              <table id="datatable1" class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th class="wd-15p">id</th>
                    <th class="wd-15p">Nom du Menu</th>
                    <th>Actions</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach($menus as $item)
                  <tr>
                    <td>{{$loop->iteration}} </td>
                    <td>{{$item->menu_name}}</td>
                    <td>
                      <a href="" title="Modifier un Menu"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier</button></a>
                    </td>
                    
                  </tr>
                  @endforeach
                  
                    
                </tbody>
              </table>
            </div><!-- table-wrapper -->
          </div><!-- card-body -->
        </div><!-- card -->

      </div><!-- sh-pagebody -->
     
    
    @endsection

    