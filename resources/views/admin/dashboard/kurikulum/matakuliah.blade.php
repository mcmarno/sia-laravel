@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            <li class="active">Kurikulum</li>
            <li class="active">Matakuliah</li>
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
                    <h3 class="box-title">Daftar Matakuliah <a class="btn btn-success btn-flat btn-sm" id="tambahMatakuliah" title="Tambah"><i class="fa fa-plus"></i></a></h3>
                  </div>
          
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Matakuliah Kurikulum</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="dataMakulKurikulum" class="table table-bordered table-hover">
                    <thead>
                      <tr>                        
                        <th>Kode Matakuliah</th>
                        <th>Nama</th>                        
                        <th>Kurikulum </th>
                        <th>SKS</th>                    
                        <th>Prodi</th>
                        <th>Semester</th>                            
                       
                      </tr>
                    </thead>
                    <tbody>
                     <?php foreach ($kurikulum as $itemKurikulum):  ?>
                      <tr>
                        <td>{{$itemKurikulum->mkkurKode}}</td>
                        <td>{{$itemKurikulum->mkkurNama}}</td>
                        <td>{{$itemKurikulum->kurNama}}</td>
                        <td>{{$itemKurikulum->mkkurJumlahSks}}</td>
                        <td>{{$itemKurikulum->prodiNama}}</td>
                        <td>{{$itemKurikulum->mkkurSemester}}</td>
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
                          <h4 class="modal-title" id="myModalLabel">Matakuliah - Tambah</h4>
                      </div>
                      <div class="modal-body">
           
                          <form id="formMatakuliah" class="form-horizontal" role="form" method="POST" action="{{ url('/kurikulum/tambahMatakuliah') }}">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
           
                              <div class="form-group">
                                  <label class="col-md-4 control-label">ID</label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mkkurId">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Kode</label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mkkurKode">
                                      <small class="help-block"></small>
                                  </div>
                              </div>
           
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Nama </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mkkurNama">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Kurikulum</label>
                                  <div class="col-md-6 has-error">
                                      <select class="form-control" name="mkkurKurId">
                                          @foreach ($listkurikulum as $itemkurikulum)
                                          <option value="{{$itemkurikulum->kurId}}">{{$itemkurikulum->kurNama}}</option>
                                          @endforeach
                                      </select>
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">SKS </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mkkurJumlahSks">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Semeter </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="mkkurSemester">
                                      <small class="help-block"></small>
                                  </div>
                              </div>
           
                              <div class="form-group">
                                  <div class="col-md-6 col-md-offset-4">
                                      <button type="submit" class="btn btn-primary" id="button-reg">Simpan</button>
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

        $('#tambahMatakuliah').click(function(){
            $('input+small').text('');
            $('input').parent().removeClass('has-error');
            $('select').parent().removeClass('has-error');

            $('#myModal').modal('show');
           
            //console.log('test');
            return false;
            })

        
        
         
        $(document).on('submit', '#formMatakuliah', function(e) {  
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
                
                window.location.href='/kurikulum/matakuliah'; 
            })
            .fail(function(data) {
                console.log(data.responeJSON);
                $.each(data.responseJSON, function (key, value) {
                    var input = '#formMatakuliah input[name=' + key + ']';
                    
                    $(input + '+small').text(value);
                    $(input).parent().addClass('has-error');
                });
            });
        });

       $('#dataMakulKurikulum').DataTable({"pageLength": 10});

      });

    </script>

@endsection

