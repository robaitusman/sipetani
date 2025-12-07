<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Gudang_Telur extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'gudang_telur';
	

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
		'nama_unit_usaha','nama_pemilik','alamat','rt','rw','kapasitas','keterangan','id_wilayah','legalitas','ket_legalitas','status','visibility','photo','lokasi','long','lat','penulis'
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
				gudang_telur.nama_unit_usaha LIKE ?  OR 
				gudang_telur.nama_pemilik LIKE ?  OR 
				gudang_telur.alamat LIKE ?  OR 
				gudang_telur.rt LIKE ?  OR 
				gudang_telur.rw LIKE ?  OR 
				wilayah.kelurahan LIKE ?  OR 
				wilayah.kecamatan LIKE ?  OR 
				aauth_users.username LIKE ?  OR 
				gudang_telur.kapasitas LIKE ?  OR 
				gudang_telur.keterangan LIKE ?  OR 
				gudang_telur.ket_legalitas LIKE ?  OR 
				gudang_telur.long LIKE ?  OR 
				gudang_telur.lat LIKE ?  OR 
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
			"gudang_telur.id AS id",
			"gudang_telur.nama_unit_usaha AS nama_unit_usaha",
			"gudang_telur.nama_pemilik AS nama_pemilik",
			"gudang_telur.alamat AS alamat",
			"gudang_telur.rt AS rt",
			"gudang_telur.rw AS rw",
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
			"gudang_telur.id AS id",
			"gudang_telur.nama_unit_usaha AS nama_unit_usaha",
			"gudang_telur.nama_pemilik AS nama_pemilik",
			"gudang_telur.alamat AS alamat",
			"gudang_telur.rt AS rt",
			"gudang_telur.rw AS rw",
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
			"gudang_telur.id AS id",
			"gudang_telur.nama_unit_usaha AS nama_unit_usaha",
			"gudang_telur.nama_pemilik AS nama_pemilik",
			"gudang_telur.alamat AS alamat",
			"gudang_telur.rt AS rt",
			"gudang_telur.rw AS rw",
			"gudang_telur.kapasitas AS kapasitas",
			"gudang_telur.keterangan AS keterangan",
			"gudang_telur.id_wilayah AS id_wilayah",
			"gudang_telur.id_map AS id_map",
			"gudang_telur.legalitas AS legalitas",
			"gudang_telur.ket_legalitas AS ket_legalitas",
			"gudang_telur.status AS status",
			"gudang_telur.visibility AS visibility",
			"gudang_telur.created_at AS created_at",
			"gudang_telur.photo AS photo",
			"gudang_telur.lokasi AS lokasi",
			"gudang_telur.long AS long",
			"gudang_telur.lat AS lat",
			"gudang_telur.penulis AS penulis",
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
			"gudang_telur.id AS id",
			"gudang_telur.nama_unit_usaha AS nama_unit_usaha",
			"gudang_telur.nama_pemilik AS nama_pemilik",
			"gudang_telur.alamat AS alamat",
			"gudang_telur.rt AS rt",
			"gudang_telur.rw AS rw",
			"gudang_telur.kapasitas AS kapasitas",
			"gudang_telur.keterangan AS keterangan",
			"gudang_telur.id_wilayah AS id_wilayah",
			"gudang_telur.id_map AS id_map",
			"gudang_telur.legalitas AS legalitas",
			"gudang_telur.ket_legalitas AS ket_legalitas",
			"gudang_telur.status AS status",
			"gudang_telur.visibility AS visibility",
			"gudang_telur.created_at AS created_at",
			"gudang_telur.photo AS photo",
			"gudang_telur.lokasi AS lokasi",
			"gudang_telur.long AS long",
			"gudang_telur.lat AS lat",
			"gudang_telur.penulis AS penulis",
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
			"nama_unit_usaha",
			"nama_pemilik",
			"alamat",
			"rt",
			"rw",
			"kapasitas",
			"keterangan",
			"id_wilayah",
			"legalitas",
			"ket_legalitas",
			"status",
			"visibility",
			"photo",
			"lokasi",
			"long",
			"lat",
			"penulis",
			"id" 
		];
	}
}
