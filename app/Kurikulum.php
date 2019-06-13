<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Kurikulum extends Model
{
	//protected $primaryKey = "idx";
	protected $table = "kurikulum";
	public $timestamps = false;
	protected $primaryKey = 'kurId';

	//protected $fillable = array('kurProdiKode','kurTahun','kurNama','kurNoSKRektor');

	public function Program_studi(){
    	return $this->hasMany('App\Prodi', 'foreign_key', 'prodikode');
    }
    /*public function Kurikulum(){
    	return $this->hasMany('App\Kurikulum', 'foreign_key', 'kurId');
    }*/


}
