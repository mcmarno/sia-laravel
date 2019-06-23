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
                    <h3 class="box-title">Daftar Kurikulum <a class="btn btn-success btn-flat btn-sm" id="tambahKurikulum" title="Tambah"><i class="fa fa-plus"></i></a></h3>
                  </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Kurikulum</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="dataKurikulum" class="table table-bordered table-hover">
                    <thead>
                      <tr>                        
                        <th>Kode Kurikulum</th>
                        <th>Prodi</th>                          
                        <th>Tahun </th>                        
                        <th>Nama </th>
                        <th>Sk Rektor</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php foreach ($kurikulum as $itemKurikulum):  ?>
                      <tr>
                        <td>{{$itemKurikulum->kurId}}</td>
                        <td>{{$itemKurikulum->prodiNama}}</td>
                        <td>{{$itemKurikulum->kurTahun}}</td>                       
                        <td>{{$itemKurikulum->kurNama}}</td>
                        <td>{{$itemKurikulum->kurNoSkRektor}}</td>
                        <td><a href="{{{ URL::to('kurikulum/'.$itemKurikulum->kurId.'/detail') }}}">
                              <span class="label label-info"><i class="fa fa-list"> Detail </i></span>
                              </a></td>
                      </tr>
                      <?php endforeach  ?> 
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Kode Kurikulum</th>
                        <th>Prodi</th>                    
                        <th>Jurusan</th>                            
                        <th>Tahun </th>                        
                        <th>Nama </th>
                        <th>Sk Rektor</th>
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
                          <h4 class="modal-title" id="myModalLabel">Kurikulum - Tambah</h4>
                      </div>
                      <div class="modal-body">
           
                          <form id="formKurikulum" class="form-horizontal" role="form" method="POST" action="{{ url('/kurikulum/tambah') }}">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
           
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Kode</label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="kurId">
                                      <small class="help-block"></small>
                                  </div>
                              </div>
           
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Program Studi</label>
                                  <div class="col-md-6 has-error">
                                      <select class="form-control" name="kurProdiKode">
                                          @foreach ($listprogram_studi as $itemprogram_studi)
                                          <option value="{{$itemprogram_studi->prodiKode}}">{{$itemprogram_studi->prodiNama}}</option>
                                          @endforeach
                                      </select>
                                      
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Tahun </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="kurTahun">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">Nama </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="kurNama">
                                      <small class="help-block"></small>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-4 control-label">SK Rektor </label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="kurNoSkRektor">
                                      <small class="help-block"></small>
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


        $('#tambahKurikulum').click(function(){
            $('input+small').text('');
            $('input').parent().removeClass('has-error');
            $('select').parent().removeClass('has-error');

            $('#myModal').modal('show');
            //console.log('test');
            return false;
        });

       
        $(document).on('submit', '#formKurikulum', function(e) {  
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
                
                window.location.href='/kurikulum'; 
            })
            .fail(function(data) {
                console.log(data.responeJSON);
                $.each(data.responseJSON, function (key, value) {
                    var input = '#formKurikulum input[name=' + key + ']';
                    
                    $(input + '+small').text(value);
                    $(input).parent().addClass('has-error');
                });
            });
        });
 
    })
      $(function () {

        $('#dataKurikulum').DataTable({"pageLength": 10});

      });

    </script>

@endsection

