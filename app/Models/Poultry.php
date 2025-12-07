<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Poultry extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'poultry';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_poultry';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'nama','nama_pemilik','no_hp_pemilik','nama_penanggung_jawab','no_hp_penanggung_jawab','nama_sdm','no_hp_sdm','kapasitas','alamat','id_wilayah','rt','rw','legalitas','ket_legalitas','visibility','status','photo','long','lat','penulis'
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
				poultry.nama LIKE ?  OR 
				poultry.alamat LIKE ?  OR 
				poultry.rt LIKE ?  OR 
				poultry.rw LIKE ?  OR 
				wilayah.kelurahan LIKE ?  OR 
				wilayah.kecamatan LIKE ?  OR 
				aauth_users.username LIKE ?  OR 
				poultry.long LIKE ?  OR 
				poultry.lat LIKE ?  OR 
				poultry.nama_pemilik LIKE ?  OR 
				poultry.no_hp_pemilik LIKE ?  OR 
				poultry.nama_penanggung_jawab LIKE ?  OR 
				poultry.no_hp_penanggung_jawab LIKE ?  OR 
				poultry.nama_sdm LIKE ?  OR 
				poultry.no_hp_sdm LIKE ?  OR 
				poultry.kapasitas LIKE ?  OR 
				poultry.jenis_map LIKE ?  OR 
				poultry.ket_legalitas LIKE ?  OR 
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
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"poultry.id_poultry AS id_poultry",
			"poultry.nama AS nama",
			"poultry.alamat AS alamat",
			"poultry.rt AS rt",
			"poultry.rw AS rw",
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
			"poultry.id_poultry AS id_poultry",
			"poultry.nama AS nama",
			"poultry.alamat AS alamat",
			"poultry.rt AS rt",
			"poultry.rw AS rw",
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
			"poultry.nama AS nama",
			"poultry.nama_pemilik AS nama_pemilik",
			"poultry.no_hp_pemilik AS no_hp_pemilik",
			"poultry.nama_penanggung_jawab AS nama_penanggung_jawab",
			"poultry.nama_sdm AS nama_sdm",
			"poultry.kapasitas AS kapasitas",
			"poultry.rt AS rt",
			"poultry.rw AS rw",
			"poultry.long AS long",
			"poultry.lat AS lat",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"poultry.id_poultry AS id_poultry",
			"poultry.alamat AS alamat",
			"wilayah.id_wilayah AS wilayah_id_wilayah",
			"aauth_users.id AS aauth_users_id" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"poultry.nama AS nama",
			"poultry.nama_pemilik AS nama_pemilik",
			"poultry.no_hp_pemilik AS no_hp_pemilik",
			"poultry.nama_penanggung_jawab AS nama_penanggung_jawab",
			"poultry.nama_sdm AS nama_sdm",
			"poultry.kapasitas AS kapasitas",
			"poultry.rt AS rt",
			"poultry.rw AS rw",
			"poultry.long AS long",
			"poultry.lat AS lat",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"poultry.id_poultry AS id_poultry",
			"poultry.alamat AS alamat",
			"wilayah.id_wilayah AS wilayah_id_wilayah",
			"aauth_users.id AS aauth_users_id" 
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
			"nama_pemilik",
			"no_hp_pemilik",
			"nama_penanggung_jawab",
			"no_hp_penanggung_jawab",
			"nama_sdm",
			"no_hp_sdm",
			"kapasitas",
			"alamat",
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
			"id_poultry" 
		];
	}
	

	/**
     * return depan page fields of the model.
     * 
     * @return array
     */
	public static function depanFields(){
		return [ 
			"poultry.nama AS nama",
			"poultry.nama_pemilik AS nama_pemilik",
			"poultry.kapasitas AS kapasitas",
			"poultry.alamat AS alamat",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"poultry.id_poultry AS id_poultry",
			"poultry.long AS long",
			"poultry.lat AS lat",
			"wilayah.id_wilayah AS wilayah_id_wilayah" 
		];
	}
	

	/**
     * return exportDepan page fields of the model.
     * 
     * @return array
     */
	public static function exportDepanFields(){
		return [ 
			"poultry.nama AS nama",
			"poultry.nama_pemilik AS nama_pemilik",
			"poultry.kapasitas AS kapasitas",
			"poultry.alamat AS alamat",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"poultry.id_poultry AS id_poultry",
			"poultry.long AS long",
			"poultry.lat AS lat",
			"wilayah.id_wilayah AS wilayah_id_wilayah" 
		];
	}
}
