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
                  <li class="breadcrumb-item active">Edit User</li>
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
            <form action="{{route('user.update', ['id' => $data->id])}}" method="POST" enctype="multipart/form-data">
              @method('put')
                @csrf
                <div class="row">
                  <!-- left column -->
                  <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Form Edit Data </h3>
                      </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form>
                        
                        <div class="card-body">
                          @if ($data->image)
                              <img src="{{asset('storage/photo-user/' . $data->image)}}" width="100px" height="100px" style="margin-bottom:1rem">
                          @endif
                          <div class="form-group">
                            <input type="file" name="photo" class="form-control">
                            
                            <small class="text-danger"> Upload photo jika ingin menggantinya</small>
                            @error('photo')
                                <small>{{$message}}</small>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email </label>
                            <input type="email" name="email" class="form-control" value="{{$data->email}}" id="exampleInputEmail1" placeholder="Enter email">
                            @error('email')
                                <small>{{$message}}</small>
                            @enderror
                          </div>
                          <div class="form-group">
                              <label for="exampleInputEmail1">Nama </label>
                              <input type="text" name="nama" class="form-control" value="{{$data->name}}" id="exampleInputEmail1" placeholder="Enter name">
                              @error('nama')
                                <small>{{$message}}</small>
                            @enderror
                            </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            @error('password')
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