@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Dosen</li>
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
                    <h3 class="box-title">Daftar Dosen - Edit</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                      <form id="formProdiEdit" class="form-horizontal" role="form" method="POST" action="{{ url('/dosen/'.$dsnNidn.'/simpanedit') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="_method" value="PUT">
                      <input type="hidden" name="dsnNidn" value="{{$dsnNidn}}" >
                      
                      <div class="form-group">
                          <label class="col-md-4 control-label">NIDN</label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="dsnNidnShow" value="{{$dsnNidn}}" disabled="true">
                              <small class="help-block"></small>
                          </div>
                      </div>
   
                      <div class="form-group">
                          <label class="col-md-4 control-label">NIP </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="dsnNip" value="{{$dsnNip}}">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Nama </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="dsnNama" value="{{$dsnNama}}">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Jenis Kelamin </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="dsnJenisKelamin" value="{{$dsnJenisKelamin}}">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Alamat </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="dsnAlamat" value="{{$dsnAlamat}}">
                              <small class="help-block"></small>
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">No Telepon </label>
                          <div class="col-md-6">
                              <input type="text" class="form-control" name="dsnNoTelp" value="{{$dsnNoTelp}}">
                              <small class="help-block"></small>
                          </div>
                      </div>
   
                      <div class="form-group">
                          <label class="col-md-4 control-label">Program Studi </label>
                          <div class="col-md-6">
                              <select class="form-control" name="dsnProdiKode">
                                
                                 @foreach ($listprogram_studi as $itemprogram_studi)
                                          <option value="{{$itemprogram_studi->prodiKode}}">{{$itemprogram_studi->prodiNama}}</option>
                                          @endforeach

                              </select>
                              
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

