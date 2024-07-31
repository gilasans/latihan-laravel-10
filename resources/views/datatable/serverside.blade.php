@extends('layout.main')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Data User(Server Side)</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="{{route('user.create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus-circle"></i> Tambah Data</a>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Responsive Hover Table</h3>
      
                      {{-- <div class="card-tools">
                        <form action="{{route('index')}}" method="GET">
                          <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="search" class="form-control float-right" placeholder="Search" value="{{$request->get('search')}}">
        
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                              </button>
                            </div>
                          </div>

                        </form>
                      </div> --}}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap" id="serverSide">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Fhoto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                       
                        </tbody>  
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>
              <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
  </div>
@endsection
@section('script')
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
<script>
  $(document).ready(function () {
  loadData();
});
  function loadData(){
      $('#serverSide').DataTable({
      processing:true;
      pagination:true;
      resvonsive:true;
      searching:true;
      serverSide:true;
      ordering:false;
      ajax:{
          url:"{{route('serverSide')}}",
      },
      columns:[
          {
              data : 'no',
              name : 'no',

          },
          {
              data : 'photo',
              name : 'photo',

          },
          {
              data : 'nama',
              name : 'nama',

          },
          {
              data : 'email',
              name : 'email',

          },
          {
              data : 'action',
              name : 'action',

          },

      ]
    });
  }
</script>
@endsection