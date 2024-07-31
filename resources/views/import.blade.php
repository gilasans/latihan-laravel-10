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
                  <li class="breadcrumb-item active">Tambah User</li>
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
          <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <!-- left column -->
              <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Form import data</h3>
                      </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form>
                        <div class="card-body">
                         
                          <div class="form-group">
                            <label for="exampleInputEmail1">File </label>
                            <input type="file" name="photo" class="form-control" id="exampleInputphoto1" >
                            @error('photo')
                                <small>{{$message}}</small>
                            @enderror
                          </div>
                          
                        </div>
                        <!-- /.card-body -->
        
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                    </div>
                    <!-- /.card -->
                  </div>
                  <!--/.col (left) -->
                </div>
            </form>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>
@endsection