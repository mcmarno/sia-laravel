<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Matakuliah extends Model
{
	//protected $primaryKey = "idx";
	protected $table = "matakuliah_kurikulum";
	public $timestamps = false;
	protected $primaryKey = 'mkkurId';

	//protected $fillable = array('kurProdiKode','kurTahun','kurNama','kurNoSKRektor');

	/*public function Program_studi(){
    	return $this->hasMany('App\Prodi', 'foreign_key', 'prodikode');
    }
    /*public function Kurikulum(){
    	return $this->hasMany('App\Kurikulum', 'foreign_key', 'kurId');
    }*/


}