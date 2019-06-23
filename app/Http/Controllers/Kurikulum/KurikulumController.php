<?php

namespace App\Http\Controllers\Kurikulum;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Response;
use DB;

use Validator;
use App\Http\Controllers\Controller;
use App\Kurikulum as Kurikulum;
use App\Prodi as Prodi;
use App\Matakuliah as Matakuliah;
//use App\Jurusan as Jurusan;

class KurikulumController extends Controller
{
  
	public function __construct()
  {
    $this->middleware('auth');
  }
      /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $dataKurikulum = Kurikulum::select(DB::raw("kurId, prodiNama, kurTahun, kurNoSkRektor, kurNama"))
        ->join('program_studi', 'program_studi.prodiKode', '=', 'kurikulum.kurProdiKode')
        ->orderBy(DB::raw("kurId, kurProdiKode"))        
        ->get();
        
    $data = array('kurikulum' => $dataKurikulum);
    $program_studi = Prodi::orderBy('prodiKode')->get();   
    return view('admin.dashboard.kurikulum.kurikulum',$data)
          ->with('listprogram_studi', $program_studi);
  }

  protected function validator(array $data)
    {
          $messages = [
              'kurId.required'    => 'Kode Kurikulum dibutuhkan.',
              'kurId.unique'      => 'Kode Kurikulum sudah digunakan.',
              'kurProdiKode.required'    => 'Kita membutuhkan Kode Program Studi asal Kurikulum . ',
              'kurTahun.required' => 'Tahun Kurikulum dibutuhkan.',
              'kurNama.required'  => 'Nama Kurikulum dibutuhkan.',
              'kurNoSkRektor.required'   => 'No SK Rektor dibutuhkan.'

          ];
          return Validator::make($data, [
              'kurId' => 'required|unique:kurikulum',
              'kurProdiKode' => 'required',
              'kurTahun' => 'required',
              'kurNama' => 'required|max:60',
              'kurNoSkRektor' => 'required',
          ], $messages);
    }

  protected function tambah(array $data)
  {

        $kurikulum = new Kurikulum();
        $kurikulum->kurId         = $data['kurId'];
        $kurikulum->kurProdiKode  = $data['kurProdiKode'];
        $kurikulum->kurTahun         = $data['kurTahun'];
        $kurikulum->kurNama     = $data['kurNama'];
        $kurikulum->kurNoSkRektor    = $data['kurNoSkRektor'];

        //melakukan save, jika gagal (return value false) lakukan harakiri
        //error kode 500 - internel server error
        if (! $kurikulum->save() )
          App::abort(500);
  }

  public function tambahkurikulum(Request $request)
    {
        $validator = $this->validator($request->all());
 
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
            //return Response::json( array('errors' => $validator->errors()->toArray()),422);
        }
 
        $this->tambah($request->all());
 
        return response()->json($request->all(),200);
  }

  public function matakuliah()
  {
    $dataKurikulum = Kurikulum::select(DB::raw("mkkurId, mkkurKode, prodiNama, kurNama, mkkurKode, mkkurNama, mkkurJumlahSks, mkkurSemester"))
        ->join('matakuliah_kurikulum','mkkurKurId','=','kurikulum.kurId')
        ->join('program_studi', 'program_studi.prodiKode', '=', 'kurikulum.kurProdiKode')
        ->orderBy(DB::raw("kurId, kurProdiKode"))        
        ->get();
        
    $data = array('kurikulum' => $dataKurikulum);
    $kurikulum = Kurikulum::orderBy('kurId')->get();   
    return view('admin.dashboard.kurikulum.matakuliah',$data)
        ->with('listkurikulum', $kurikulum);
  }

  public function detail($id)
  {
    $dataKurikulum = Kurikulum::select(DB::raw("mkkurId, mkkurKode, prodiNama, kurNama, mkkurNama, mkkurJumlahSks, mkkurSemester"))
        ->join('matakuliah_kurikulum','mkkurKurId','=','kurikulum.kurId')
        ->join('program_studi', 'program_studi.prodiKode', '=', 'kurikulum.kurProdiKode')
        ->where('kurikulum.kurId','=',$id)
        ->orderBy(DB::raw("kurId, kurProdiKode"))        
        ->get();
        
    $data = array('kurikulum' => $dataKurikulum);
    $kurikulum = Kurikulum::orderBy('kurId')->get();   
    return view('admin.dashboard.kurikulum.matakuliah',$data)
            ->with('listkurikulum', $kurikulum);
  }  
  
  protected function validasi(array $data)
    {
          $messages = [

              'mkkurId.required'      => 'ID Matakuliah dibutuhkan',
              'mkkurId.unique'     => 'ID Matakuliah sudah digunakan',
              'mkkurKode.required'    => 'Kode Matakuliah dibutuhkan.',
              'mkkurKode.unique'      => 'Kode Matakuliah sudah digunakan.',
              'mkkurKurId.required'    => 'Kita membutuhkan Kode Kurikulum asal Matakuliah . ',
              'mkkurNama.required'  => 'Nama Matakuliah dibutuhkan.',
              'mkkurJumlahSks.required'     => 'Jumlah SKS dibutuhkan.',
              'mkkurSemester.required'  => 'Semester matakuliah dibutuhkan. '

          ];
          return Validator::make($data, [
              'mkkurId' => 'required|unique:matakuliah_kurikulum',
              'mkkurKode' => 'required|unique:matakuliah_kurikulum',
              'mkkurKurId' => 'required',
              'mkkurNama' => 'required|max:60',
              'mkkurJumlahSks' => 'required',
              'mkkurSemester' => 'required'
          ], $messages);
    }

    protected function tambahi(array $data)
  {

        $matakuliah_kurikulum = new Matakuliah();
        $matakuliah_kurikulum->mkkurId          = $data['mkkurId'];
        $matakuliah_kurikulum->mkkurKode         = $data['mkkurKode'];
        $matakuliah_kurikulum->mkkurNama        = $data['mkkurNama'];
        $matakuliah_kurikulum->mkkurKurId         = $data['mkkurKurId'];
        $matakuliah_kurikulum->mkkurJumlahSks    = $data['mkkurJumlahSks'];
        $matakuliah_kurikulum->mkkurSemester  = $data['mkkurSemester'];

        //melakukan save, jika gagal (return value false) lakukan harakiri
        //error kode 500 - internel server error
        if (! $matakuliah_kurikulum->save() )
          App::abort(500);
  }

  public function tambahMatakuliah (Request $request)
    {
        $validator = $this->validasi($request->all());
 
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
            //return Response::json( array('errors' => $validator->errors()->toArray()),422);
        }
 
        $this->tambahi($request->all());
 
        return response()->json($request->all(),200);
  }
   

}

