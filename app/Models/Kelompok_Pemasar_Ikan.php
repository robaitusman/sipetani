<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Kelompok_Pemasar_Ikan extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'kelompok_pemasar_ikan';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'nama','nama_ketua','jumlah_anggota','kapasitas','id_jenis_ikan','alamat','id_wilayah','rt','rw','legalitas','ket_legalitas','visibility','status','photo','lokasi','long','lat','penulis'
	];
	public $timestamps = false;
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				kelompok_pemasar_ikan.nama LIKE ?  OR 
				kelompok_pemasar_ikan.nama_ketua LIKE ?  OR 
				kelompok_pemasar_ikan.alamat LIKE ?  OR 
				kelompok_pemasar_ikan.rt LIKE ?  OR 
				kelompok_pemasar_ikan.rw LIKE ?  OR 
				kelompok_pemasar_ikan.lokasi LIKE ?  OR 
				wilayah.kelurahan LIKE ?  OR 
				wilayah.kecamatan LIKE ?  OR 
				aauth_users.username LIKE ?  OR 
				kelompok_pemasar_ikan.kapasitas LIKE ?  OR 
				kelompok_pemasar_ikan.ket_legalitas LIKE ?  OR 
				kelompok_pemasar_ikan.long LIKE ?  OR 
				kelompok_pemasar_ikan.lat LIKE ?  OR 
				aauth_users.email LIKE ?  OR 
				aauth_users.oauth_uid LIKE ?  OR 
				aauth_users.oauth_provider LIKE ?  OR 
				aauth_users.full_name LIKE ?  OR 
				aauth_users.avatar LIKE ?  OR 
				aauth_users.forgot_exp LIKE ?  OR 
				aauth_users.remember_exp LIKE ?  OR 
				aauth_users.verification_code LIKE ?  OR 
				aauth_users.top_secret LIKE ?  OR 
				aauth_users.ip_address LIKE ?  OR 
				aauth_users.no_hp LIKE ?  OR 
				aauth_users.otp_code LIKE ?  OR 
				aauth_users.password LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"kelompok_pemasar_ikan.id AS id",
			"kelompok_pemasar_ikan.nama AS nama",
			"kelompok_pemasar_ikan.nama_ketua AS nama_ketua",
			"kelompok_pemasar_ikan.alamat AS alamat",
			"kelompok_pemasar_ikan.rt AS rt",
			"kelompok_pemasar_ikan.rw AS rw",
			"kelompok_pemasar_ikan.lokasi AS lokasi",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"aauth_users.username AS aauth_users_username",
			"wilayah.id_wilayah AS wilayah_id_wilayah",
			"aauth_users.id AS aauth_users_id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"kelompok_pemasar_ikan.id AS id",
			"kelompok_pemasar_ikan.nama AS nama",
			"kelompok_pemasar_ikan.nama_ketua AS nama_ketua",
			"kelompok_pemasar_ikan.alamat AS alamat",
			"kelompok_pemasar_ikan.rt AS rt",
			"kelompok_pemasar_ikan.rw AS rw",
			"kelompok_pemasar_ikan.lokasi AS lokasi",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"aauth_users.username AS aauth_users_username",
			"wilayah.id_wilayah AS wilayah_id_wilayah",
			"aauth_users.id AS aauth_users_id" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"kelompok_pemasar_ikan.id AS id",
			"kelompok_pemasar_ikan.nama AS nama",
			"kelompok_pemasar_ikan.nama_ketua AS nama_ketua",
			"kelompok_pemasar_ikan.jumlah_anggota AS jumlah_anggota",
			"kelompok_pemasar_ikan.kapasitas AS kapasitas",
			"kelompok_pemasar_ikan.id_jenis_ikan AS id_jenis_ikan",
			"kelompok_pemasar_ikan.alamat AS alamat",
			"kelompok_pemasar_ikan.id_wilayah AS id_wilayah",
			"kelompok_pemasar_ikan.rt AS rt",
			"kelompok_pemasar_ikan.rw AS rw",
			"kelompok_pemasar_ikan.id_map AS id_map",
			"kelompok_pemasar_ikan.legalitas AS legalitas",
			"kelompok_pemasar_ikan.ket_legalitas AS ket_legalitas",
			"kelompok_pemasar_ikan.visibility AS visibility",
			"kelompok_pemasar_ikan.status AS status",
			"kelompok_pemasar_ikan.created_at AS created_at",
			"kelompok_pemasar_ikan.photo AS photo",
			"kelompok_pemasar_ikan.lokasi AS lokasi",
			"kelompok_pemasar_ikan.long AS long",
			"kelompok_pemasar_ikan.lat AS lat",
			"kelompok_pemasar_ikan.penulis AS penulis",
			"wilayah.id_wilayah AS wilayah_id_wilayah",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"aauth_users.id AS aauth_users_id",
			"aauth_users.email AS aauth_users_email",
			"aauth_users.oauth_uid AS aauth_users_oauth_uid",
			"aauth_users.oauth_provider AS aauth_users_oauth_provider",
			"aauth_users.username AS aauth_users_username",
			"aauth_users.full_name AS aauth_users_full_name",
			"aauth_users.avatar AS aauth_users_avatar",
			"aauth_users.banned AS aauth_users_banned",
			"aauth_users.last_login AS aauth_users_last_login",
			"aauth_users.last_activity AS aauth_users_last_activity",
			"aauth_users.date_created AS aauth_users_date_created",
			"aauth_users.forgot_exp AS aauth_users_forgot_exp",
			"aauth_users.remember_time AS aauth_users_remember_time",
			"aauth_users.remember_exp AS aauth_users_remember_exp",
			"aauth_users.verification_code AS aauth_users_verification_code",
			"aauth_users.top_secret AS aauth_users_top_secret",
			"aauth_users.ip_address AS aauth_users_ip_address",
			"aauth_users.user_role_id AS aauth_users_user_role_id",
			"aauth_users.No Hp AS aauth_users_no_hp",
			"aauth_users.otp_code AS aauth_users_otp_code",
			"aauth_users.otp_date AS aauth_users_otp_date" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"kelompok_pemasar_ikan.id AS id",
			"kelompok_pemasar_ikan.nama AS nama",
			"kelompok_pemasar_ikan.nama_ketua AS nama_ketua",
			"kelompok_pemasar_ikan.jumlah_anggota AS jumlah_anggota",
			"kelompok_pemasar_ikan.kapasitas AS kapasitas",
			"kelompok_pemasar_ikan.id_jenis_ikan AS id_jenis_ikan",
			"kelompok_pemasar_ikan.alamat AS alamat",
			"kelompok_pemasar_ikan.id_wilayah AS id_wilayah",
			"kelompok_pemasar_ikan.rt AS rt",
			"kelompok_pemasar_ikan.rw AS rw",
			"kelompok_pemasar_ikan.id_map AS id_map",
			"kelompok_pemasar_ikan.legalitas AS legalitas",
			"kelompok_pemasar_ikan.ket_legalitas AS ket_legalitas",
			"kelompok_pemasar_ikan.visibility AS visibility",
			"kelompok_pemasar_ikan.status AS status",
			"kelompok_pemasar_ikan.created_at AS created_at",
			"kelompok_pemasar_ikan.photo AS photo",
			"kelompok_pemasar_ikan.lokasi AS lokasi",
			"kelompok_pemasar_ikan.long AS long",
			"kelompok_pemasar_ikan.lat AS lat",
			"kelompok_pemasar_ikan.penulis AS penulis",
			"wilayah.id_wilayah AS wilayah_id_wilayah",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"aauth_users.id AS aauth_users_id",
			"aauth_users.email AS aauth_users_email",
			"aauth_users.oauth_uid AS aauth_users_oauth_uid",
			"aauth_users.oauth_provider AS aauth_users_oauth_provider",
			"aauth_users.username AS aauth_users_username",
			"aauth_users.full_name AS aauth_users_full_name",
			"aauth_users.avatar AS aauth_users_avatar",
			"aauth_users.banned AS aauth_users_banned",
			"aauth_users.last_login AS aauth_users_last_login",
			"aauth_users.last_activity AS aauth_users_last_activity",
			"aauth_users.date_created AS aauth_users_date_created",
			"aauth_users.forgot_exp AS aauth_users_forgot_exp",
			"aauth_users.remember_time AS aauth_users_remember_time",
			"aauth_users.remember_exp AS aauth_users_remember_exp",
			"aauth_users.verification_code AS aauth_users_verification_code",
			"aauth_users.top_secret AS aauth_users_top_secret",
			"aauth_users.ip_address AS aauth_users_ip_address",
			"aauth_users.user_role_id AS aauth_users_user_role_id",
			"aauth_users.No Hp AS aauth_users_no_hp",
			"aauth_users.otp_code AS aauth_users_otp_code",
			"aauth_users.otp_date AS aauth_users_otp_date" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"nama",
			"nama_ketua",
			"jumlah_anggota",
			"kapasitas",
			"id_jenis_ikan",
			"alamat",
			"id_wilayah",
			"rt",
			"rw",
			"legalitas",
			"ket_legalitas",
			"visibility",
			"status",
			"photo",
			"lokasi",
			"long",
			"lat",
			"penulis",
			"id" 
		];
	}
}
