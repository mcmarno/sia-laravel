<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Response;
use DB;
use Image;
use File;
use Validator;
use App\Http\Controllers\Controller;
use App\Dosen as Dosen;
use App\Prodi as Prodi;
//use App\Jurusan as Jurusan;

class DosenController extends Controller
{
  
	public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $dataDosen = Dosen::select(DB::raw("dsnNidn, dsnNip, dsnNama, dsnJenisKelamin, dsnAlamat, dsnNoTelp, prodiNama, photo"))
        ->join('program_studi', 'program_studi.prodiKode', '=', 'dosen.dsnProdiKode')
        ->orderBy(DB::raw("prodiKode"))        
        ->get();
    $prodi = Prodi::orderBy('prodiKode')->get();   
    $data = array('dosen' => $dataDosen);   
    return view('admin.dashboard.dosen.dosen',$data)
          ->with('listprogram_studi', $prodi);
  }
  public function detail($dsnNidn)
  {
    $dataDosen = Dosen::select(DB::raw("dsnNidn, dsnNip, dsnNama, dsnJenisKelamin, dsnAlamat, dsnNoTelp, prodiNama, photo"))
        ->join('program_studi', 'program_studi.prodiKode', '=', 'dosen.dsnProdiKode')
        ->where('dsnNidn','=',$dsnNidn)
        ->orderBy(DB::raw("prodiKode"))        
        ->get();
        
    $data = array('dosen' => $dataDosen);   
    return view('admin.dashboard.dosen.detaildosen',$data);
  } 

      public function tambahdosen(Request $request)
    {

        $rules=[
            'dsnNidn'=>['required', 'unique:dosen,dsnNidn'],
            'dsnNip'=>['required', 'unique:dosen,dsnNip'],
            'dsnNama'=>['required', 'max:60'],
            'dsnJenisKelamin'=>['required'],
            'dsnAlamat'=>['required'],
            'dsnNoTelp'=>['required'],
            'dsnProdiKode'=>['required'],
            'photo'=>['required|image|mimes:jpg,png,jpeg,gif,svg|max:2048']
        ];
        $messages = array(
            'dsnNidn.unique' => $request->input('dsnNidn') . ' Nomer Induk Dosen Nasional sudah digunakan.',
            'dsnNidn.required' => $request->input('dsnNidn'). ' Nomer Induk Dosen Nasional dibutuhkan.',
            'dsnNip.unique' => $request->input('dsnNip') . ' Nomer Induk Pegawai sudah digunakan.',
            'dsnNip.required' => $request->input('dsnNip'). ' Nomer Induk Pegawai dibutuhkan.',
            'dsnNama.required' => $request->input('dsnNama'). ' Nama dosen dibutuhkan.',
            'dsnJenisKelamin.required' => $request->input('dsnJenisKelamin'). ' Jenis Kelamin dosen dibutuhkan.',
            'dsnAlamat.required' => $request->input('dsnAlamat'). ' Alamat dosen dibutuhkan.',
            'dsnNoTelp.required' => $request->input('dsnNoTelp'). ' Nomor telepon dosen dibutuhkan.',
            'dsnProdiKode.required' => $request->input('dsnProdiKode'). ' Kita membutuhkan Progam Studi asal dosen',
            'photo.required' => $request->input('photo'). ' Photo harus berformat jpg/png/jpeg/gif/svg dengan ukuran maksimal 2 mb.'
        );
        $valid = Validator::make($request->input(), $rules, $messages);
        if ($valid->fails()) {
            $this->throwValidationException(
                $request, $valid
              );
            return Response::json( array('errors' => $valid->errors()->toArray()),422);
        } else {
            $dosen = new Dosen();
            $dosen->dsnNidn = $request->input('dsnNidn');
            $dosen->dsnNip = $request->input('dsnNip');
            $dosen->dsnNama = $request->input('dsnNama');
            $dosen->dsnJenisKelamin = $request->input('dsnJenisKelamin');
            $dosen->dsnAlamat = $request->input('dsnAlamat');
            $dosen->dsnNoTelp = $request->input('dsnNoTelp');
            $dosen->dsnProdiKode = $request->input('dsnProdiKode');
            if ($request->hasFile('photo')) {
                    $file       =   $request->file('photo');
                    $fileName   =   date('Y-m-d') . "." . $file->getClientOriginalName();
                    $location   =   public_path('images/dosen/'. $fileName);
                    Image::make($file)->resize(128, 128)->save($location);
                    $dosen->photo  =  $fileName;
                }else {
                        $fileName       =   'user-dosen.jpg';
                        $dosen->photo  =  $fileName;
                }
           
            if($dosen->save());
            return redirect()->back();
        }
    }

    public function hapus($id)
  {
   
    $dsnNidn = Dosen::where('dsnNidn', '=', $id)->first();
    $filename = Dosen::where('photo', '=', $id)->first();
    $path = ('images/dosen/');


    if ($dsnNidn == null)
      app::abort(404);

    File::delete($path.$filename);
    $dsnNidn->delete();

    return Redirect::action('Dosen\DosenController@index');

  }

  public function editdosen($id)
    {

        $data = Dosen::find($id);
        $prodi = Prodi::orderBy('prodiKode')->get();

        return view('admin.dashboard.dosen.editdosen',$data)
                ->with('listprogram_studi', $prodi);
    }


    public function simpanedit($id, Request $request)
    {
        $input =Input::all();
        $messages = [
            'dsnNidn.required'      => 'Nomer Induk Dosen Nasional dibutuhkan.',            
            'dsnNip.required'      => 'Nomer Induk Pegawai dibutuhkan.',
            'dsnNama.required'   => 'Nama dosen dibutuhkan.',
            'dsnJenisKelamin.required'  => 'Jenis Kelamin dosen dibutuhkan.',
            'dsnAamat.required' => 'Alamat dosen dibutuhkan.',
            'dsnNoTelp.required'      => 'Nomor telepon dosen dibutuhkan.',
            'dsnProdiKode.required'      => 'Kita membutuhkan Progam Studi asal dosen.',
            'photo.required'      => 'Photo harus berformat jpg/png/jpeg/gif/svg dengan ukuran maksimal 2 mb.',
        ];
        

        $validator = Validator::make($input, [
                            'dsnNidn'=>['required'],
                            'dsnNip'=>['required'],
                            'dsnNama'=>['required', 'max:60'],
                            'dsnJenisKelamin'=>['required'],
                            'dsnAlamat'=>['required'],
                            'dsnNoTelp'=>['required'],
                            'dsnProdiKode'=>['required'],
                            'photo'=>['required']
                                      ], $messages);

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();
          # Bila validasi sukses
        }

        $editDosen = Dosen::find($id);
        $editDosen->dsnNidn = Input::get('dsnNidn'); //atau bisa $input['prodiKode']
        $editDosen->dsnNip = $input['dsnNip'];
        $editDosen->dsnNama = $input['dsnNama'];
        $editDosen->dsnJenisKelamin = $input['dsnJenisKelamin'];
        $editDosen->dsnAlamat = $input['dsnAlamat'];
        $editDosen->dsnNoTelp = $input['dsnNoTelp'];
        $editDosen->dsnProdiKode = $input['dsnProdiKode'];

        if ($request->hasFile('photo')) {
                    $file       =   $request->file('photo');
                    $fileName   =   date('Y-m-d') . "." . $file->getClientOriginalName();
                    $location   =   public_path('images/dosen/'. $fileName);
                    Image::make($file)->resize(128, 128)->save($location);
                    $dosen->photo  =  $fileName;
                }else {
                        /*$fileName       =   'user-dosen.jpg';
                        $dosen->photo  =  $fileName;
                        */
                }

        if (! $editDosen->save())
          App::abort(500);

        return Redirect::action('Dosen\DosenController@index')
                          ->with('successMessage','Data dosen "'.Input::get('dsnNama').'" telah berhasil diubah.'); 
    }

  }