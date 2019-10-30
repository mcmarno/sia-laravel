@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Dosen</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Detail Dosen</li>
          </ol>
@stop
@section('content')
          
          <div class="row">
            <div class="col-md-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Data Dosen</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                 <?php foreach ($dosen as $itemDosen);  ?>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-3">
                      <p align="center">
                        <img src="{{ URL::asset('images/dosen/'.$itemDosen->photo) }}" alt="User Image">
                        <a class="users-list-name" href="#">{{$itemDosen->dsnNama}}</a>
                        <span class="users-list-date">Dosen Tetap</span>
                      </p>
                    </div><!-- /.col -->
                    <div class="col-md-8">
                     <table id="dataKurikulum" class="table table-bordered table-hover">                    
                      <tbody>
                      
                        <tr>
                          <td>NIDN</td>
                          <td>{{$itemDosen->dsnNidn }}</td>
                        </tr>
                        <tr>
                          <td>NIP</td>  
                          <td>{{$itemDosen->dsnNip}}</td>
                        </tr>
                        <tr>
                          <td>Nama</td> 
                          <td>{{$itemDosen->dsnNama}}</td>
                        </tr>
                        <tr>
                          <td>Jenis Kelamin</td>
                          <td>{{$itemDosen->dsnJenisKelamin}}</td>
                        </tr>
                        <tr>
                          <td>No Telepon</td>
                          <td>{{$itemDosen->dsnNoTelp}}</td>
                        </tr>
                        <tr>
                          <td>Alamat</td>
                          <td>{{$itemDosen->dsnAlamat}}</td>
                        </tr>
                        <tr>
                          <td>Program Studi</td> 
                          <td>{{$itemDosen->prodiNama}}</td> 
                        </tr>
                        
                        
                      </tbody>
                      
                    </table>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
                 
              </div>
            </div>
                       
          </div><!-- /.row -->

@endsection
@section('script')

    <script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
      $(function () {

        $('#dataKurikulum').DataTable({"pageLength": 25});

      });

    </script>

@endsection