@extends('layout.main')
@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">User</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Detail User</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    

     <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="page-title">
            <div class="row">
              <div class="col-6 order-md-1 order-last">
                <div style="float: right">
                <a href="{{route('index')}}" class="btn btn-warning mb-3"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                </div>
              </div>
            </div>
          </div>
           
                <div class="row">
                  <!-- left column -->
                  <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title"> Detail Data </h3>
                      </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form>
                        
                        <div class="card-body">
                          @if ($data->image)
                              <img src="{{asset('storage/photo-user/' . $data->image)}}" width="100px" height="100px" style="margin-bottom:1rem">
                          @endif
                          
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email </label>
                            <p>{{$data->email}}</p>
                          </div>
                          <div class="form-group">
                              <label for="exampleInputEmail1">Nama </label>
                              <p>{{$data->name}}</p>
                            </div>
                        </div>
                        <!-- /.card-body -->        
                    </div>
                    <!-- /.card -->
                  </div>
                  <!--/.col (left) -->
                </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>
@endsection