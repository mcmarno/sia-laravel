@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Mahasiswa</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Detail Mahasiswa</li>
          </ol>
@stop
@section('content')
          
          <div class="row">
            <div class="col-md-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Data Mahasiswa</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                 <?php foreach ($mahasiswa as $itemMahasiswa);  ?>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-3">
                      <p align="center">
                        <img src="{{ URL::asset('images/mahasiswa/'.$itemMahasiswa->photo) }}" alt="User Image">
                        <a class="users-list-name" href="#">{{$itemMahasiswa->mhsNama}}</a>
                        <span class="users-list-date">{{$itemMahasiswa->Nim}}</span>
                      </p>
                    </div><!-- /.col -->
                    <div class="col-md-8">
                     <table id="dataMahasiswa" class="table table-bordered table-hover">                    
                      <tbody>

                         <tr>
                          <td>NIK</td>
                          <td>{{$itemMahasiswa->mhsNik}}</td>
                        </tr>
                         <tr>
                          <td>Nomer Pendaftran</td>
                          <td>{{$itemMahasiswa->mhsNomerPendaftaran}}</td>
                        </tr>
                        <tr>
                          <td>NIM</td>
                          <td>{{$itemMahasiswa->Nim}}</td>
                        </tr>
                        <tr>
                          <td>Nama</td>  
                          <td>{{$itemMahasiswa->mhsNama}}</td>
                        </tr>
                         <tr>
                          <td>Jenis Kelamin</td>
                          <td>{{$itemMahasiswa->mhsJenisKelamin}}</td>
                        </tr>
                        <tr>
                          <td>Agama</td>
                          <td>{{$itemMahasiswa->mhsAgama}}</td>
                        </tr>
                         <tr>
                          <td>Tempat Lahir</td>
                          <td>{{$itemMahasiswa->mhsTempatLahir}}</td>
                        </tr>
                         <tr>
                          <td>Tanggal Lahir</td>
                          <?php $a = $itemMahasiswa->mhsTanggalLahir;
                          $tanggal = date('d-m-Y', strtotime($a)); ?>
                          <td><?php echo $tanggal ?></td>
                        </tr>
                         <tr>
                          <td>Alamat</td>
                          <td>{{$itemMahasiswa->mhsAlamat}}</td>
                        </tr>
                         <tr>
                          <td>No Telepon</td>
                          <td>{{$itemMahasiswa->mhsNoTelp}}</td>
                        </tr>
                         <tr>
                          <td>Status</td>
                          <td>{{$itemMahasiswa->mhsStatusNikah}}</td>
                        </tr>
                        <tr>
                          <td>Program Studi</td> 
                          <td>{{$itemMahasiswa->prodiNama}}</td>
                        </tr>                        
                        
                        <tr>
                          <td>Angkatan</td> 
                          <td>{{$itemMahasiswa->mhsAngkatan}}</td>                        
                        </tr>
                         <tr>
                          <td>Golongan</td> 
                          <td>{{$itemMahasiswa->mhsGolongan}}</td>                        
                        </tr>
                        <tr>
                          <td>Kelompok</td> 
                          <td>{{$itemMahasiswa->mhsKelompok}}</td>                        
                        </tr>
                         <tr>
                          <td>Asal Sekolah</td> 
                          <td>{{$itemMahasiswa->mhsAsalSekolah}}</td>                        
                        </tr>
                         <tr>
                          <td>Nama Orang Tua</td>
                          <td>{{$itemMahasiswa->mhsNamaOrtu}}</td>
                        </tr>
                         <tr>
                          <td>Alamat Orang Tua</td>
                          <td>{{$itemMahasiswa->mhsAlamatOrtu}}</td>
                        </tr>
                         <tr>
                          <td>Pekerjaan Orang Tua</td>
                          <td>{{$itemMahasiswa->mhsPekerjaanOrtu}}</td>
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