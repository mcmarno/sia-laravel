<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Response;


use Validator;
//use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Matakuliah as Matakuliah ;

class MatakuliahController extends Controller
{
    protected function validator(array $data)
    {
          $messages = [
              'mkkurId.required'    => 'Kode Matakuliah dibutuhkan.',
              'mkkurId.unique'      => 'Kode Matakuliah sudah digunakan.',
              'mkkurKurId.required'    => 'Kita membutuhkan Kode Kurikulum asal Matakuliah . ',
              'mkkurSemester.required' => 'Semester Matakuliah dibutuhkan.',
              'mkkurNama.required'  => 'Nama Matakuliah dibutuhkan.',
              'mkkurJumlahSks'     => 'Jumlah SKS dibutuhkan.'

          ];
          return Validator::make($data, [
              'mkkurId' => 'required|unique:matakuliah_kurikulum',
              'mkkurKurId' => 'required',
              'mkkurSemester' => 'required',
              'mkkurNama' => 'required|max:60',
              'mkkurJumlahSks' => 'required',
          ], $messages);
    }

    protected function tambah(array $data)
  {

        $matakuliah_kurikulum = new Matakuliah();
        $matakuliah_kurikulum->mkkurId         = $data['mkkurId'];
        $matakuliah_kurikulum->mkkurNama  = $data['mkkurNama'];
        $matakuliah_kurikulum->mkkurKurId         = $data['mkkurKurId'];
        $matakuliah_kurikulum->mkkurSemester     = $data['mkkurSemester'];
        $matakuliah_kurikulum->mkkurJumlahSks    = $data['mkkurJumlahSks'];

        //melakukan save, jika gagal (return value false) lakukan harakiri
        //error kode 500 - internel server error
        if (! $matakuliah_kurikulum->save() )
          App::abort(500);
  }

  public function tambahMatakuliah (Request $request)
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
}
