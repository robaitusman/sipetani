<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Kios_Daging extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'kios_daging';
	

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
		'nama_usaha','nama_pemilik','kapasitas','alamat','id_wilayah','rt','rw','kontak','legalitas','ket_legalitas','visibility','status','photo','long','lat','penulis'
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
				kios_daging.nama_usaha LIKE ?  OR 
				kios_daging.nama_pemilik LIKE ?  OR 
				kios_daging.alamat LIKE ?  OR 
				kios_daging.rt LIKE ?  OR 
				kios_daging.rw LIKE ?  OR 
				kios_daging.lokasi LIKE ?  OR 
				wilayah.kelurahan LIKE ?  OR 
				wilayah.kecamatan LIKE ?  OR 
				aauth_users.username LIKE ?  OR 
				kios_daging.long LIKE ?  OR 
				kios_daging.lat LIKE ?  OR 
				kios_daging.kontak LIKE ?  OR 
				kios_daging.ket_legalitas LIKE ?  OR 
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
			"kios_daging.id_kios AS id_kios",
			"kios_daging.nama_usaha AS nama_usaha",
			"kios_daging.nama_pemilik AS nama_pemilik",
			"kios_daging.alamat AS alamat",
			"kios_daging.rt AS rt",
			"kios_daging.rw AS rw",
			"kios_daging.lokasi AS lokasi",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"aauth_users.username AS aauth_users_username",
			"aauth_users.id AS aauth_users_id",
			"wilayah.id_wilayah AS wilayah_id_wilayah" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"kios_daging.id_kios AS id_kios",
			"kios_daging.nama_usaha AS nama_usaha",
			"kios_daging.nama_pemilik AS nama_pemilik",
			"kios_daging.alamat AS alamat",
			"kios_daging.rt AS rt",
			"kios_daging.rw AS rw",
			"kios_daging.lokasi AS lokasi",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"aauth_users.username AS aauth_users_username",
			"aauth_users.id AS aauth_users_id",
			"wilayah.id_wilayah AS wilayah_id_wilayah" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"kios_daging.id_kios AS id_kios",
			"kios_daging.nama_usaha AS nama_usaha",
			"kios_daging.nama_pemilik AS nama_pemilik",
			"kios_daging.kapasitas AS kapasitas",
			"kios_daging.alamat AS alamat",
			"kios_daging.rt AS rt",
			"kios_daging.rw AS rw",
			"kios_daging.kontak AS kontak",
			"kios_daging.legalitas AS legalitas",
			"kios_daging.ket_legalitas AS ket_legalitas",
			"kios_daging.photo AS photo",
			"kios_daging.long AS long",
			"kios_daging.lat AS lat",
			"kios_daging.penulis AS penulis",
			"wilayah.id_wilayah AS wilayah_id_wilayah",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"aauth_users.id AS aauth_users_id",
			"aauth_users.username AS aauth_users_username" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"kios_daging.id_kios AS id_kios",
			"kios_daging.nama_usaha AS nama_usaha",
			"kios_daging.nama_pemilik AS nama_pemilik",
			"kios_daging.kapasitas AS kapasitas",
			"kios_daging.alamat AS alamat",
			"kios_daging.rt AS rt",
			"kios_daging.rw AS rw",
			"kios_daging.kontak AS kontak",
			"kios_daging.legalitas AS legalitas",
			"kios_daging.ket_legalitas AS ket_legalitas",
			"kios_daging.photo AS photo",
			"kios_daging.long AS long",
			"kios_daging.lat AS lat",
			"kios_daging.penulis AS penulis",
			"wilayah.id_wilayah AS wilayah_id_wilayah",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"aauth_users.id AS aauth_users_id",
			"aauth_users.username AS aauth_users_username" 
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
			"alamat",
			"id_wilayah",
			"rt",
			"rw",
			"kontak",
			"legalitas",
			"ket_legalitas",
			"visibility",
			"status",
			"photo",
			"long",
			"lat",
			"penulis",
			"id_kios" 
		];
	}
	

	/**
     * return depan page fields of the model.
     * 
     * @return array
     */
	public static function depanFields(){
		return [ 
			"kios_daging.nama_usaha AS nama_usaha",
			"kios_daging.nama_pemilik AS nama_pemilik",
			"kios_daging.alamat AS alamat",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"kios_daging.id_kios AS id_kios",
			"kios_daging.long AS long",
			"kios_daging.lat AS lat",
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
			"kios_daging.nama_usaha AS nama_usaha",
			"kios_daging.nama_pemilik AS nama_pemilik",
			"kios_daging.alamat AS alamat",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
			"kios_daging.id_kios AS id_kios",
			"kios_daging.long AS long",
			"kios_daging.lat AS lat",
			"wilayah.id_wilayah AS wilayah_id_wilayah" 
		];
	}
	

	/**
     * return peta page fields of the model.
     * 
     * @return array
     */
	public static function petaFields(){
		return [ 
			"id_kios",
			"nama_usaha",
			"nama_pemilik",
			"kapasitas",
			"alamat",
			"id_wilayah",
			"rt",
			"rw",
			"kontak",
			"id_map",
			"legalitas",
			"ket_legalitas",
			"visibility",
			"status",
			"created_at",
			"photo",
			"lokasi",
			"long",
			"lat",
			"penulis" 
		];
	}
	

	/**
     * return exportPeta page fields of the model.
     * 
     * @return array
     */
	public static function exportPetaFields(){
		return [ 
			"id_kios",
			"nama_usaha",
			"nama_pemilik",
			"kapasitas",
			"alamat",
			"id_wilayah",
			"rt",
			"rw",
			"kontak",
			"id_map",
			"legalitas",
			"ket_legalitas",
			"visibility",
			"status",
			"created_at",
			"photo",
			"lokasi",
			"long",
			"lat",
			"penulis" 
		];
	}
}
