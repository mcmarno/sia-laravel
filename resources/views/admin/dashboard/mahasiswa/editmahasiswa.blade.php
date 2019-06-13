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
            <div class="col-md-6">
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
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">Daftar Mahasiswa - Edit</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                      <form id="formMahasiswaEdit" class="form-horizontal" role="form" method="POST" action="{{ url('/mahasiswa/'.$mhsNim.'/simpanedit') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="_method" value="PUT">
                      <input type="hidden" name="mhsNim" value="{{$mhsNim}}" >
   
                              <div class="form-group">
                                  <label class="col-md-4 control-label">NIK</label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="dsnNidnShow" value="{{$mhsNik}}" disabled="true">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Nomer Pendaftaran</label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="dsnNidnShow" value="{{$mhsNomerPendaftaran}}" disabled="true">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">NIM</label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="dsnNidnShow" value="{{$mhsNim}}" disabled="true">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Nama </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsNama" value="{{$mhsNama}}">
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
                                      <input type="text" class="form-control" name="mhsTempatLahir" value="{{$mhsTempatLahir}}">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Tanggal Lahir </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsTanggalLahir" value="{{$mhsTanggalLahir}}">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Alamat </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsAlamat" value="{{$mhsAlamat}}">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">No Telp </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsNoTelp" value="{{$mhsNoTelp}}">
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
                                      <input type="text" class="form-control" name="mhsAngkatan" value="{{$mhsAngkatan}}">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Golongan </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsGolongan" value="{{$mhsGolongan}}">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Kelompok </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsKelompok" value="{{$mhsKelompok}}">
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
                                      <input type="text" class="form-control" name="mhsAsalSekolah" value="{{$mhsAsalSekolah}}">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Nama Orang Tua </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsNamaOrtu" value="{{$mhsNamaOrtu}}">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Alamat Orang Tua </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsAlamatOrtu" value="{{$mhsAlamatOrtu}}">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Pekerjaan Orang Tua </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mhsPekerjaanOrtu" value="{{$mhsPekerjaanOrtu}}">
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


                              <a href="{{{ action('Dosen\DosenController@index') }}}" title="Cancel">
                              <span class="btn btn-default"><i class="fa fa-back"> Cancel </i></span>
                              </a>  
                          </div>
                      </div>
                      </form>   
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
          </div><!-- /.row (main row) -->

          
                 

@endsection
@section('script')

<script>
      $(function(){
        if (fileInput.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        $(img).attr('src', e.target.result);
        }
        reader.readAsDataURL(fileInput.files[0]);
        }
        $('#photo').text(fileInput.files[0].name);
      </script>
@endsection

