<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Response;
use DB;
use Image;
use File;
use Validator;
use App\Http\Controllers\Controller;
use App\Mahasiswa as Mahasiswa;
use App\Prodi as Prodi;
use App\kurikulum as Kurikulum;
//use App\Jurusan as Jurusan;

class MahasiswaController extends Controller
{
  
	public function __construct()
  {
    $this->middleware('auth');
  }
     
  public function index()
  {
    $dataMahasiswa = Mahasiswa::select(DB::raw("mahasiswa.mhsNim as Nim, mhsNik,mhsNomerPendaftaran, mhsNama, mhsJenisKelamin,mhsAgama, mhsTempatLahir, mhsTanggalLahir, mhsAlamat, mhsNoTelp, mhsStatusNikah,  prodiNama, mhsAngkatan,mhsGolongan, mhsKelompok, mhsKurId, mhsAsalSekolah, mhsNamaOrtu, mhsAlamatOrtu, mhsPekerjaanOrtu, photo"))
        ->join('program_studi', 'program_studi.prodiKode', '=', 'mahasiswa.mhsProdiKode')
        ->join('kurikulum','mhsKurId','=','kurikulum.kurId')
        ->orderBy(DB::raw("prodiKode"))        
        ->get();

    $prodi = Prodi::orderBy('prodiKode')->get();
    $kurikulum = Kurikulum::orderBy('kurId')->get();    
    $data = array('mahasiswa' => $dataMahasiswa);   
    return view('admin.dashboard.mahasiswa.mahasiswa',$data)
          ->with('listprogram_studi', $prodi)
          ->with('listkurikulum', $kurikulum);
  }

  public function detail($mhsNim)
  {
    $dataMahasiswa = Mahasiswa::select(DB::raw("mahasiswa.mhsNim as Nim, mhsNik, mhsNomerPendaftaran, mhsNama, mhsJenisKelamin, mhsAgama, mhsTempatLahir, mhsTanggalLahir, mhsAlamat, mhsNoTelp, mhsStatusNikah,  prodiNama, mhsAngkatan,mhsGolongan, mhsKelompok, mhsKurId, mhsAsalSekolah, mhsNamaOrtu, mhsAlamatOrtu, mhsPekerjaanOrtu, photo"))
        ->join('program_studi', 'program_studi.prodiKode', '=', 'mahasiswa.mhsProdiKode')
        ->join('kurikulum','mhsKurId','=','kurikulum.kurId')
        ->where('mhsNim','=',$mhsNim)
        ->orderBy(DB::raw("prodiKode"))        
        ->get();
        
    $data = array('mahasiswa' => $dataMahasiswa);   
    return view('admin.dashboard.mahasiswa.detailmahasiswa',$data);
  }

  public function tambahmahasiswa(Request $request)
    {

        $rules=[
            'mhsNomerPendaftaran'=>['required', 'unique:mahasiswa,mhsNomerPendaftaran'],
            'mhsNik'=>['required', 'unique:mahasiswa,mhsNik'],
            'mhsNim'=>['required', 'unique:mahasiswa,mhsNim'],
            'mhsNama'=>['required', 'max:60'],
            'mhsJenisKelamin'=>['required'],
            'mhsAgama'=>['required'],
            'mhsTempatLahir'=>['required'],
            'mhsTanggalLahir'=>['required'],
            'mhsAlamat'=>['required'],
            'mhsNoTelp'=>['required'],
            'mhsStatusNikah'=>['required'],
            'mhsProdiKode'=>['required'],
            'mhsAngkatan'=>['required'],
            'mhsGolongan'=>['required'],
            'mhsKelompok'=>['required'],
            'mhsKurId'=>['required'],
            'mhsAsalSekolah'=>['required'],
            'mhsNamaOrtu'=>['required'],
            'mhsAlamatOrtu'=>['required'],
            'mhsPekerjaanOrtu'=>['required'],
            'photo'=>['required|image|mimes:jpg,png,jpeg,gif,svg|max:2048']
        ];
        $messages = array(
            'mhsNomerPendaftaran.unique' => $request->input('mhsNomerPendaftaran') . ' Nomer Pendaftaran Mahasiswa sudah digunakan.',
            'mhsNomerPendaftaran.required' => ' Nomer Pendaftaran Mahasiswa dibutuhkan.',
            'mhsNik.unique' => $request->input('mhsNik') . ' Nomer Induk KTP Mahasiswa sudah digunakan.',
            'mhsNik.required' => ' Nomer Induk KTP Mahasiswa dibutuhkan.',
            'mhsNim.unique' => $request->input('mhsNim') . ' Nomer Induk Mahasiswa sudah digunakan.',
            'mhsNim.required' => ' Nomer Induk Mahasiswa dibutuhkan.',
            'mhsNama.required' => ' Nama mahasiswa dibutuhkan.',
            'mhsJenisKelamin.required' => ' Jenis Kelamin mahasiswa dibutuhkan.',
            'mhsAgama' => ' Agama mahasiswa dibutuhkan.',
            'mhsTempatLahir.required' => ' Tempat lahir mahasiswa dibutuhkan.',
            'mhsTanggalLahir.required' => ' Tanggal lahir mahasiswa dibutuhkan.',
            'mhsAlamat.required' => ' Alamat mahasiswa dibutuhkan.',
            'mhsNoTelp.required'=> ' Nomer telpon mahasiswa dibutuhkan.',
            'mhsStatusNikah.required' => ' Status nikah mahasiswa dibutuhkan.',
            'mhsProdiKode.required' => ' Kita membutuhkan Program Studi asal mahasiswa',
            'mhsAngkatan.required' => ' Angkatan mahasiswa dibutuhkan.',
            'mhsGolongan.required' => ' Golongan mahasiswa dibutuhkan',
            'mhsKelompok.required' => ' Kelompok mahasiswa dibutuhkan',
            'mhsKurId.required' => ' Kita membutuhkan Kurikulum asal mahasiswa',
            'mhsAsalSekolah.required' => ' Asal sekolah mahasiswa dibutuhkan',
            'mhsNamaOrtu.required' => ' Nama orang tua mahasiswa dibutuhkan.',
            'mhsAlamatOrtu.required' => ' Alamat orang tua mahasiswa dibutuhkan.',
            'mhsPekerjaanOrtu.required' => ' Pekerjaan orang tua mahasiswa dibutuhkan.',
            'photo.required' => $request->input('photo'). ' Photo harus berformat jpg/png/jpeg/gif/svg dengan ukuran maksimal 2 mb.'
        );
        $valid = Validator::make($request->input(), $rules, $messages);
        if ($valid->fails()) {
            $this->throwValidationException(
                $request, $valid
              );
            return Response::json( array('errors' => $valid->errors()->toArray()),422);
        } else {
            $aktif = '1';
            $mhs = new Mahasiswa();
            $mhs->mhsNomerPendaftaran = $request->input('mhsNomerPendaftaran');
            $mhs->mhsNik = $request->input('mhsNik');
            $mhs->mhsNim = $request->input('mhsNim');
            $mhs->mhsNama = $request->input('mhsNama');
            $mhs->mhsJenisKelamin = $request->input('mhsJenisKelamin');
            $mhs->mhsAgama = $request->input('mhsAgama');
            $mhs->mhsTempatLahir = $request->input('mhsTempatLahir');
            $mhs->mhsTanggalLahir = $request->input('mhsTanggalLahir');
            $mhs->mhsAlamat = $request->input('mhsAlamat');
            $mhs->mhsNoTelp = $request->input('mhsNoTelp');
            $mhs->mhsStatusNikah = $request->input('mhsStatusNikah');
            $mhs->mhsProdiKode = $request->input('mhsProdiKode');
            $mhs->mhsAngkatan = $request->input('mhsAngkatan');
            $mhs->mhsGolongan = $request->input('mhsGolongan');
            $mhs->mhsKelompok = $request->input('mhsKelompok');
            $mhs->mhsKurId = $request->input('mhsKurId');
            $mhs->mhsAsalSekolah = $request->input('mhsAsalSekolah');
            $mhs->mhsNamaOrtu = $request->input('mhsNamaOrtu');
            $mhs->mhsAlamatOrtu = $request->input('mhsAlamatOrtu');
            $mhs->mhsPekerjaanOrtu = $request->input('mhsPekerjaanOrtu');
            $mhs->mhsStatusAktif = $aktif;
            if ($request->hasFile('photo')) {
                    $file       =   $request->file('photo');
                    $fileName   =   date('Y-m-d') . "." . $file->getClientOriginalName();
                    $location   =   public_path('images/mahasiswa/'. $fileName);
                    Image::make($file)->resize(128, 128)->save($location);
                    $mhs->photo  =  $fileName;
                }else {
                        $fileName       =   'dosen.jpg';
                        $mhs->photo  =  $fileName;
                }
           
            if($mhs->save());
            return Redirect::action('Mahasiswa\MahasiswaController@index');
            //return redirect()->back();
        }
    }

    public function hapus($id)
  {
   
    $mhsNim = Mahasiswa::where('mhsNim', '=', $id)->first();

    if ($mhsNim == null)
      app::abort(404);

    $mhsNim->delete();

    return Redirect::action('Mahasiswa\MahasiswaController@index');

  }

   public function editmahasiswa($id)
    {

        $data = Mahasiswa::find($id);
        $prodi = Prodi::orderBy('prodiKode')->get();
        $kurikulum = Kurikulum::orderBy('kurId')->get();

        return view('admin.dashboard.mahasiswa.editmahasiswa',$data)
                ->with('listprogram_studi', $prodi)
                ->with('listkurikulum', $kurikulum);
    }

    public function simpanedit($id, Request $request)
    {
        $input =Input::all();
        $messages = [
            'mhsNama.required' => ' Nama mahasiswa dibutuhkan.',
            'mhsJenisKelamin.required' => ' Jenis Kelamin mahasiswa dibutuhkan.',
            'mhsAgama' => ' Agama mahasiswa dibutuhkan.',
            'mhsTempatLahir.required' => ' Tempat lahir mahasiswa dibutuhkan.',
            'mhsTanggalLahir.required' => ' Tanggal lahir mahasiswa dibutuhkan.',
            'mhsAlamat.required' => ' Alamat mahasiswa dibutuhkan.',
            'mhsNoTelp.required'=> ' Nomer telpon mahasiswa dibutuhkan.',
            'mhsStatusNikah.required' => ' Status nikah mahasiswa dibutuhkan.',
            'mhsProdiKode.required' => ' Kita membutuhkan Program Studi asal mahasiswa',
            'mhsAngkatan.required' => ' Angkatan mahasiswa dibutuhkan.',
            'mhsGolongan.required' => ' Golongan mahasiswa dibutuhkan',
            'mhsKelompok.required' => ' Kelompok mahasiswa dibutuhkan',
            'mhsKurId.required' => ' Kurikulum mahasiswa dibutuhkan',
            'mhsAsalSekolah.required' => ' Asal sekolah mahasiswa dibutuhkan',
            'mhsNamaOrtu.required' => ' Nama orang tua mahasiswa dibutuhkan.',
            'mhsAlamatOrtu.required' => ' Alamat orang tua mahasiswa dibutuhkan.',
            'mhsPekerjaanOrtu.required' => ' Pekerjaan orang tua mahasiswa dibutuhkan.',
            'photo.required' => ' Photo harus berformat jpg/png/jpeg/gif/svg dengan ukuran maksimal 2 mb.'
        ];
        

        $validator = Validator::make($input, [
                            'mhsNama'=>['required'],
                            'mhsJenisKelamin'=>['required'],
                            'mhsAgama'=>['required'],
                            'mhsTempatLahir'=>['required'],
                            'mhsTanggalLahir'=>['required'],
                            'mhsAlamat'=>['required'],
                            'mhsNoTelp'=>['required'],
                            'mhsStatusNikah'=>['required'],
                            'mhsProdiKode'=>['required'],
                            'mhsAngkatan'=>['required'],
                            'mhsGolongan'=>['required'],
                            'mhsKelompok'=>['required'],
                            'mhsKurId'=>['required'],
                            'mhsAsalSekolah'=>['required'],
                            'mhsNamaOrtu'=>['required'],
                            'mhsAlamatOrtu'=>['required'],
                            'mhsPekerjaanOrtu'=>['required'],
                            'photo'=>['required']
                                      ], $messages);

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();
          # Bila validasi sukses
        }

        $editmhs = Mahasiswa::find($id);
        $editmhs->mhsNim = Input::get('mhsNim'); //atau bisa $input['prodiKode']
        $editmhs->mhsNama = $input['mhsNama'];
        $editmhs->mhsJenisKelamin = $input['mhsJenisKelamin'];
        $editmhs->mhsAgama = $input['mhsAgama'];
        $editmhs->mhsTempatLahir = $input['mhsTempatLahir'];
        $editmhs->mhsTanggalLahir = $input['mhsTanggalLahir'];
        $editmhs->mhsAlamat = $input['mhsAlamat'];
        $editmhs->mhsNoTelp = $input['mhsNoTelp'];
        $editmhs->mhsStatusNikah = $input['mhsStatusNikah'];
        $editmhs->mhsProdiKode = $input['mhsProdiKode'];
        $editmhs->mhsAngkatan = $input['mhsAngkatan'];
        $editmhs->mhsGolongan = $input['mhsGolongan'];
        $editmhs->mhsKelompok = $input['mhsKelompok'];
        $editmhs->mhsKurId = $input['mhsKurId'];
        $editmhs->mhsAsalSekolah = $input['mhsAsalSekolah'];
        $editmhs->mhsNamaOrtu = $input['mhsNamaOrtu'];
        $editmhs->mhsAlamatOrtu = $input['mhsAlamatOrtu'];
        $editmhs->mhsPekerjaanOrtu = $input['mhsPekerjaanOrtu'];

        if ($request->hasFile('photo')) {
                    $file       =   $request->file('photo');
                    $fileName   =   date('Y-m-d') . "." . $file->getClientOriginalName();
                    $location   =   public_path('images/mahasiswa/'. $fileName);
                    Image::make($file)->resize(128, 128)->save($location);
                    $mahasiswa->photo  =  $fileName;
                }else {
                        /*$fileName       =   'user-dosen.jpg';
                        $dosen->photo  =  $fileName;
                        */
                }

        if (! $editmhs->save())
          App::abort(500);

        return Redirect::action('Mahasiswa\MahasiswaController@index')
                          ->with('successMessage','Data mahasiswa "'.Input::get('mhsNama').'" telah berhasil diubah.'); 
    }

  
}

