<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



	Route::get('', 'IndexController@index')->name('index')->middleware(['redirect.to.home']);
	Route::get('index/login', 'IndexController@login')->name('login');
	
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::any('auth/logout', 'AuthController@logout')->name('logout')->middleware(['auth']);

	Route::get('auth/accountcreated', 'AuthController@accountcreated')->name('accountcreated');
	Route::get('auth/accountpending', 'AuthController@accountpending')->name('accountpending');
	Route::get('auth/accountblocked', 'AuthController@accountblocked')->name('accountblocked');
	Route::get('auth/accountinactive', 'AuthController@accountinactive')->name('accountinactive');


	
	Route::get('blog/view/{rec_id}', 'BlogController@view')->name('blog.view');	
	Route::get('blog/list_front', 'BlogController@list_front');
	Route::get('blog/list_front/{filter?}/{filtervalue?}', 'BlogController@list_front');	
	Route::get('harga_ternak/widgetharga', 'Harga_TernakController@widgetharga');
	Route::get('harga_ternak/widgetharga/{filter?}/{filtervalue?}', 'Harga_TernakController@widgetharga');	
	Route::get('komoditas_price/widget_komoditas', 'Komoditas_PriceController@widget_komoditas');
	Route::get('komoditas_price/widget_komoditas/{filter?}/{filtervalue?}', 'Komoditas_PriceController@widget_komoditas');	
	Route::get('peternak/depan', 'PeternakController@depan');
	Route::get('peternak/depan/{filter?}/{filtervalue?}', 'PeternakController@depan');	
	Route::get('peternak/peta', 'PeternakController@peta');
	Route::get('peternak/peta/{filter?}/{filtervalue?}', 'PeternakController@peta');	
	Route::get('poultry/depan', 'PoultryController@depan');
	Route::get('poultry/depan/{filter?}/{filtervalue?}', 'PoultryController@depan');	
	Route::get('web/peternakan', 'WebController@peternakan');
	Route::get('web/peternakan/{filter?}/{filtervalue?}', 'WebController@peternakan');	
	Route::get('web/pertanian', 'WebController@pertanian');
	Route::get('web/pertanian/{filter?}/{filtervalue?}', 'WebController@pertanian');	
	Route::get('web/perikanan', 'WebController@perikanan');
	Route::get('web/perikanan/{filter?}/{filtervalue?}', 'WebController@perikanan');	
	Route::get('web/ketahananpangan', 'WebController@ketahananpangan');
	Route::get('web/ketahananpangan/{filter?}/{filtervalue?}', 'WebController@ketahananpangan');	
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::get('auth/password/forgotpassword', 'AuthController@showForgotPassword')->name('password.forgotpassword');
	Route::post('auth/password/sendemail', 'AuthController@sendPasswordResetLink')->name('password.email');
	Route::get('auth/password/reset', 'AuthController@showResetPassword')->name('password.reset.token');
	Route::post('auth/password/resetpassword', 'AuthController@resetPassword')->name('password.resetpassword');
	Route::get('auth/password/resetcompleted', 'AuthController@passwordResetCompleted')->name('password.resetcompleted');
	Route::get('auth/password/linksent', 'AuthController@passwordResetLinkSent')->name('password.resetlinksent');
	

/**
 * All routes which requires auth
 */
Route::middleware(['auth', 'rbac'])->group(function () {
		
	Route::get('home', 'HomeController@index')->name('home');

	

/* routes for Aauth_Users Controller */
	Route::get('aauth_users', 'Aauth_UsersController@index')->name('aauth_users.index');
	Route::get('aauth_users/index/{filter?}/{filtervalue?}', 'Aauth_UsersController@index')->name('aauth_users.index');	
	Route::any('account/edit', 'AccountController@edit')->name('account.edit');	
	Route::get('account', 'AccountController@index');	
	Route::post('account/changepassword', 'AccountController@changepassword')->name('account.changepassword');	
	Route::get('aauth_users/add', 'Aauth_UsersController@add')->name('aauth_users.add');
	Route::post('aauth_users/add', 'Aauth_UsersController@store')->name('aauth_users.store');
		
	Route::any('aauth_users/edit/{rec_id}', 'Aauth_UsersController@edit')->name('aauth_users.edit');	
	Route::get('aauth_users/delete/{rec_id}', 'Aauth_UsersController@delete');

/* routes for Agenda Controller */
	Route::get('agenda', 'AgendaController@index')->name('agenda.index');
	Route::get('agenda/index/{filter?}/{filtervalue?}', 'AgendaController@index')->name('agenda.index');	
	Route::get('agenda/view/{rec_id}', 'AgendaController@view')->name('agenda.view');	
	Route::get('agenda/add', 'AgendaController@add')->name('agenda.add');
	Route::post('agenda/add', 'AgendaController@store')->name('agenda.store');
		
	Route::any('agenda/edit/{rec_id}', 'AgendaController@edit')->name('agenda.edit');	
	Route::get('agenda/delete/{rec_id}', 'AgendaController@delete');

/* routes for Bbi Controller */
	Route::get('bbi', 'BbiController@index')->name('bbi.index');
	Route::get('bbi/index/{filter?}/{filtervalue?}', 'BbiController@index')->name('bbi.index');	
	Route::get('bbi/view/{rec_id}', 'BbiController@view')->name('bbi.view');	
	Route::get('bbi/add', 'BbiController@add')->name('bbi.add');
	Route::post('bbi/add', 'BbiController@store')->name('bbi.store');
		
	Route::any('bbi/edit/{rec_id}', 'BbiController@edit')->name('bbi.edit');	
	Route::get('bbi/delete/{rec_id}', 'BbiController@delete');

/* routes for Blog Controller */
	Route::get('blog', 'BlogController@index')->name('blog.index');
	Route::get('blog/index/{filter?}/{filtervalue?}', 'BlogController@index')->name('blog.index');	
	Route::get('blog/add', 'BlogController@add')->name('blog.add');
	Route::post('blog/add', 'BlogController@store')->name('blog.store');
		
	Route::any('blog/edit/{rec_id}', 'BlogController@edit')->name('blog.edit');	
	Route::get('blog/delete/{rec_id}', 'BlogController@delete');

/* routes for Blog_Category Controller */
	Route::get('blog_category', 'Blog_CategoryController@index')->name('blog_category.index');
	Route::get('blog_category/index/{filter?}/{filtervalue?}', 'Blog_CategoryController@index')->name('blog_category.index');	
	Route::get('blog_category/view/{rec_id}', 'Blog_CategoryController@view')->name('blog_category.view');	
	Route::get('blog_category/add', 'Blog_CategoryController@add')->name('blog_category.add');
	Route::post('blog_category/add', 'Blog_CategoryController@store')->name('blog_category.store');
		
	Route::any('blog_category/edit/{rec_id}', 'Blog_CategoryController@edit')->name('blog_category.edit');	
	Route::get('blog_category/delete/{rec_id}', 'Blog_CategoryController@delete');

/* routes for Data_Vaksinasi Controller */
	Route::get('data_vaksinasi', 'Data_VaksinasiController@index')->name('data_vaksinasi.index');
	Route::get('data_vaksinasi/index/{filter?}/{filtervalue?}', 'Data_VaksinasiController@index')->name('data_vaksinasi.index');	
	Route::get('data_vaksinasi/view/{rec_id}', 'Data_VaksinasiController@view')->name('data_vaksinasi.view');	
	Route::get('data_vaksinasi/add', 'Data_VaksinasiController@add')->name('data_vaksinasi.add');
	Route::post('data_vaksinasi/add', 'Data_VaksinasiController@store')->name('data_vaksinasi.store');
		
	Route::any('data_vaksinasi/edit/{rec_id}', 'Data_VaksinasiController@edit')->name('data_vaksinasi.edit');	
	Route::get('data_vaksinasi/delete/{rec_id}', 'Data_VaksinasiController@delete');

/* routes for EvaluasiAdata Controller */
	Route::get('evaluasiadata', 'EvaluasiAdataController@index')->name('evaluasiadata.index');
	Route::get('evaluasiadata/index/{filter?}/{filtervalue?}', 'EvaluasiAdataController@index')->name('evaluasiadata.index');	
	Route::get('evaluasiadata/view/{rec_id}', 'EvaluasiAdataController@view')->name('evaluasiadata.view');	
	Route::get('evaluasiadata/add', 'EvaluasiAdataController@add')->name('evaluasiadata.add');
	Route::post('evaluasiadata/add', 'EvaluasiAdataController@store')->name('evaluasiadata.store');
		
	Route::any('evaluasiadata/edit/{rec_id}', 'EvaluasiAdataController@edit')->name('evaluasiadata.edit');	
	Route::get('evaluasiadata/delete/{rec_id}', 'EvaluasiAdataController@delete');

/* routes for EvaluasiIndikator Controller */
	Route::get('evaluasiindikator', 'EvaluasiIndikatorController@index')->name('evaluasiindikator.index');
	Route::get('evaluasiindikator/index/{filter?}/{filtervalue?}', 'EvaluasiIndikatorController@index')->name('evaluasiindikator.index');	
	Route::get('evaluasiindikator/view/{rec_id}', 'EvaluasiIndikatorController@view')->name('evaluasiindikator.view');	
	Route::get('evaluasiindikator/add', 'EvaluasiIndikatorController@add')->name('evaluasiindikator.add');
	Route::post('evaluasiindikator/add', 'EvaluasiIndikatorController@store')->name('evaluasiindikator.store');
		
	Route::any('evaluasiindikator/edit/{rec_id}', 'EvaluasiIndikatorController@edit')->name('evaluasiindikator.edit');	
	Route::get('evaluasiindikator/delete/{rec_id}', 'EvaluasiIndikatorController@delete');

/* routes for Gudang_Telur Controller */
	Route::get('gudang_telur', 'Gudang_TelurController@index')->name('gudang_telur.index');
	Route::get('gudang_telur/index/{filter?}/{filtervalue?}', 'Gudang_TelurController@index')->name('gudang_telur.index');	
	Route::get('gudang_telur/view/{rec_id}', 'Gudang_TelurController@view')->name('gudang_telur.view');	
	Route::get('gudang_telur/add', 'Gudang_TelurController@add')->name('gudang_telur.add');
	Route::post('gudang_telur/add', 'Gudang_TelurController@store')->name('gudang_telur.store');
		
	Route::any('gudang_telur/edit/{rec_id}', 'Gudang_TelurController@edit')->name('gudang_telur.edit');	
	Route::get('gudang_telur/delete/{rec_id}', 'Gudang_TelurController@delete');

/* routes for Harga_Ternak Controller */
	Route::get('harga_ternak', 'Harga_TernakController@index')->name('harga_ternak.index');
	Route::get('harga_ternak/index/{filter?}/{filtervalue?}', 'Harga_TernakController@index')->name('harga_ternak.index');	
	Route::get('harga_ternak/view/{rec_id}', 'Harga_TernakController@view')->name('harga_ternak.view');	
	Route::get('harga_ternak/add', 'Harga_TernakController@add')->name('harga_ternak.add');
	Route::post('harga_ternak/add', 'Harga_TernakController@store')->name('harga_ternak.store');
		
	Route::any('harga_ternak/edit/{rec_id}', 'Harga_TernakController@edit')->name('harga_ternak.edit');	
	Route::get('harga_ternak/delete/{rec_id}', 'Harga_TernakController@delete');

/* routes for IndikatorMaster Controller */
	Route::get('indikatormaster', 'IndikatorMasterController@index')->name('indikatormaster.index');
	Route::get('indikatormaster/index/{filter?}/{filtervalue?}', 'IndikatorMasterController@index')->name('indikatormaster.index');	
	Route::get('indikatormaster/view/{rec_id}', 'IndikatorMasterController@view')->name('indikatormaster.view');	
	Route::get('indikatormaster/add', 'IndikatorMasterController@add')->name('indikatormaster.add');
	Route::post('indikatormaster/add', 'IndikatorMasterController@store')->name('indikatormaster.store');
		
	Route::any('indikatormaster/edit/{rec_id}', 'IndikatorMasterController@edit')->name('indikatormaster.edit');	
	Route::get('indikatormaster/delete/{rec_id}', 'IndikatorMasterController@delete');	
	Route::get('indikatormaster/input', 'IndikatorMasterController@input');
	Route::get('indikatormaster/input/{filter?}/{filtervalue?}', 'IndikatorMasterController@input');	
	Route::get('indikatormaster/laporan', 'IndikatorMasterController@laporan');
	Route::get('indikatormaster/laporan/{filter?}/{filtervalue?}', 'IndikatorMasterController@laporan');

/* routes for InputHarga Controller */
	Route::get('inputharga', 'InputHargaController@index')->name('inputharga.index');
	Route::get('inputharga/index/{filter?}/{filtervalue?}', 'InputHargaController@index')->name('inputharga.index');	
	Route::get('inputharga/view/{rec_id}', 'InputHargaController@view')->name('inputharga.view');	
	Route::get('inputharga/add', 'InputHargaController@add')->name('inputharga.add');
	Route::post('inputharga/add', 'InputHargaController@store')->name('inputharga.store');
		
	Route::any('inputharga/edit/{rec_id}', 'InputHargaController@edit')->name('inputharga.edit');	
	Route::get('inputharga/delete/{rec_id}', 'InputHargaController@delete');

/* routes for Jenis_Hewan Controller */
	Route::get('jenis_hewan', 'Jenis_HewanController@index')->name('jenis_hewan.index');
	Route::get('jenis_hewan/index/{filter?}/{filtervalue?}', 'Jenis_HewanController@index')->name('jenis_hewan.index');	
	Route::get('jenis_hewan/view/{rec_id}', 'Jenis_HewanController@view')->name('jenis_hewan.view');	
	Route::get('jenis_hewan/add', 'Jenis_HewanController@add')->name('jenis_hewan.add');
	Route::post('jenis_hewan/add', 'Jenis_HewanController@store')->name('jenis_hewan.store');
		
	Route::any('jenis_hewan/edit/{rec_id}', 'Jenis_HewanController@edit')->name('jenis_hewan.edit');	
	Route::get('jenis_hewan/delete/{rec_id}', 'Jenis_HewanController@delete');

/* routes for Jenis_Ikan Controller */
	Route::get('jenis_ikan', 'Jenis_IkanController@index')->name('jenis_ikan.index');
	Route::get('jenis_ikan/index/{filter?}/{filtervalue?}', 'Jenis_IkanController@index')->name('jenis_ikan.index');	
	Route::get('jenis_ikan/view/{rec_id}', 'Jenis_IkanController@view')->name('jenis_ikan.view');	
	Route::get('jenis_ikan/add', 'Jenis_IkanController@add')->name('jenis_ikan.add');
	Route::post('jenis_ikan/add', 'Jenis_IkanController@store')->name('jenis_ikan.store');
		
	Route::any('jenis_ikan/edit/{rec_id}', 'Jenis_IkanController@edit')->name('jenis_ikan.edit');	
	Route::get('jenis_ikan/delete/{rec_id}', 'Jenis_IkanController@delete');

/* routes for Jenis_Map Controller */
	Route::get('jenis_map', 'Jenis_MapController@index')->name('jenis_map.index');
	Route::get('jenis_map/index/{filter?}/{filtervalue?}', 'Jenis_MapController@index')->name('jenis_map.index');	
	Route::get('jenis_map/view/{rec_id}', 'Jenis_MapController@view')->name('jenis_map.view');	
	Route::get('jenis_map/add', 'Jenis_MapController@add')->name('jenis_map.add');
	Route::post('jenis_map/add', 'Jenis_MapController@store')->name('jenis_map.store');
		
	Route::any('jenis_map/edit/{rec_id}', 'Jenis_MapController@edit')->name('jenis_map.edit');	
	Route::get('jenis_map/delete/{rec_id}', 'Jenis_MapController@delete');

/* routes for Jenis_Profil Controller */
	Route::get('jenis_profil', 'Jenis_ProfilController@index')->name('jenis_profil.index');
	Route::get('jenis_profil/index/{filter?}/{filtervalue?}', 'Jenis_ProfilController@index')->name('jenis_profil.index');	
	Route::get('jenis_profil/view/{rec_id}', 'Jenis_ProfilController@view')->name('jenis_profil.view');	
	Route::get('jenis_profil/add', 'Jenis_ProfilController@add')->name('jenis_profil.add');
	Route::post('jenis_profil/add', 'Jenis_ProfilController@store')->name('jenis_profil.store');
		
	Route::any('jenis_profil/edit/{rec_id}', 'Jenis_ProfilController@edit')->name('jenis_profil.edit');	
	Route::get('jenis_profil/delete/{rec_id}', 'Jenis_ProfilController@delete');

/* routes for Jenis_Surat Controller */
	Route::get('jenis_surat', 'Jenis_SuratController@index')->name('jenis_surat.index');
	Route::get('jenis_surat/index/{filter?}/{filtervalue?}', 'Jenis_SuratController@index')->name('jenis_surat.index');	
	Route::get('jenis_surat/view/{rec_id}', 'Jenis_SuratController@view')->name('jenis_surat.view');	
	Route::get('jenis_surat/add', 'Jenis_SuratController@add')->name('jenis_surat.add');
	Route::post('jenis_surat/add', 'Jenis_SuratController@store')->name('jenis_surat.store');
		
	Route::any('jenis_surat/edit/{rec_id}', 'Jenis_SuratController@edit')->name('jenis_surat.edit');	
	Route::get('jenis_surat/delete/{rec_id}', 'Jenis_SuratController@delete');

/* routes for Jumlah_Komoditas Controller */
	Route::get('jumlah_komoditas', 'Jumlah_KomoditasController@index')->name('jumlah_komoditas.index');
	Route::get('jumlah_komoditas/index/{filter?}/{filtervalue?}', 'Jumlah_KomoditasController@index')->name('jumlah_komoditas.index');	
	Route::get('jumlah_komoditas/view/{rec_id}', 'Jumlah_KomoditasController@view')->name('jumlah_komoditas.view');	
	Route::get('jumlah_komoditas/add', 'Jumlah_KomoditasController@add')->name('jumlah_komoditas.add');
	Route::post('jumlah_komoditas/add', 'Jumlah_KomoditasController@store')->name('jumlah_komoditas.store');
		
	Route::any('jumlah_komoditas/edit/{rec_id}', 'Jumlah_KomoditasController@edit')->name('jumlah_komoditas.edit');	
	Route::get('jumlah_komoditas/delete/{rec_id}', 'Jumlah_KomoditasController@delete');

/* routes for Kel_Tani Controller */
	Route::get('kel_tani', 'Kel_TaniController@index')->name('kel_tani.index');
	Route::get('kel_tani/index/{filter?}/{filtervalue?}', 'Kel_TaniController@index')->name('kel_tani.index');	
	Route::get('kel_tani/view/{rec_id}', 'Kel_TaniController@view')->name('kel_tani.view');
	Route::get('kel_tani/masterdetail/{rec_id}', 'Kel_TaniController@masterDetail')->name('kel_tani.masterdetail')->withoutMiddleware(['rbac']);	
	Route::get('kel_tani/add', 'Kel_TaniController@add')->name('kel_tani.add');
	Route::post('kel_tani/add', 'Kel_TaniController@store')->name('kel_tani.store');
		
	Route::any('kel_tani/edit/{rec_id}', 'Kel_TaniController@edit')->name('kel_tani.edit');	
	Route::get('kel_tani/delete/{rec_id}', 'Kel_TaniController@delete');

/* routes for Kelompok_Ikan Controller */
	Route::get('kelompok_ikan', 'Kelompok_IkanController@index')->name('kelompok_ikan.index');
	Route::get('kelompok_ikan/index/{filter?}/{filtervalue?}', 'Kelompok_IkanController@index')->name('kelompok_ikan.index');	
	Route::get('kelompok_ikan/view/{rec_id}', 'Kelompok_IkanController@view')->name('kelompok_ikan.view');	
	Route::get('kelompok_ikan/add', 'Kelompok_IkanController@add')->name('kelompok_ikan.add');
	Route::post('kelompok_ikan/add', 'Kelompok_IkanController@store')->name('kelompok_ikan.store');
		
	Route::any('kelompok_ikan/edit/{rec_id}', 'Kelompok_IkanController@edit')->name('kelompok_ikan.edit');	
	Route::get('kelompok_ikan/delete/{rec_id}', 'Kelompok_IkanController@delete');

/* routes for Kelompok_Ikan_Hias Controller */
	Route::get('kelompok_ikan_hias', 'Kelompok_Ikan_HiasController@index')->name('kelompok_ikan_hias.index');
	Route::get('kelompok_ikan_hias/index/{filter?}/{filtervalue?}', 'Kelompok_Ikan_HiasController@index')->name('kelompok_ikan_hias.index');	
	Route::get('kelompok_ikan_hias/view/{rec_id}', 'Kelompok_Ikan_HiasController@view')->name('kelompok_ikan_hias.view');	
	Route::get('kelompok_ikan_hias/add', 'Kelompok_Ikan_HiasController@add')->name('kelompok_ikan_hias.add');
	Route::post('kelompok_ikan_hias/add', 'Kelompok_Ikan_HiasController@store')->name('kelompok_ikan_hias.store');
		
	Route::any('kelompok_ikan_hias/edit/{rec_id}', 'Kelompok_Ikan_HiasController@edit')->name('kelompok_ikan_hias.edit');	
	Route::get('kelompok_ikan_hias/delete/{rec_id}', 'Kelompok_Ikan_HiasController@delete');

/* routes for Kelompok_Pemasar_Ikan Controller */
	Route::get('kelompok_pemasar_ikan', 'Kelompok_Pemasar_IkanController@index')->name('kelompok_pemasar_ikan.index');
	Route::get('kelompok_pemasar_ikan/index/{filter?}/{filtervalue?}', 'Kelompok_Pemasar_IkanController@index')->name('kelompok_pemasar_ikan.index');	
	Route::get('kelompok_pemasar_ikan/view/{rec_id}', 'Kelompok_Pemasar_IkanController@view')->name('kelompok_pemasar_ikan.view');	
	Route::get('kelompok_pemasar_ikan/add', 'Kelompok_Pemasar_IkanController@add')->name('kelompok_pemasar_ikan.add');
	Route::post('kelompok_pemasar_ikan/add', 'Kelompok_Pemasar_IkanController@store')->name('kelompok_pemasar_ikan.store');
		
	Route::any('kelompok_pemasar_ikan/edit/{rec_id}', 'Kelompok_Pemasar_IkanController@edit')->name('kelompok_pemasar_ikan.edit');	
	Route::get('kelompok_pemasar_ikan/delete/{rec_id}', 'Kelompok_Pemasar_IkanController@delete');

/* routes for Kios_Daging Controller */
	Route::get('kios_daging', 'Kios_DagingController@index')->name('kios_daging.index');
	Route::get('kios_daging/index/{filter?}/{filtervalue?}', 'Kios_DagingController@index')->name('kios_daging.index');	
	Route::get('kios_daging/view/{rec_id}', 'Kios_DagingController@view')->name('kios_daging.view');	
	Route::get('kios_daging/add', 'Kios_DagingController@add')->name('kios_daging.add');
	Route::post('kios_daging/add', 'Kios_DagingController@store')->name('kios_daging.store');
		
	Route::any('kios_daging/edit/{rec_id}', 'Kios_DagingController@edit')->name('kios_daging.edit');	
	Route::get('kios_daging/delete/{rec_id}', 'Kios_DagingController@delete');	
	Route::get('kios_daging/depan', 'Kios_DagingController@depan');
	Route::get('kios_daging/depan/{filter?}/{filtervalue?}', 'Kios_DagingController@depan');	
	Route::get('kios_daging/peta', 'Kios_DagingController@peta');
	Route::get('kios_daging/peta/{filter?}/{filtervalue?}', 'Kios_DagingController@peta');

/* routes for Kios_Pupuk Controller */
	Route::get('kios_pupuk', 'Kios_PupukController@index')->name('kios_pupuk.index');
	Route::get('kios_pupuk/index/{filter?}/{filtervalue?}', 'Kios_PupukController@index')->name('kios_pupuk.index');	
	Route::get('kios_pupuk/view/{rec_id}', 'Kios_PupukController@view')->name('kios_pupuk.view');	
	Route::get('kios_pupuk/add', 'Kios_PupukController@add')->name('kios_pupuk.add');
	Route::post('kios_pupuk/add', 'Kios_PupukController@store')->name('kios_pupuk.store');
		
	Route::any('kios_pupuk/edit/{rec_id}', 'Kios_PupukController@edit')->name('kios_pupuk.edit');	
	Route::get('kios_pupuk/delete/{rec_id}', 'Kios_PupukController@delete');

/* routes for Komoditas Controller */
	Route::get('komoditas', 'KomoditasController@index')->name('komoditas.index');
	Route::get('komoditas/index/{filter?}/{filtervalue?}', 'KomoditasController@index')->name('komoditas.index');	
	Route::get('komoditas/view/{rec_id}', 'KomoditasController@view')->name('komoditas.view');	
	Route::get('komoditas/add', 'KomoditasController@add')->name('komoditas.add');
	Route::post('komoditas/add', 'KomoditasController@store')->name('komoditas.store');
		
	Route::any('komoditas/edit/{rec_id}', 'KomoditasController@edit')->name('komoditas.edit');	
	Route::get('komoditas/delete/{rec_id}', 'KomoditasController@delete');

/* routes for Komoditas_Price Controller */
	Route::get('komoditas_price', 'Komoditas_PriceController@index')->name('komoditas_price.index');
	Route::get('komoditas_price/index/{filter?}/{filtervalue?}', 'Komoditas_PriceController@index')->name('komoditas_price.index');	
	Route::get('komoditas_price/view/{rec_id}', 'Komoditas_PriceController@view')->name('komoditas_price.view');	
	Route::get('komoditas_price/add', 'Komoditas_PriceController@add')->name('komoditas_price.add');
	Route::post('komoditas_price/add', 'Komoditas_PriceController@store')->name('komoditas_price.store');
		
	Route::any('komoditas_price/edit/{rec_id}', 'Komoditas_PriceController@edit')->name('komoditas_price.edit');	
	Route::get('komoditas_price/delete/{rec_id}', 'Komoditas_PriceController@delete');

/* routes for Konsul Controller */
	Route::get('konsul', 'KonsulController@index')->name('konsul.index');
	Route::get('konsul/index/{filter?}/{filtervalue?}', 'KonsulController@index')->name('konsul.index');	
	Route::get('konsul/view/{rec_id}', 'KonsulController@view')->name('konsul.view');	
	Route::get('konsul/add', 'KonsulController@add')->name('konsul.add');
	Route::post('konsul/add', 'KonsulController@store')->name('konsul.store');
		
	Route::any('konsul/edit/{rec_id}', 'KonsulController@edit')->name('konsul.edit');	
	Route::get('konsul/delete/{rec_id}', 'KonsulController@delete');

/* routes for Konsultasi Controller */
	Route::get('konsultasi', 'KonsultasiController@index')->name('konsultasi.index');
	Route::get('konsultasi/index/{filter?}/{filtervalue?}', 'KonsultasiController@index')->name('konsultasi.index');	
	Route::get('konsultasi/view/{rec_id}', 'KonsultasiController@view')->name('konsultasi.view');	
	Route::get('konsultasi/add', 'KonsultasiController@add')->name('konsultasi.add');
	Route::post('konsultasi/add', 'KonsultasiController@store')->name('konsultasi.store');
		
	Route::any('konsultasi/edit/{rec_id}', 'KonsultasiController@edit')->name('konsultasi.edit');	
	Route::get('konsultasi/delete/{rec_id}', 'KonsultasiController@delete');

/* routes for Konsultasi_Jawaban Controller */
	Route::get('konsultasi_jawaban', 'Konsultasi_JawabanController@index')->name('konsultasi_jawaban.index');
	Route::get('konsultasi_jawaban/index/{filter?}/{filtervalue?}', 'Konsultasi_JawabanController@index')->name('konsultasi_jawaban.index');	
	Route::get('konsultasi_jawaban/view/{rec_id}', 'Konsultasi_JawabanController@view')->name('konsultasi_jawaban.view');	
	Route::get('konsultasi_jawaban/add', 'Konsultasi_JawabanController@add')->name('konsultasi_jawaban.add');
	Route::post('konsultasi_jawaban/add', 'Konsultasi_JawabanController@store')->name('konsultasi_jawaban.store');
		
	Route::any('konsultasi_jawaban/edit/{rec_id}', 'Konsultasi_JawabanController@edit')->name('konsultasi_jawaban.edit');	
	Route::get('konsultasi_jawaban/delete/{rec_id}', 'Konsultasi_JawabanController@delete');

/* routes for Map Controller */
	Route::get('map', 'MapController@index')->name('map.index');
	Route::get('map/index/{filter?}/{filtervalue?}', 'MapController@index')->name('map.index');	
	Route::get('map/view/{rec_id}', 'MapController@view')->name('map.view');	
	Route::get('map/add', 'MapController@add')->name('map.add');
	Route::post('map/add', 'MapController@store')->name('map.store');
		
	Route::any('map/edit/{rec_id}', 'MapController@edit')->name('map.edit');	
	Route::get('map/delete/{rec_id}', 'MapController@delete');

/* routes for Master_Bidang Controller */
	Route::get('master_bidang', 'Master_BidangController@index')->name('master_bidang.index');
	Route::get('master_bidang/index/{filter?}/{filtervalue?}', 'Master_BidangController@index')->name('master_bidang.index');	
	Route::get('master_bidang/view/{rec_id}', 'Master_BidangController@view')->name('master_bidang.view');	
	Route::get('master_bidang/add', 'Master_BidangController@add')->name('master_bidang.add');
	Route::post('master_bidang/add', 'Master_BidangController@store')->name('master_bidang.store');
		
	Route::any('master_bidang/edit/{rec_id}', 'Master_BidangController@edit')->name('master_bidang.edit');	
	Route::get('master_bidang/delete/{rec_id}', 'Master_BidangController@delete');

/* routes for MasterAdata Controller */
	Route::get('masteradata', 'MasterAdataController@index')->name('masteradata.index');
	Route::get('masteradata/index/{filter?}/{filtervalue?}', 'MasterAdataController@index')->name('masteradata.index');	
	Route::get('masteradata/view/{rec_id}', 'MasterAdataController@view')->name('masteradata.view');	
	Route::get('masteradata/add', 'MasterAdataController@add')->name('masteradata.add');
	Route::post('masteradata/add', 'MasterAdataController@store')->name('masteradata.store');
		
	Route::any('masteradata/edit/{rec_id}', 'MasterAdataController@edit')->name('masteradata.edit');	
	Route::get('masteradata/delete/{rec_id}', 'MasterAdataController@delete');	
	Route::get('masteradata/input', 'MasterAdataController@input');
	Route::get('masteradata/input/{filter?}/{filtervalue?}', 'MasterAdataController@input');	
	Route::get('masteradata/laporan', 'MasterAdataController@laporan');
	Route::get('masteradata/laporan/{filter?}/{filtervalue?}', 'MasterAdataController@laporan');

/* routes for P4s Controller */
	Route::get('p4s', 'P4sController@index')->name('p4s.index');
	Route::get('p4s/index/{filter?}/{filtervalue?}', 'P4sController@index')->name('p4s.index');	
	Route::get('p4s/view/{rec_id}', 'P4sController@view')->name('p4s.view');	
	Route::get('p4s/add', 'P4sController@add')->name('p4s.add');
	Route::post('p4s/add', 'P4sController@store')->name('p4s.store');
		
	Route::any('p4s/edit/{rec_id}', 'P4sController@edit')->name('p4s.edit');	
	Route::get('p4s/delete/{rec_id}', 'P4sController@delete');

/* routes for Page Controller */
	Route::get('page', 'PageController@index')->name('page.index');
	Route::get('page/index/{filter?}/{filtervalue?}', 'PageController@index')->name('page.index');	
	Route::get('page/view/{rec_id}', 'PageController@view')->name('page.view');	
	Route::get('page/add', 'PageController@add')->name('page.add');
	Route::post('page/add', 'PageController@store')->name('page.store');
		
	Route::any('page/edit/{rec_id}', 'PageController@edit')->name('page.edit');	
	Route::get('page/delete/{rec_id}', 'PageController@delete');

/* routes for Pelaku_Usaha_Peternakan Controller */
	Route::get('pelaku_usaha_peternakan', 'Pelaku_Usaha_PeternakanController@index')->name('pelaku_usaha_peternakan.index');
	Route::get('pelaku_usaha_peternakan/index/{filter?}/{filtervalue?}', 'Pelaku_Usaha_PeternakanController@index')->name('pelaku_usaha_peternakan.index');	
	Route::get('pelaku_usaha_peternakan/view/{rec_id}', 'Pelaku_Usaha_PeternakanController@view')->name('pelaku_usaha_peternakan.view');	
	Route::get('pelaku_usaha_peternakan/add', 'Pelaku_Usaha_PeternakanController@add')->name('pelaku_usaha_peternakan.add');
	Route::post('pelaku_usaha_peternakan/add', 'Pelaku_Usaha_PeternakanController@store')->name('pelaku_usaha_peternakan.store');
		
	Route::any('pelaku_usaha_peternakan/edit/{rec_id}', 'Pelaku_Usaha_PeternakanController@edit')->name('pelaku_usaha_peternakan.edit');	
	Route::get('pelaku_usaha_peternakan/delete/{rec_id}', 'Pelaku_Usaha_PeternakanController@delete');

/* routes for Pelaku_Usaha_Tani Controller */
	Route::get('pelaku_usaha_tani', 'Pelaku_Usaha_TaniController@index')->name('pelaku_usaha_tani.index');
	Route::get('pelaku_usaha_tani/index/{filter?}/{filtervalue?}', 'Pelaku_Usaha_TaniController@index')->name('pelaku_usaha_tani.index');	
	Route::get('pelaku_usaha_tani/view/{rec_id}', 'Pelaku_Usaha_TaniController@view')->name('pelaku_usaha_tani.view');	
	Route::get('pelaku_usaha_tani/add', 'Pelaku_Usaha_TaniController@add')->name('pelaku_usaha_tani.add');
	Route::post('pelaku_usaha_tani/add', 'Pelaku_Usaha_TaniController@store')->name('pelaku_usaha_tani.store');
		
	Route::any('pelaku_usaha_tani/edit/{rec_id}', 'Pelaku_Usaha_TaniController@edit')->name('pelaku_usaha_tani.edit');	
	Route::get('pelaku_usaha_tani/delete/{rec_id}', 'Pelaku_Usaha_TaniController@delete');

/* routes for Penjual_Ayam_Potong Controller */
	Route::get('penjual_ayam_potong', 'Penjual_Ayam_PotongController@index')->name('penjual_ayam_potong.index');
	Route::get('penjual_ayam_potong/index/{filter?}/{filtervalue?}', 'Penjual_Ayam_PotongController@index')->name('penjual_ayam_potong.index');	
	Route::get('penjual_ayam_potong/view/{rec_id}', 'Penjual_Ayam_PotongController@view')->name('penjual_ayam_potong.view');	
	Route::get('penjual_ayam_potong/add', 'Penjual_Ayam_PotongController@add')->name('penjual_ayam_potong.add');
	Route::post('penjual_ayam_potong/add', 'Penjual_Ayam_PotongController@store')->name('penjual_ayam_potong.store');
		
	Route::any('penjual_ayam_potong/edit/{rec_id}', 'Penjual_Ayam_PotongController@edit')->name('penjual_ayam_potong.edit');	
	Route::get('penjual_ayam_potong/delete/{rec_id}', 'Penjual_Ayam_PotongController@delete');

/* routes for Penyakit Controller */
	Route::get('penyakit', 'PenyakitController@index')->name('penyakit.index');
	Route::get('penyakit/index/{filter?}/{filtervalue?}', 'PenyakitController@index')->name('penyakit.index');	
	Route::get('penyakit/view/{rec_id}', 'PenyakitController@view')->name('penyakit.view');	
	Route::get('penyakit/add', 'PenyakitController@add')->name('penyakit.add');
	Route::post('penyakit/add', 'PenyakitController@store')->name('penyakit.store');
		
	Route::any('penyakit/edit/{rec_id}', 'PenyakitController@edit')->name('penyakit.edit');	
	Route::get('penyakit/delete/{rec_id}', 'PenyakitController@delete');

/* routes for PeriodeEvaluasi Controller */
	Route::get('periodeevaluasi', 'PeriodeEvaluasiController@index')->name('periodeevaluasi.index');
	Route::get('periodeevaluasi/index/{filter?}/{filtervalue?}', 'PeriodeEvaluasiController@index')->name('periodeevaluasi.index');	
	Route::get('periodeevaluasi/view/{rec_id}', 'PeriodeEvaluasiController@view')->name('periodeevaluasi.view');	
	Route::get('periodeevaluasi/add', 'PeriodeEvaluasiController@add')->name('periodeevaluasi.add');
	Route::post('periodeevaluasi/add', 'PeriodeEvaluasiController@store')->name('periodeevaluasi.store');
		
	Route::any('periodeevaluasi/edit/{rec_id}', 'PeriodeEvaluasiController@edit')->name('periodeevaluasi.edit');	
	Route::get('periodeevaluasi/delete/{rec_id}', 'PeriodeEvaluasiController@delete');	
	Route::get('periodeevaluasi/evaluasi', 'PeriodeEvaluasiController@evaluasi');
	Route::get('periodeevaluasi/evaluasi/{filter?}/{filtervalue?}', 'PeriodeEvaluasiController@evaluasi');

/* routes for Permissions Controller */
	Route::get('permissions', 'PermissionsController@index')->name('permissions.index');
	Route::get('permissions/index/{filter?}/{filtervalue?}', 'PermissionsController@index')->name('permissions.index');	
	Route::get('permissions/view/{rec_id}', 'PermissionsController@view')->name('permissions.view');	
	Route::get('permissions/add', 'PermissionsController@add')->name('permissions.add');
	Route::post('permissions/add', 'PermissionsController@store')->name('permissions.store');
		
	Route::any('permissions/edit/{rec_id}', 'PermissionsController@edit')->name('permissions.edit');	
	Route::get('permissions/delete/{rec_id}', 'PermissionsController@delete');

/* routes for Permohonan_Surat Controller */
	Route::get('permohonan_surat', 'Permohonan_SuratController@index')->name('permohonan_surat.index');
	Route::get('permohonan_surat/index/{filter?}/{filtervalue?}', 'Permohonan_SuratController@index')->name('permohonan_surat.index');	
	Route::get('permohonan_surat/view/{rec_id}', 'Permohonan_SuratController@view')->name('permohonan_surat.view');	
	Route::get('permohonan_surat/add', 'Permohonan_SuratController@add')->name('permohonan_surat.add');
	Route::post('permohonan_surat/add', 'Permohonan_SuratController@store')->name('permohonan_surat.store');
		
	Route::any('permohonan_surat/edit/{rec_id}', 'Permohonan_SuratController@edit')->name('permohonan_surat.edit');	
	Route::get('permohonan_surat/delete/{rec_id}', 'Permohonan_SuratController@delete');

/* routes for Peta Controller */

/* routes for Peternak Controller */
	Route::get('peternak', 'PeternakController@index')->name('peternak.index');
	Route::get('peternak/index/{filter?}/{filtervalue?}', 'PeternakController@index')->name('peternak.index');	
	Route::get('peternak/view/{rec_id}', 'PeternakController@view')->name('peternak.view');	
	Route::get('peternak/add', 'PeternakController@add')->name('peternak.add');
	Route::post('peternak/add', 'PeternakController@store')->name('peternak.store');
		
	Route::any('peternak/edit/{rec_id}', 'PeternakController@edit')->name('peternak.edit');	
	Route::get('peternak/delete/{rec_id}', 'PeternakController@delete');

/* routes for Petugas_Vaksin Controller */
	Route::get('petugas_vaksin', 'Petugas_VaksinController@index')->name('petugas_vaksin.index');
	Route::get('petugas_vaksin/index/{filter?}/{filtervalue?}', 'Petugas_VaksinController@index')->name('petugas_vaksin.index');	
	Route::get('petugas_vaksin/view/{rec_id}', 'Petugas_VaksinController@view')->name('petugas_vaksin.view');	
	Route::get('petugas_vaksin/add', 'Petugas_VaksinController@add')->name('petugas_vaksin.add');
	Route::post('petugas_vaksin/add', 'Petugas_VaksinController@store')->name('petugas_vaksin.store');
		
	Route::any('petugas_vaksin/edit/{rec_id}', 'Petugas_VaksinController@edit')->name('petugas_vaksin.edit');	
	Route::get('petugas_vaksin/delete/{rec_id}', 'Petugas_VaksinController@delete');

/* routes for Photo Controller */
	Route::get('photo', 'PhotoController@index')->name('photo.index');
	Route::get('photo/index/{filter?}/{filtervalue?}', 'PhotoController@index')->name('photo.index');	
	Route::get('photo/view/{rec_id}', 'PhotoController@view')->name('photo.view');	
	Route::get('photo/add', 'PhotoController@add')->name('photo.add');
	Route::post('photo/add', 'PhotoController@store')->name('photo.store');
		
	Route::any('photo/edit/{rec_id}', 'PhotoController@edit')->name('photo.edit');	
	Route::get('photo/delete/{rec_id}', 'PhotoController@delete');

/* routes for Poultry Controller */
	Route::get('poultry', 'PoultryController@index')->name('poultry.index');
	Route::get('poultry/index/{filter?}/{filtervalue?}', 'PoultryController@index')->name('poultry.index');	
	Route::get('poultry/view/{rec_id}', 'PoultryController@view')->name('poultry.view');	
	Route::get('poultry/add', 'PoultryController@add')->name('poultry.add');
	Route::post('poultry/add', 'PoultryController@store')->name('poultry.store');
		
	Route::any('poultry/edit/{rec_id}', 'PoultryController@edit')->name('poultry.edit');	
	Route::get('poultry/delete/{rec_id}', 'PoultryController@delete');

/* routes for Profil Controller */
	Route::get('profil', 'ProfilController@index')->name('profil.index');
	Route::get('profil/index/{filter?}/{filtervalue?}', 'ProfilController@index')->name('profil.index');	
	Route::get('profil/view/{rec_id}', 'ProfilController@view')->name('profil.view');	
	Route::get('profil/add', 'ProfilController@add')->name('profil.add');
	Route::post('profil/add', 'ProfilController@store')->name('profil.store');
		
	Route::any('profil/edit/{rec_id}', 'ProfilController@edit')->name('profil.edit');	
	Route::get('profil/delete/{rec_id}', 'ProfilController@delete');

/* routes for Profile Controller */
	Route::get('profile', 'ProfileController@index')->name('profile.index');
	Route::get('profile/index/{filter?}/{filtervalue?}', 'ProfileController@index')->name('profile.index');	
	Route::get('profile/view/{rec_id}', 'ProfileController@view')->name('profile.view');	
	Route::get('profile/add', 'ProfileController@add')->name('profile.add');
	Route::post('profile/add', 'ProfileController@store')->name('profile.store');
		
	Route::any('profile/edit/{rec_id}', 'ProfileController@edit')->name('profile.edit');	
	Route::get('profile/delete/{rec_id}', 'ProfileController@delete');

/* routes for Pupo Controller */
	Route::get('pupo', 'PupoController@index')->name('pupo.index');
	Route::get('pupo/index/{filter?}/{filtervalue?}', 'PupoController@index')->name('pupo.index');	
	Route::get('pupo/view/{rec_id}', 'PupoController@view')->name('pupo.view');	
	Route::get('pupo/add', 'PupoController@add')->name('pupo.add');
	Route::post('pupo/add', 'PupoController@store')->name('pupo.store');
		
	Route::any('pupo/edit/{rec_id}', 'PupoController@edit')->name('pupo.edit');	
	Route::get('pupo/delete/{rec_id}', 'PupoController@delete');

/* routes for Puskeswan Controller */
	Route::get('puskeswan', 'PuskeswanController@index')->name('puskeswan.index');
	Route::get('puskeswan/index/{filter?}/{filtervalue?}', 'PuskeswanController@index')->name('puskeswan.index');	
	Route::get('puskeswan/view/{rec_id}', 'PuskeswanController@view')->name('puskeswan.view');	
	Route::get('puskeswan/add', 'PuskeswanController@add')->name('puskeswan.add');
	Route::post('puskeswan/add', 'PuskeswanController@store')->name('puskeswan.store');
		
	Route::any('puskeswan/edit/{rec_id}', 'PuskeswanController@edit')->name('puskeswan.edit');	
	Route::get('puskeswan/delete/{rec_id}', 'PuskeswanController@delete');

/* routes for Roles Controller */
	Route::get('roles', 'RolesController@index')->name('roles.index');
	Route::get('roles/index/{filter?}/{filtervalue?}', 'RolesController@index')->name('roles.index');	
	Route::get('roles/view/{rec_id}', 'RolesController@view')->name('roles.view');
	Route::get('roles/masterdetail/{rec_id}', 'RolesController@masterDetail')->name('roles.masterdetail')->withoutMiddleware(['rbac']);	
	Route::get('roles/add', 'RolesController@add')->name('roles.add');
	Route::post('roles/add', 'RolesController@store')->name('roles.store');
		
	Route::any('roles/edit/{rec_id}', 'RolesController@edit')->name('roles.edit');	
	Route::get('roles/delete/{rec_id}', 'RolesController@delete');

/* routes for Rph Controller */
	Route::get('rph', 'RphController@index')->name('rph.index');
	Route::get('rph/index/{filter?}/{filtervalue?}', 'RphController@index')->name('rph.index');	
	Route::get('rph/view/{rec_id}', 'RphController@view')->name('rph.view');	
	Route::get('rph/add', 'RphController@add')->name('rph.add');
	Route::post('rph/add', 'RphController@store')->name('rph.store');
		
	Route::any('rph/edit/{rec_id}', 'RphController@edit')->name('rph.edit');	
	Route::get('rph/delete/{rec_id}', 'RphController@delete');

/* routes for Slider Controller */
	Route::get('slider', 'SliderController@index')->name('slider.index');
	Route::get('slider/index/{filter?}/{filtervalue?}', 'SliderController@index')->name('slider.index');	
	Route::get('slider/view/{rec_id}', 'SliderController@view')->name('slider.view');	
	Route::get('slider/add', 'SliderController@add')->name('slider.add');
	Route::post('slider/add', 'SliderController@store')->name('slider.store');
		
	Route::any('slider/edit/{rec_id}', 'SliderController@edit')->name('slider.edit');	
	Route::get('slider/delete/{rec_id}', 'SliderController@delete');

/* routes for Status Controller */
	Route::get('status', 'StatusController@index')->name('status.index');
	Route::get('status/index/{filter?}/{filtervalue?}', 'StatusController@index')->name('status.index');	
	Route::get('status/view/{rec_id}', 'StatusController@view')->name('status.view');	
	Route::get('status/add', 'StatusController@add')->name('status.add');
	Route::post('status/add', 'StatusController@store')->name('status.store');
		
	Route::any('status/edit/{rec_id}', 'StatusController@edit')->name('status.edit');	
	Route::get('status/delete/{rec_id}', 'StatusController@delete');

/* routes for Status_Surat Controller */
	Route::get('status_surat', 'Status_SuratController@index')->name('status_surat.index');
	Route::get('status_surat/index/{filter?}/{filtervalue?}', 'Status_SuratController@index')->name('status_surat.index');	
	Route::get('status_surat/view/{rec_id}', 'Status_SuratController@view')->name('status_surat.view');	
	Route::get('status_surat/add', 'Status_SuratController@add')->name('status_surat.add');
	Route::post('status_surat/add', 'Status_SuratController@store')->name('status_surat.store');
		
	Route::any('status_surat/edit/{rec_id}', 'Status_SuratController@edit')->name('status_surat.edit');	
	Route::get('status_surat/delete/{rec_id}', 'Status_SuratController@delete');

/* routes for Toko_Tani Controller */
	Route::get('toko_tani', 'Toko_TaniController@index')->name('toko_tani.index');
	Route::get('toko_tani/index/{filter?}/{filtervalue?}', 'Toko_TaniController@index')->name('toko_tani.index');	
	Route::get('toko_tani/view/{rec_id}', 'Toko_TaniController@view')->name('toko_tani.view');	
	Route::get('toko_tani/add', 'Toko_TaniController@add')->name('toko_tani.add');
	Route::post('toko_tani/add', 'Toko_TaniController@store')->name('toko_tani.store');
		
	Route::any('toko_tani/edit/{rec_id}', 'Toko_TaniController@edit')->name('toko_tani.edit');	
	Route::get('toko_tani/delete/{rec_id}', 'Toko_TaniController@delete');

/* routes for Tpi Controller */
	Route::get('tpi', 'TpiController@index')->name('tpi.index');
	Route::get('tpi/index/{filter?}/{filtervalue?}', 'TpiController@index')->name('tpi.index');	
	Route::get('tpi/view/{rec_id}', 'TpiController@view')->name('tpi.view');	
	Route::get('tpi/add', 'TpiController@add')->name('tpi.add');
	Route::post('tpi/add', 'TpiController@store')->name('tpi.store');
		
	Route::any('tpi/edit/{rec_id}', 'TpiController@edit')->name('tpi.edit');	
	Route::get('tpi/delete/{rec_id}', 'TpiController@delete');

/* routes for Web Controller */
	Route::get('web', 'WebController@index')->name('web.index');
	Route::get('web/index/{filter?}/{filtervalue?}', 'WebController@index')->name('web.index');	
	Route::get('web/view/{rec_id}', 'WebController@view')->name('web.view');	
	Route::get('web/add', 'WebController@add')->name('web.add');
	Route::post('web/add', 'WebController@store')->name('web.store');
		
	Route::any('web/edit/{rec_id}', 'WebController@edit')->name('web.edit');	
	Route::get('web/delete/{rec_id}', 'WebController@delete');

/* routes for Wilayah Controller */
	Route::get('wilayah', 'WilayahController@index')->name('wilayah.index');
	Route::get('wilayah/index/{filter?}/{filtervalue?}', 'WilayahController@index')->name('wilayah.index');	
	Route::get('wilayah/view/{rec_id}', 'WilayahController@view')->name('wilayah.view');	
	Route::get('wilayah/add', 'WilayahController@add')->name('wilayah.add');
	Route::post('wilayah/add', 'WilayahController@store')->name('wilayah.store');
		
	Route::any('wilayah/edit/{rec_id}', 'WilayahController@edit')->name('wilayah.edit');	
	Route::get('wilayah/delete/{rec_id}', 'WilayahController@delete');
});

	
	Route::post('evaluasiadata/input', 'evaluasiadataController@input')->name('evaluasiadata.input')->middleware(['auth']);
	
Route::get('componentsdata/aauth_users_email_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->aauth_users_email_value_exist($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/aauth_users_username_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->aauth_users_username_value_exist($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/user_role_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->user_role_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/id_wilayah_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_wilayah_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/status_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->status_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/category_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->category_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/indikator_master_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->indikator_master_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/id_jenis_ikan_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_jenis_ikan_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/id_jenis_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_jenis_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/id_jenis_hewan_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_jenis_hewan_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/profil_id_jenis_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->profil_id_jenis_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/bidang_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->bidang_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_kiosdaging',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_kiosdaging($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/id_wilayah_option_list_2',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->id_wilayah_option_list_2($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/barchart_newchart3',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->barchart_newchart3($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_peternak',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_peternak($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_totalproduksi',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_totalproduksi($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/barchart_jumlahpeternakberdasarjenis',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->barchart_jumlahpeternakberdasarjenis($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/barchart_jumlahpeternakberdasarkelurahan',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->barchart_jumlahpeternakberdasarkelurahan($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_jumlahdatapoultry',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_jumlahdatapoultry($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/barchart_jumlahperkelurahan',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->barchart_jumlahperkelurahan($request);
	}
)->middleware(['auth']);


Route::post('fileuploader/upload/{fieldname}', 'FileUploaderController@upload');
Route::post('fileuploader/s3upload/{fieldname}', 'FileUploaderController@s3upload');
Route::post('fileuploader/remove_temp_file', 'FileUploaderController@remove_temp_file');


/**
 * All static content routes
 */
Route::get('info/about',  function(){
		return view("pages.info.about");
	}
);
Route::get('info/faq',  function(){
		return view("pages.info.faq");
	}
);

Route::get('info/contact',  function(){
	return view("pages.info.contact");
}
);
Route::get('info/contactsent',  function(){
	return view("pages.info.contactsent");
}
);

Route::post('info/contact',  function(Request $request){
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		]);

		$senderName = $request->name;
		$senderEmail = $request->email;
		$message = $request->message;

		$receiverEmail = config("mail.from.address");

		Mail::send(
			'pages.info.contactemail', [
				'name' => $senderName,
				'email' => $senderEmail,
				'comment' => $message
			],
			function ($mail) use ($senderEmail, $receiverEmail) {
				$mail->from($senderEmail);
				$mail->to($receiverEmail)
					->subject('Contact Form');
			}
		);
		return redirect("info/contactsent");
	}
);


Route::get('info/features',  function(){
		return view("pages.info.features");
	}
);
Route::get('info/privacypolicy',  function(){
		return view("pages.info.privacypolicy");
	}
);
Route::get('info/termsandconditions',  function(){
		return view("pages.info.termsandconditions");
	}
);

Route::get('info/changelocale/{locale}', function ($locale) {
	app()->setlocale($locale);
	session()->put('locale', $locale);
    return redirect()->back();
})->name('info.changelocale');