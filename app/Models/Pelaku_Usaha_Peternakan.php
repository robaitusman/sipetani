<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Pelaku_Usaha_Peternakan extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'pelaku_usaha_peternakan';
	

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
		'nama_usaha','nama_pemilik','lokasi','rt','rw','id_wilayah','legalitas','status_kelompok','legalitas_produksi','jenis_olahan','komoditas','satuan','jml_produksi','omzet','sumber_bahan_baku','metode_penjualan','visibility','status','photo','long','lat','penulis'
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
				pelaku_usaha_peternakan.nama_usaha LIKE ?  OR 
				pelaku_usaha_peternakan.nama_pemilik LIKE ?  OR 
				pelaku_usaha_peternakan.lokasi LIKE ?  OR 
				pelaku_usaha_peternakan.rt LIKE ?  OR 
				pelaku_usaha_peternakan.rw LIKE ?  OR 
				wilayah.kelurahan LIKE ?  OR 
				wilayah.kecamatan LIKE ?  OR 
				aauth_users.username LIKE ?  OR 
				pelaku_usaha_peternakan.alamat LIKE ?  OR 
				pelaku_usaha_peternakan.legalitas LIKE ?  OR 
				pelaku_usaha_peternakan.status_kelompok LIKE ?  OR 
				pelaku_usaha_peternakan.legalitas_produksi LIKE ?  OR 
				pelaku_usaha_peternakan.jenis_olahan LIKE ?  OR 
				pelaku_usaha_peternakan.komoditas LIKE ?  OR 
				pelaku_usaha_peternakan.satuan LIKE ?  OR 
				pelaku_usaha_peternakan.sumber_bahan_baku LIKE ?  OR 
				pelaku_usaha_peternakan.metode_penjualan LIKE ?  OR 
				pelaku_usaha_peternakan.long LIKE ?  OR 
				pelaku_usaha_peternakan.lat LIKE ?  OR 
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
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"pelaku_usaha_peternakan.id AS id",
			"pelaku_usaha_peternakan.nama_usaha AS nama_usaha",
			"pelaku_usaha_peternakan.nama_pemilik AS nama_pemilik",
			"pelaku_usaha_peternakan.lokasi AS lokasi",
			"pelaku_usaha_peternakan.rt AS rt",
			"pelaku_usaha_peternakan.rw AS rw",
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
			"pelaku_usaha_peternakan.id AS id",
			"pelaku_usaha_peternakan.nama_usaha AS nama_usaha",
			"pelaku_usaha_peternakan.nama_pemilik AS nama_pemilik",
			"pelaku_usaha_peternakan.lokasi AS lokasi",
			"pelaku_usaha_peternakan.rt AS rt",
			"pelaku_usaha_peternakan.rw AS rw",
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
			"pelaku_usaha_peternakan.id AS id",
			"pelaku_usaha_peternakan.nama_usaha AS nama_usaha",
			"pelaku_usaha_peternakan.nama_pemilik AS nama_pemilik",
			"pelaku_usaha_peternakan.alamat AS alamat",
			"pelaku_usaha_peternakan.rt AS rt",
			"pelaku_usaha_peternakan.rw AS rw",
			"pelaku_usaha_peternakan.legalitas AS legalitas",
			"pelaku_usaha_peternakan.status_kelompok AS status_kelompok",
			"pelaku_usaha_peternakan.legalitas_produksi AS legalitas_produksi",
			"pelaku_usaha_peternakan.jenis_olahan AS jenis_olahan",
			"pelaku_usaha_peternakan.komoditas AS komoditas",
			"pelaku_usaha_peternakan.satuan AS satuan",
			"pelaku_usaha_peternakan.jml_produksi AS jml_produksi",
			"pelaku_usaha_peternakan.omzet AS omzet",
			"pelaku_usaha_peternakan.sumber_bahan_baku AS sumber_bahan_baku",
			"pelaku_usaha_peternakan.metode_penjualan AS metode_penjualan",
			"pelaku_usaha_peternakan.id_map AS id_map",
			"pelaku_usaha_peternakan.created_at AS created_at",
			"pelaku_usaha_peternakan.photo AS photo",
			"pelaku_usaha_peternakan.lokasi AS lokasi",
			"pelaku_usaha_peternakan.long AS long",
			"pelaku_usaha_peternakan.lat AS lat",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
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
			"pelaku_usaha_peternakan.id AS id",
			"pelaku_usaha_peternakan.nama_usaha AS nama_usaha",
			"pelaku_usaha_peternakan.nama_pemilik AS nama_pemilik",
			"pelaku_usaha_peternakan.alamat AS alamat",
			"pelaku_usaha_peternakan.rt AS rt",
			"pelaku_usaha_peternakan.rw AS rw",
			"pelaku_usaha_peternakan.legalitas AS legalitas",
			"pelaku_usaha_peternakan.status_kelompok AS status_kelompok",
			"pelaku_usaha_peternakan.legalitas_produksi AS legalitas_produksi",
			"pelaku_usaha_peternakan.jenis_olahan AS jenis_olahan",
			"pelaku_usaha_peternakan.komoditas AS komoditas",
			"pelaku_usaha_peternakan.satuan AS satuan",
			"pelaku_usaha_peternakan.jml_produksi AS jml_produksi",
			"pelaku_usaha_peternakan.omzet AS omzet",
			"pelaku_usaha_peternakan.sumber_bahan_baku AS sumber_bahan_baku",
			"pelaku_usaha_peternakan.metode_penjualan AS metode_penjualan",
			"pelaku_usaha_peternakan.id_map AS id_map",
			"pelaku_usaha_peternakan.created_at AS created_at",
			"pelaku_usaha_peternakan.photo AS photo",
			"pelaku_usaha_peternakan.lokasi AS lokasi",
			"pelaku_usaha_peternakan.long AS long",
			"pelaku_usaha_peternakan.lat AS lat",
			"wilayah.kelurahan AS wilayah_kelurahan",
			"wilayah.kecamatan AS wilayah_kecamatan",
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
			"nama_usaha",
			"nama_pemilik",
			"lokasi",
			"rt",
			"rw",
			"id_wilayah",
			"legalitas",
			"status_kelompok",
			"legalitas_produksi",
			"jenis_olahan",
			"komoditas",
			"satuan",
			"jml_produksi",
			"omzet",
			"sumber_bahan_baku",
			"metode_penjualan",
			"visibility",
			"status",
			"photo",
			"long",
			"lat",
			"penulis",
			"id" 
		];
	}
}
