<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Kios_Pupuk extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'kios_pupuk';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_kios';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'nama_usaha','nama_pemilik','kapasitas','id_wilayah','rt','rw','legalitas','ket_legalitas','visibility','status','photo','long','lat','penulis','alamat'
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
				kios_pupuk.nama_usaha LIKE ?  OR 
				kios_pupuk.nama_pemilik LIKE ?  OR 
				kios_pupuk.rt LIKE ?  OR 
				kios_pupuk.rw LIKE ?  OR 
				wilayah.kelurahan LIKE ?  OR 
				wilayah.kecamatan LIKE ?  OR 
				aauth_users.username LIKE ?  OR 
				kios_pupuk.kapasitas LIKE ?  OR 
				kios_pupuk.id_map LIKE ?  OR 
				kios_pupuk.ket_legalitas LIKE ?  OR 
				kios_pupuk.long LIKE ?  OR 
				kios_pupuk.lat LIKE ?  OR 
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
				aauth_users.password LIKE ?  OR 
				kios_pupuk.alamat LIKE ? 
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
			"kios_pupuk.id_kios AS id_kios",
			"kios_pupuk.nama_usaha AS nama_usaha",
			"kios_pupuk.nama_pemilik AS nama_pemilik",
			"kios_pupuk.rt AS rt",
			"kios_pupuk.rw AS rw",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"aauth_users.username AS aauth_users_username",
			"wilayah.id_wilayah AS wilayah_id_wilayah",
			"aauth_users.id AS aauth_users_id",
			"kios_pupuk.alamat AS alamat" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"kios_pupuk.id_kios AS id_kios",
			"kios_pupuk.nama_usaha AS nama_usaha",
			"kios_pupuk.nama_pemilik AS nama_pemilik",
			"kios_pupuk.rt AS rt",
			"kios_pupuk.rw AS rw",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"aauth_users.username AS aauth_users_username",
			"wilayah.id_wilayah AS wilayah_id_wilayah",
			"aauth_users.id AS aauth_users_id",
			"kios_pupuk.alamat AS alamat" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"kios_pupuk.id_kios AS id_kios",
			"kios_pupuk.nama_usaha AS nama_usaha",
			"kios_pupuk.nama_pemilik AS nama_pemilik",
			"kios_pupuk.kapasitas AS kapasitas",
			"kios_pupuk.id_wilayah AS id_wilayah",
			"kios_pupuk.rt AS rt",
			"kios_pupuk.rw AS rw",
			"kios_pupuk.id_map AS id_map",
			"kios_pupuk.legalitas AS legalitas",
			"kios_pupuk.ket_legalitas AS ket_legalitas",
			"kios_pupuk.visibility AS visibility",
			"kios_pupuk.status AS status",
			"kios_pupuk.created_at AS created_at",
			"kios_pupuk.photo AS photo",
			"kios_pupuk.long AS long",
			"kios_pupuk.lat AS lat",
			"kios_pupuk.penulis AS penulis",
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
			"aauth_users.otp_date AS aauth_users_otp_date",
			"kios_pupuk.alamat AS alamat" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"kios_pupuk.id_kios AS id_kios",
			"kios_pupuk.nama_usaha AS nama_usaha",
			"kios_pupuk.nama_pemilik AS nama_pemilik",
			"kios_pupuk.kapasitas AS kapasitas",
			"kios_pupuk.id_wilayah AS id_wilayah",
			"kios_pupuk.rt AS rt",
			"kios_pupuk.rw AS rw",
			"kios_pupuk.id_map AS id_map",
			"kios_pupuk.legalitas AS legalitas",
			"kios_pupuk.ket_legalitas AS ket_legalitas",
			"kios_pupuk.visibility AS visibility",
			"kios_pupuk.status AS status",
			"kios_pupuk.created_at AS created_at",
			"kios_pupuk.photo AS photo",
			"kios_pupuk.long AS long",
			"kios_pupuk.lat AS lat",
			"kios_pupuk.penulis AS penulis",
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
			"aauth_users.otp_date AS aauth_users_otp_date",
			"kios_pupuk.alamat AS alamat" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"nama_usaha",
			"nama_pemilik",
			"kapasitas",
			"id_wilayah",
			"rt",
			"rw",
			"legalitas",
			"ket_legalitas",
			"visibility",
			"status",
			"photo",
			"long",
			"lat",
			"penulis",
			"id_kios",
			"alamat" 
		];
	}
}
