@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Mahasiswa</li>
          </ol>
@stop
@section('content')

        <div class="row">
            <!--<div class="col-md-6">-->
                <div class="uk-alert uk-alert-success" data-uk-alert>
                    <a href="" class="uk-alert-close uk-close"></a>
                    <p>{{  isset($successMessage) ? $successMessage : '' }}</p>
                     @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                </div>
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">Daftar Mahasiswa <a class="btn btn-success btn-flat btn-sm" id="tambahMahasiswa" title="Tambah"><i class="fa fa-plus"></i></a></h3>
                  </div>
                </div>
          
         <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Master Mahasiswa</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="dataMahasiswa" class="table table-bordered table-hover">
                    <thead>
                      <tr>                        
                        <th>NIM</th>
                        <th>NAMA</th>                           
                        <th>Kelompok</th>
                        <th>Angkatan</th>  
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php foreach ($mahasiswa as $itemMahasiswa):  ?>
                      <tr>
                        <td>{{$itemMahasiswa->Nim}}</td>
                        <td>{{$itemMahasiswa->mhsNama}}</td>
                        <td><font size="4"><span class="{{{($itemMahasiswa->mhsKelompok=='REGULER') ? 'label label-info' : 'label label-warning'}}}">{{$itemMahasiswa->mhsKelompok}}</span></font></td>                 
                        <td>{{$itemMahasiswa->mhsAngkatan}}</td>                        
                        <td><a href="{{{ URL::to('mahasiswa/'.$itemMahasiswa->Nim.'/detail') }}}">
                              <span class="label label-info"><i class="fa fa-list"> Detail </i></span>
                            </a>
                             <a href="{{{ URL::to('mahasiswa/'.$itemMahasiswa->Nim.'/edit') }}}">
                              <span class="label label-warning"><i class="fa fa-edit"> Edit </i></span>
                            </a>
                            <a href="{{{ action('Mahasiswa\MahasiswaController@hapus',[$itemMahasiswa->Nim]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus Dosen {{{($itemMahasiswa->Nim).' - '.$itemMahasiswa->mhsNama }}}?')">
                              <span class="label label-danger"><i class="fa fa-trash"> Delete </i></span>
                            </a>  
                        </td>
                      </tr>
                      <?php endforeach  ?> 
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                          <h4 class="modal-title" id="myModalLabel">Mahasiswa - Tambah</h4>
                      </div>
                      <div class="modal-body">
           
                          <form id="formMahasiswa" class="form-horizontal" role="form" method="POST" action="{{ url('/mahasiswa/tambah') }}" enctype="multipart/form-data">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
           
                              <div class="form-group">
                                  <label class="col-md-4 control-label">NIK </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsNik">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Nomer Pendaftaran </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsNomerPendaftaran">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">NIM </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsNim">
                                      <small class="help-block"></small>
                                  </div>
                              </div>
  
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Nama </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsNama">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Jenis Kelamin </label>
                                  <div class="col-md-6 has-error">
                                      <select class="form-control" name="mhsJenisKelamin">
                                          <option value="Laki - Laki">Laki - Laki</option>
                                          <option value="Perempuan">Perempuan</option>
                                      </select>
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Agama </label>
                                  <div class="col-md-6 has-error">
                                      <select class="form-control" name="mhsAgama">
                                          <option value="Islam">Islam</option>
                                          <option value="Kristen">Kristen</option>
                                          <option value="Katholik">Katholik</option>
                                          <option value="Hindu">Hindu</option>
                                          <option value="Budha">Budha</option>
                                          <option value="Khonghucu">Khonghucu</option>
                                      </select>
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Tempat Lahir </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsTempatLahir">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Tanggal Lahir </label>
                                  <div class="col-md-6">
                                      <input type="date" class="form-control" name="mhsTanggalLahir">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Alamat </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsAlamat">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">No Telp </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsNoTelp">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                               <div class="form-group">
                                  <label class="col-md-4 control-label">Status Nikah </label>
                                  <div class="col-md-6 has-error">
                                      <select class="form-control" name="mhsStatusNikah">
                                          <option value="Nikah">Nikah</option>
                                          <option value="Belum Nikah">Belum Nikah</option>
                                      </select>
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Program Studi </label>
                                  <div class="col-md-6 has-error">
                                      <select class="form-control" name="mhsProdiKode">
                                          @foreach ($listprogram_studi as $itemprogram_studi)
                                          <option value="{{$itemprogram_studi->prodiKode}}">{{$itemprogram_studi->prodiNama}}</option>
                                          @endforeach
                                      </select>
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Angkatan </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsAngkatan">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Golongan </label>
                                  <div class="col-md-6">
                                      <input type="radio" name="mhsGolongan" value="REGULER" /> REGULER  </p>
                                      <input type="radio" name="mhsGolongan" value="KPT" /> KPT
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Kelompok </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsKelompok">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Kurikulum </label>
                                  <div class="col-md-6 has-error">
                                      <select class="form-control" name="mhsKurId">
                                          @foreach ($listkurikulum as $itemkurikulum)
                                          <option value="{{$itemkurikulum->kurId}}">{{$itemkurikulum->kurNama}}</option>
                                          @endforeach
                                      </select>
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Asal Sekolah </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsAsalSekolah">
                                      <small class="help-block"></small>
                                  </div>
                              </div>


                              <div class="form-group">
                                  <label class="col-md-4 control-label">Nama Orang Tua </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsNamaOrtu">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Alamat Orang Tua </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsAlamatOrtu">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Pekerjaan Orang Tua </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsPekerjaanOrtu">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Pilih Gambar</label>
                                  <div class="col-md-6">
                                  <input type="file" class="form-control" name="photo" id="photo">
                                  </div>
                              </div>                              

                              <div class="form-group">
                                  <div class="col-md-6 col-md-offset-4">
                                      <button type="submit" class="btn btn-primary" id="button-reg">
                                          Simpan
                                      </button>
                                  </div>
                              </div>
                          </form>                       
                      </div>
                  </div>
              </div>
          </div>

@endsection
@section('script')

    <script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
  
    <script>
      $(function () {

        $('#tambahMahasiswa').click(function(){
            $('input+small').text('');
            $('input').parent().removeClass('has-error');
            $('select').parent().removeClass('has-error');

            $('#myModal').modal('show');
           
            //console.log('test');
            return false;
            })

        
        
         
        $(document).on('submit', '#formMahasiswa', function(e) {
        if (fileInput.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        $(img).attr('src', e.target.result);
        }
        reader.readAsDataURL(fileInput.files[0]);
        }
        $('#photo').text(fileInput.files[0].name);  
            e.preventDefault();
             
            $('input+small').text('');
            $('input').parent().removeClass('has-error');           
             
            $.ajax({
                method: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json"
            })
            .done(function(data) {
                console.log(data);
                
                $('.alert-success').removeClass('hidden');
                $('#myModal').modal('hide');
                
                window.location.href='/mahasiswa'; 
            })
            .fail(function(data) {
                console.log(data.responeJSON);
                $.each(data.responseJSON, function (key, value) {
                    var input = '#formMahasiswa input[name=' + key + ']';
                    
                    $(input + '+small').text(value);
                    $(input).parent().addClass('has-error');
                });
            });
        });

       $('#dataMahasiswa').DataTable({"pageLength": 10});

      });

    </script>
   

@endsection

