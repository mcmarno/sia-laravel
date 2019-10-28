@extends('admin.layout.master')
@section('breadcrump')
          <h1>
            Dashboard
            <small>Dosen</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard Dosen</li>
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
        <h3 class="box-title">Jadwal</h3>
      </div><!-- /.box-header -->
      <?php foreach ($kelas as $itemKelas);  ?>
      <div class="box-body no-padding">
        <form id="formJadwal" class="form-horizontal" role="form" method="POST" action="{{ url('/kelas/'.$itemKelas->klsId.'/simpanjadwal') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="klsId" value="{{$itemKelas->klsId}}" >

          <div class="form-group">
            <label class="col-md-4 control-label">Kelas</label>
            <div class="col-md-6">
              <input type="text" class="form-control" name="dsnNidnShow" value="{{$itemKelas->klsNama}}" disabled="true" >
              <small class="help-block"></small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Matakuliah</label>
            <div class="col-md-6">
              <input type="text" class="form-control" name="dsnNidnShow" 
              value="{{$itemKelas->mkkurNama}}" disabled="true" >
              <small class="help-block"></small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Dosen</label>
            <div class="col-md-6">
              <input type="text" class="form-control" name="dsnNidnShow" 
              value="{{$itemKelas->dsnNama}}" disabled="true" >
              <small class="help-block"></small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Pertemuan I</label>
            <div class="col-md-6">
              <input type="date" class="form-control" name="perSatu" 
              value="{{$itemKelas->perSatu}}" disabled="true">
              <small class="help-block"></small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Pertemuan II</label>
            <div class="col-md-6">
              <input type="date" class="form-control" name="perDua" 
              value="{{$itemKelas->perDua}}" disabled="true">
              <small class="help-block"></small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Pertemuan III</label>
            <div class="col-md-6">
              <input type="date" class="form-control" name="perTiga" 
              value="{{$itemKelas->perTiga}}" disabled="true">
              <small class="help-block"></small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Pertemuan IV</label>
            <div class="col-md-6">
              <input type="date" class="form-control" name="perEmpat" 
              value="{{$itemKelas->perEmpat}}" disabled="true">
              <small class="help-block"></small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Pertemuan V</label>
            <div class="col-md-6">
              <input type="date" class="form-control" name="perLima" 
              value="{{$itemKelas->perLima}}" disabled="true">
              <small class="help-block"></small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Pertemuan VI</label>
            <div class="col-md-6">
              <input type="date" class="form-control" name="perEnam" 
              value="{{$itemKelas->perEnam}}" disabled="true">
              <small class="help-block"></small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Pertemuan VII</label>
            <div class="col-md-6">
              <input type="date" class="form-control" name="perTujuh" 
              value="{{$itemKelas->perTujuh}}" disabled="true">
              <small class="help-block"></small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Pertemuan VIII</label>
            <div class="col-md-6">
              <input type="date" class="form-control" name="perDelapan" 
              value="{{$itemKelas->perDelapan}}" disabled="true">
              <small class="help-block"></small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Pertemuan IX</label>
            <div class="col-md-6">
              <input type="date" class="form-control" name="perSembilan" 
              value="{{$itemKelas->perSembilan}}" disabled="true">
              <small class="help-block"></small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Pertemuan X</label>
            <div class="col-md-6">
              <input type="date" class="form-control" name="perSepuluh" 
              value="{{$itemKelas->perSepuluh}}" disabled="true">
              <small class="help-block"></small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Pertemuan XI</label>
            <div class="col-md-6">
              <input type="date" class="form-control" name="perSebelas" 
              value="{{$itemKelas->perSebelas}}" disabled="true">
              <small class="help-block"></small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Pertemuan XII</label>
            <div class="col-md-6">
              <input type="date" class="form-control" name="perDuabelas" 
              value="{{$itemKelas->perDuabelas}}" disabled="true">
              <small class="help-block"></small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">UTS</label>
            <div class="col-md-6">
              <input type="date" class="form-control" name="uts" 
              value="{{$itemKelas->uts}}" disabled="true">
              <small class="help-block"></small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">UAS</label>
            <div class="col-md-6">
              <input type="date" class="form-control" name="uas" 
              value="{{$itemKelas->uas}}" disabled="true">
              <small class="help-block"></small>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              
              <a href="{{{ action('RoleDosen\RoleDosenController@kelasSemester') }}}" title="Cancel">
                <span class="btn btn-primary"><i class="fa fa-back"> Kembali </i></span>
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

    <script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
      $(function () {

        $('#dataKurikulum').DataTable({"pageLength": 25});

      });

    </script>

@endsection