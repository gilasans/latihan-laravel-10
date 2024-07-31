@extends('layout.main')
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
                  <li class="breadcrumb-item active">Dashboard v1</li>
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
                    <a href="{{route('assets')}}?export=pdf" class="btn btn-danger ml-3 mb-3"><i class="fas fa-plus"></i> Export PDF</a>
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Responsive Hover Table</h3>
      
                      <div class="card-tools">
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
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Fhoto</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Asset</th>
                            <th>Jumlah asset</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                
                            <tr>
                              <td>{{$loop->iteration}}</td>
                              <td><img src="{{asset('storage/photo-user/'.$d->image)}}" alt="" style="width:5rem; height:5rem"></td>
                              {{-- untuk menjalankan nya harus pake syntak php artisan storage:link --}}
                              <td>{{$d->ktp->nik ?? ''}}</td> 
                              {{-- ?? '' (ternery) berguna untuk jika ada yang kosong maka tetep tampil tidak error--}}
                              <td>{{$d->name}}</td>
                              <td>
                                <ul>
                                    @foreach($d->assets as $asset)
                                    <li>{{$asset->nama_asset}}</li>
                                    @endforeach
                                </ul>
                              </td>
                              <td>{{count($d->assets)}}</td>
                            
                            @endforeach
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