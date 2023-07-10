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
            <span>Table Styles</span>
            <h2>Data Table</h2>
          </div><!-- sh-pagetitle-left-title -->
        </div><!-- sh-pagetitle-left -->
      </div><!-- sh-pagetitle -->
      <div class="sh-pagebody">

        <div class="card bd-primary mg-t-20">
          <div class="card-header bg-primary tx-white">Basic Responsive DataTable</div>
          <div class="card-body pd-sm-30">
            <p class="mg-b-20 mg-sm-b-30">Searching, ordering and paging goodness will be immediately added to the table, as shown in this example.</p>

            <div class="table-wrapper">
              <table id="datatable1" class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th class="wd-15p">id</th>
                    <th class="wd-15p">Nom de l'utilisateur</th>
                    <th class="wd-15p">Email de l'utilisateur</th>
                    <th class="wd-15p">Téléphone de l'utilisateur</th>
                    <th class="wd-15p">Poste de l'utilisateur</th>
                    <th class="wd-15p">Sous Département</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($users as $item)
                  <tr>
                    <td>{{$loop->iteration}} </td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                     <td>{{$item->telephone}}</td>
                     <td>{{$item->User_poste}}</td>
                     <td>{{$item->sousdepartement_name}}</td>
                     <td>
                      <a href="{{ Route('ModifierUser',$item->id) }}" title="Modifier un utilisateur"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier</button></a>
                    </td>
                    
                  </tr>
                  @endforeach
                  
                    
                </tbody>
              </table>
            </div><!-- table-wrapper -->
          </div><!-- card-body -->
        </div><!-- card -->

      </div><!-- sh-pagebody -->
      <div class="sh-footer">
        <div>Copyright &copy; 2017. All Rights Reserved. Shamcey Dashboard Admin Template</div>
        <div class="mg-t-10 mg-md-t-0">Designed by: <a href="http://themepixels.me">ThemePixels</a></div>
      </div><!-- sh-footer -->
    
    @endsection

    