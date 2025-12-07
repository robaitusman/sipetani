<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Peternak extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'peternak';
	

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
		'nik','nama','alamat','rt','rw','long','lat','photo','id_jenis_hewan','jumlah_populasi','produksi','id_wilayah','penulis'
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
				peternak.nik LIKE ?  OR 
				peternak.nama LIKE ?  OR 
				peternak.alamat LIKE ?  OR 
				peternak.rt LIKE ?  OR 
				peternak.rw LIKE ?  OR 
				wilayah.kelurahan LIKE ?  OR 
				wilayah.kecamatan LIKE ?  OR 
				aauth_users.username LIKE ?  OR 
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
				peternak.long LIKE ?  OR 
				peternak.lat LIKE ?  OR 
				aauth_users.password LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"peternak.id AS id",
			"peternak.nik AS nik",
			"peternak.nama AS nama",
			"peternak.alamat AS alamat",
			"peternak.rt AS rt",
			"peternak.rw AS rw",
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
			"peternak.id AS id",
			"peternak.nik AS nik",
			"peternak.nama AS nama",
			"peternak.alamat AS alamat",
			"peternak.rt AS rt",
			"peternak.rw AS rw",
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
			"peternak.nama AS nama",
			"peternak.alamat AS alamat",
			"peternak.rt AS rt",
			"peternak.rw AS rw",
			"peternak.lokasi AS lokasi",
			"peternak.long AS long",
			"peternak.lat AS lat",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"aauth_users.username AS aauth_users_username",
			"peternak.nik AS nik",
			"peternak.id_wilayah AS id_wilayah",
			"peternak.produksi AS produksi",
			"peternak.photo AS photo",
			"peternak.id AS id",
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
			"peternak.nama AS nama",
			"peternak.alamat AS alamat",
			"peternak.rt AS rt",
			"peternak.rw AS rw",
			"peternak.lokasi AS lokasi",
			"peternak.long AS long",
			"peternak.lat AS lat",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"aauth_users.username AS aauth_users_username",
			"peternak.nik AS nik",
			"peternak.id_wilayah AS id_wilayah",
			"peternak.produksi AS produksi",
			"peternak.photo AS photo",
			"peternak.id AS id",
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
			"nik",
			"nama",
			"alamat",
			"rt",
			"rw",
			"long",
			"lat",
			"photo",
			"id_jenis_hewan",
			"jumlah_populasi",
			"produksi",
			"id_wilayah",
			"penulis",
			"id" 
		];
	}
	

	/**
     * return depan page fields of the model.
     * 
     * @return array
     */
	public static function depanFields(){
		return [ 
			"peternak.nama AS nama",
			"peternak.alamat AS alamat",
			"peternak.produksi AS produksi",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"jenis_hewan.nama_jenis AS jenis_hewan_nama_jenis",
			"peternak.long AS long",
			"peternak.lat AS lat",
			"wilayah.id_wilayah AS wilayah_id_wilayah",
			"jenis_hewan.id_jenis_hewan AS jenis_hewan_id_jenis_hewan",
			"peternak.id AS id" 
		];
	}
	

	/**
     * return exportDepan page fields of the model.
     * 
     * @return array
     */
	public static function exportDepanFields(){
		return [ 
			"peternak.nama AS nama",
			"peternak.alamat AS alamat",
			"peternak.produksi AS produksi",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"jenis_hewan.nama_jenis AS jenis_hewan_nama_jenis",
			"peternak.long AS long",
			"peternak.lat AS lat",
			"wilayah.id_wilayah AS wilayah_id_wilayah",
			"jenis_hewan.id_jenis_hewan AS jenis_hewan_id_jenis_hewan",
			"peternak.id AS id" 
		];
	}
	

	/**
     * return peta page fields of the model.
     * 
     * @return array
     */
	public static function petaFields(){
		return [ 
			"peternak.nama AS nama",
			"peternak.alamat AS alamat",
			"peternak.produksi AS produksi",
			"jenis_hewan.nama_jenis AS jenis_hewan_nama_jenis",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"peternak.long AS long",
			"peternak.lat AS lat",
			"peternak.id AS id",
			"jenis_hewan.id_jenis_hewan AS jenis_hewan_id_jenis_hewan",
			"wilayah.id_wilayah AS wilayah_id_wilayah" 
		];
	}
	

	/**
     * return exportPeta page fields of the model.
     * 
     * @return array
     */
	public static function exportPetaFields(){
		return [ 
			"peternak.nama AS nama",
			"peternak.alamat AS alamat",
			"peternak.produksi AS produksi",
			"jenis_hewan.nama_jenis AS jenis_hewan_nama_jenis",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"peternak.long AS long",
			"peternak.lat AS lat",
			"peternak.id AS id",
			"jenis_hewan.id_jenis_hewan AS jenis_hewan_id_jenis_hewan",
			"wilayah.id_wilayah AS wilayah_id_wilayah" 
		];
	}
}
