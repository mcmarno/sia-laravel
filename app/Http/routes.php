<?php
use illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function()    
{
	//Route::auth();
	// Authentication Routes...
	$this->get('login', 'Auth\AuthController@showLoginForm');
	$this->post('login', 'Auth\AuthController@login');

	Route::get('/', array('as'=>'admin', 'uses'=> 'AdminController@index'));
	$this->get('logout', 'Auth\AuthController@logout');

	 //ini route instant isinya banyak route untuk kebutuhan auth
	

});

//Route as admin
Route::group(['middleware' => ['web','auth','level:1']], function()    
{

	// Registration Routes...
	$this->get('register', 'Auth\AuthController@showRegistrationForm');
	$this->post('register', 'Auth\AuthController@register');

	// Password Reset Routes...
	$this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
	$this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
	$this->post('password/reset', 'Auth\PasswordController@reset');	

	Route::get('/jurusan',array(
		'as'=>'jurusan', 
		'uses'=> 'Jurusan\JurusanController@index'
	));
	Route::get('/jurusan/tambah', array(
		'as'=>'jurusan.tambah', 
		'uses'=> 'Jurusan\JurusanController@tambah'
	));
	Route::post('/jurusan/tambahjurusan', array(
		'as'=>'jurusan.tambah.simpan', 
		'uses'=> 'Jurusan\JurusanController@tambahjurusan'
	));	
    Route::get('/jurusan/{id}/hapus', array(
    	'as'=>'jurusan.hapus', 
    	'uses'=> 'Jurusan\JurusanController@hapus'
    ));
    //prodi
	Route::get('/prodi',array('as'=>'prodi', 'uses'=> 'Prodi\ProdiController@index'));
	Route::get('/prodi/{id}/hapus', array('as'=>'prodi.hapus', 'uses'=> 'Prodi\ProdiController@hapus'));
	Route::post('/prodi/tambah', array('as'=>'prodi.tambah', 'uses'=> 'Prodi\ProdiController@tambahprodi'));
	Route::get('/prodi/{id}/edit', array('as'=>'prodi.edit', 'uses'=> 'Prodi\ProdiController@editprodi'));
	Route::put('/prodi/{id}/simpanedit', array('as'=>'prodi.simpanedit', 'uses'=> 'Prodi\ProdiController@simpanedit'));

	//Kurikulum
	Route::get('/kurikulum', array('as'=>'kurikulum', 'uses'=>'Kurikulum\KurikulumController@index'));
	Route::post('/kurikulum/tambah', array('as'=>'kurikulum.tambah', 'uses'=> 'Kurikulum\KurikulumController@tambahkurikulum'));
	Route::get('/kurikulum/matakuliah', array('as'=>'matakuliah', 'uses'=>'Kurikulum\KurikulumController@matakuliah'));
	Route::post('/kurikulum/tambahMatakuliah', array('as' =>'matakuliah.tambah', 'uses'=> 'Kurikulum\KurikulumController@tambahMatakuliah'));
	Route::get('kurikulum/{kurId}/detail', array('as'=>'kurikulum.detail', 'uses'=> 'Kurikulum\KurikulumController@detail'));

	//dosen
	Route::get('/dosen', array('as'=>'dosen', 'uses'=>'Dosen\DosenController@index'));
	Route::get('/dosen/{dsnNidn}/detail', array('as'=>'dosen.detail', 'uses'=>'Dosen\DosenController@detail'));
	Route::post('/dosen/tambah', array('as'=>'dosen.tambah', 'uses'=> 'Dosen\DosenController@tambahdosen'));
	Route::get('/dosen/{id}/hapus', array('as'=>'dosen.hapus', 'uses'=> 'Dosen\DosenController@hapus'));
	Route::get('/dosen/{id}/edit', array('as'=>'dosen.edit', 'uses'=> 'Dosen\DosenController@editdosen'));
	Route::put('/dosen/{id}/simpanedit', array('as'=>'dosen.simpanedit', 'uses'=> 'Dosen\DosenController@simpanedit'));
	

		//Mahasiswa
	Route::get('/mahasiswa', array('as'=>'mahasiswa', 'uses'=>'Mahasiswa\MahasiswaController@index'));
	Route::get('/mahasiswa/{mhsNim}/detail', array('as'=>'mahasiswa.detail', 'uses'=>'Mahasiswa\MahasiswaController@detail'));
	Route::post('/mahasiswa/tambah', array('as'=>'mahasiswa.tambah', 'uses'=> 'Mahasiswa\MahasiswaController@tambahmahasiswa'));
	Route::get('/mahasiswa/{id}/hapus', array('as'=>'mahasiswa.hapus', 'uses'=> 'Mahasiswa\MahasiswaController@hapus'));
	Route::get('/mahasiswa/{id}/edit', array('as'=>'mahasiswa.edit', 'uses'=> 'Mahasiswa\MahasiswaController@editmahasiswa'));
	Route::put('/mahasiswa/{id}/simpanedit', array('as'=>'mahasiswa.simpanedit', 'uses'=> 'Mahasiswa\MahasiswaController@simpanedit'));

	//Semester
	Route::get('/semester', array('as'=>'semester', 'uses'=>'Semester\SemesterController@index'));
	Route::get('/semester/{id}/aktif', array('as'=>'semester.aktif', 'uses'=>'Semester\SemesterController@default_aktif'));
	Route::get('/semester/semesterprodi', array('as'=>'semesterprodi', 'uses'=>'Semester\SemesterController@semesterprodi'));
	//Route::get('/semester/tambah', array('as'=>'tambah', 'uses'=>'Semester\SemesterController@tambah'));
	Route::post('/semester/tambahsemester', array('as'=>'semester.tambah', 'uses'=>'Semester\SemesterController@tambahsemester'));
	Route::get('/semester/{id}/hapus', array('as'=>'semester.hapus', 'uses'=> 'Semester\SemesterController@hapus'));
	Route::get('/semester/{id}/edit', array('as'=>'semester.edit', 'uses'=> 'Semester\SemesterController@editsemester'));
	Route::get('/semester/registersemesterprodi', array('as'=>'register.semester.prodi', 'uses'=> 'Semester\SemesterController@registerSemesterProdi'));

	//Nilai
	Route::get('/nilai/jenis', array('as'=>'jenis.nilai', 'uses'=>'Nilai\NilaiController@jenis'));
	Route::post('/nilai/adminimportnilai', array('as'=>'admin.import.nilai', 'uses'=>'Nilai\NilaiController@importNilai'));
	Route::get('/nilai/admindownloadpeserta/{klsId}/{type}', array('as'=>'admin.export.peserta', 'uses'=>'Nilai\NilaiController@downloadPeserta'));
	
	//Kelas
	Route::get('/kelas', array('as'=>'kelas', 'uses'=>'Kelas\KelasController@index'));
	Route::post('/kelas/prodi', array('as'=>'kelasprodi', 'uses'=>'Kelas\KelasController@kelasprodi'));
	Route::get('/kelas/{id}/peserta', array('as'=>'kelaspeserta', 'uses'=>'Kelas\KelasController@peserta'));
	Route::get('/kelas/register', array('as'=>'kelas.register', 'uses'=>'Kelas\KelasController@showKelasRegister'));
	Route::post('/kelas/register/proses', array('as'=>'kelas.register.proses', 'uses'=>'Kelas\KelasController@kelasRegister'));
	Route::get('/kelas/mhsregister', array('as'=>'kelas.mhsregister', 'uses'=>'Kelas\KelasController@showMahasiswaRegister'));
	Route::post('/kelas/mhsregister/proses', array('as'=>'kelas.mhsregister.proses', 'uses'=>'Kelas\KelasController@kelasMahasiswaRegister'));
	Route::get('/kelas/register/kelaspeserta', array('as'=>'kelas.klspeserta.proses', 'uses'=>'Kelas\KelasController@registerPesertaKelas'));
	Route::post('/kelas/tambah/dosen/makul', array('as'=>'kelas.tambah.dosen.makul', 'uses'=>'Kelas\KelasController@tambahDosenMatakuliah'));
	Route::get('/kelas/{klsId}/jadwal', array('as'=>'kelas.jadwal', 'uses'=>'Kelas\KelasController@jadwal'));
	Route::put('/kelas/{klsId}/simpanjadwal', array('as'=>'kelas.simpanjadwal', 'uses'=> 'Kelas\KelasController@simpanjadwal'));

	//register Mahasiswa
	Route::get('/accountmahasiswa', array('as'=>'account.mahasiswa', 'uses'=>'Account\AccountController@showAccountMahasiswa'));
	Route::post('/accountmahasiswa/tambah', array('as'=>'account.mahasiswa.tambah', 'uses'=>'Account\AccountController@tambahAccountMahasiswa'));
	Route::get('/accountmahasiswa/{id}/hapus', array('as'=>'account.mahasiswa.hapus', 'uses'=> 'Account\AccountController@hapusMahasiswa'));

	//register Dosen
	Route::get('/accountdosen', array('as'=>'account.dosen', 'uses'=>'Account\AccountController@showAccountDosen'));
	Route::post('/accountdosen/tambah', array('as'=>'account.dosen.tambah', 'uses'=>'Account\AccountController@tambahAccountDosen'));
	Route::get('/accountdosen/{id}/hapus', array('as'=>'account.dosen.hapus', 'uses'=> 'Account\AccountController@hapusDosen'));
	/*Route::post('/accountmahasiswa/tambah', array('as'=>'account.mahasiswa.tambah', 'uses'=>'Account\AccountController@tambahAccountMahasiswa'));
	Route::get('/accountmahasiswa/{id}/hapus', array('as'=>'account.mahasiswa.hapus', 'uses'=> 'Account\AccountController@hapus'));*/

	//input nilai
	Route::get('/kelas/input/nilai', array('as'=>'kelas.input.nilai', 'uses'=>'Kelas\KelasController@showKelasInputNilai'));
	Route::post('/kelas/input/nilai', array('as'=>'kelas.input.nilai', 'uses'=>'Kelas\KelasController@showKelasInputNilai'));

	//spk
	Route::get('/pegawai',['as'=>'pegawai', 'uses'=> 'Mangkir\MangkirController@index']);
	Route::get('/pegawai/{id}/detail', array('as'=>'pegawai.mangkir', 'uses'=> 'Mangkir\MangkirController@detail'));

	Route::get('/presensi',['as'=>'presensi', 'uses'=> 'Presensi\PresensiController@index']);
	Route::post('/presensi/pilihtahun',['as'=>'pilihtahun', 'uses'=> 'Presensi\PresensiController@pilihtahun']);
	Route::get('/presensi/pilihtahun',['as'=>'pilihtahun', 'uses'=> 'Presensi\PresensiController@index']);
	Route::get('/presensi/{id}/detail', array('as'=>'presensi.detail', 'uses'=> 'Presensi\PresensiController@detail'));


	

});


//Route as Dosen
Route::group(['middleware' => ['web','auth','level:2']], function()    
{
	Route::get('/dosen/kelas/semester',['as'=>'kelassemester', 'uses'=> 'RoleDosen\RoleDosenController@kelasSemester']);
	Route::post('/dosen/kelas/semester',['as'=>'dosenkelassemester', 'uses'=> 'RoleDosen\RoleDosenController@kelasSemester']);

	Route::get('/dosen/pesertakelassemester/{klsId}',['as'=>'pesertakelassemester', 'uses'=> 'RoleDosen\RoleDosenController@pesertaKelasSemester']);	
	//
	//milik admin yang dipakai oleh Dosen
	//
	Route::post('/nilai/importnilai', array('as'=>'import.nilai', 'uses'=>'Nilai\NilaiController@importNilai'));
	Route::get('/nilai/downloadpeserta/{klsId}/{type}', array('as'=>'export.peserta', 'uses'=>'Nilai\NilaiController@downloadPeserta'));

	//cetak nyok
	Route::get('nilai/semesterkelaspeserta/cetak/{klsId}/{idCetak}',['as'=>'nilai.semester.kelas.peserta.cetak', 'uses'=> 'RoleDosen\RoleDosenController@nilaiSemesterCetak']);

	//reset password
	Route::get('reset/password/dosen',['as'=>'reset.password.dosen', 'uses'=> 'RoleDosen\RoleDosenController@formResetPasswordDosen']);
	Route::post('reset/password/dosen',['as'=>'reset.password.dosen', 'uses'=> 'RoleDosen\RoleDosenController@resetPasswordDosen']);
	Route::get('/jadwaldosen/{klsId}/jadwal', array('as'=>'jadwal', 'uses'=>'RoleDosen\RoleDosenController@jadwal'));
	Route::get('/detaildosen/{username}/detail', array('as'=>'detail', 'uses'=>'RoleDosen\RoleDosenController@detail'));

});

//Route as mahasiswa
Route::group(['middleware' => ['web','auth','level:3']], function()    
{
	Route::get('/nilai/semester',['as'=>'nilaisemester', 'uses'=> 'RoleMhs\RoleMhsController@nilaiSemester']);
	Route::post('/nilai/semester',['as'=>'nilaisemester', 'uses'=> 'RoleMhs\RoleMhsController@nilaiSemester']);
	Route::get('nilai/semester/cetak/{id}',['as'=>'nilaisemestercetak', 'uses'=> 'RoleMhs\RoleMhsController@nilaiSemesterCetak']);
	
	Route::get('/reset/password/mahasiswa',['as'=>'resetpasswordmahasiswa', 'uses'=> 'RoleMhs\RoleMhsController@formResetPasswordMahasiswa']);
	Route::post('/reset/password/mahasiswa',['as'=>'resetpasswordmahasiswa', 'uses'=> 'RoleMhs\RoleMhsController@resetPasswordMahasiswa']);
	Route::get('/jadwal/{klsId}/jadwal', array('as'=>'jadwal', 'uses'=>'RoleMhs\RoleMhsController@jadwal'));
	Route::get('/detailmahasiswa/{username}/detail', array('as'=>'detail', 'uses'=>'RoleMhs\RoleMhsController@detail'));


	
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

/*Route::group(['middleware' => 'web'], function () {
    Route::auth();
	
    //Route::get('/home', 'HomeController@index');
    //

});
*/

