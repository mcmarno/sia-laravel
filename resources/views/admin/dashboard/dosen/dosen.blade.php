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
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">Daftar Dosen <a class="btn btn-success btn-flat btn-sm" id="tambahDosen" title="Tambah"><i class="fa fa-plus"></i></a></h3>
                  </div>
                </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Dosen</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="dataDosen" class="table table-bordered table-hover">
                    <thead>
                      <tr>                        
                        <th>NIDN</th>
                        <th>NIP</th>                    
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>No Telp</th>              
                        <th>Program Studi</th> 
                        <th>Aksi</th> 
                      </tr>
                    </thead>
                    <tbody>
                     <?php foreach ($dosen as $itemDosen):  ?>
                      <tr>
                        <td>{{$itemDosen->dsnNidn }}</td>
                        <td>{{$itemDosen->dsnNip}}</td>
                        <td>{{$itemDosen->dsnNama}}</td>
                        <td>{{$itemDosen->dsnJenisKelamin}}</td>
                        <td>{{$itemDosen->dsnAlamat}}</td>
                        <td>{{$itemDosen->dsnNoTelp}}</td>
                        <td>{{$itemDosen->prodiNama}}</td> 
                        <td>
                          <a href="{{{ URL::to('dosen/'.$itemDosen->dsnNidn.'/detail') }}}">
                              <span class="label label-info"><i class="fa fa-list"> </i></span>
                            </a>
                            <a href="{{{ URL::to('dosen/'.$itemDosen->dsnNidn.'/edit') }}}">
                              <span class="label label-warning"><i class="fa fa-edit"> </i></span>
                            </a>
                            <a href="{{{ action('Dosen\DosenController@hapus',[$itemDosen->dsnNidn]) }}}" title="hapus"   onclick="return confirm('Apakah anda yakin akan menghapus Dosen {{{($itemDosen->dsnNidn).' - '.$itemDosen->dsnNama }}}?')">
                              <span class="label label-danger"><i class="fa fa-trash"> </i></span>
                            </a>  
                        </td>
                      </tr>
                      <?php endforeach  ?> 
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>NIDN</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>                    
                        <th>Alamat</th>                            
                        <th>No Telp</th>
                        <th>Program Studi</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
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
                          <h4 class="modal-title" id="myModalLabel">Dosen - Tambah</h4>
                      </div>
                      <div class="modal-body">
           
                          <form id="formDosen" class="form-horizontal" role="form" method="POST" action="{{ url('/dosen/tambah') }}" enctype="multipart/form-data">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
           
                              <div class="form-group">
                                  <label class="col-md-4 control-label">NIDN</label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="dsnNidn">
                                      <small class="help-block"></small>
                                  </div>
                              </div>
  
                              <div class="form-group">
                                  <label class="col-md-4 control-label">NIP </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="dsnNip">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Nama </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="dsnNama">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Jenis Kelamin </label>
                                  <div class="col-md-6">
                                      <input type="radio" name="dsnJenisKelamin" value="Laki - Laki" /> Laki - Laki </p>
                                      <input type="radio" name="dsnJenisKelamin" value="Perempuan" /> Perempuan
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Alamat </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="dsnAlamat">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">No Telp </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="dsnNoTelp">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Program Studi</label>
                                  <div class="col-md-6 has-error">
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
      $(function(){

        $('#tambahDosen').click(function(){
            $('input+small').text('');
            $('input').parent().removeClass('has-error');
            $('select').parent().removeClass('has-error');

            $('#myModal').modal('show');
           
            //console.log('test');
            return false;
            })

        
        
         
        $(document).on('submit', '#formDosen', function(e) {
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
                
                window.location.href='/dosen'; 
            })
            .fail(function(data) {
                console.log(data.responeJSON);
                $.each(data.responseJSON, function (key, value) {
                    var input = '#formDosen input[name=' + key + ']';
                    
                    $(input + '+small').text(value);
                    $(input).parent().addClass('has-error');
                });
            });
        });
        $('#dataDosen').DataTable({"pageLength": 10});

        
    });

    </script>

@endsection

