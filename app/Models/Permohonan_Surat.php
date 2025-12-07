<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Permohonan_Surat extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'permohonan_surat';
	

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
		'id_jenis','tgl_pengesahan','tgl_permohonan','nik','nama','alamat','id_wilayah','status_surat','id_user','kelengkapan_dokumen'
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
				nik LIKE ?  OR 
				nama LIKE ?  OR 
				alamat LIKE ?  OR 
				kelengkapan_dokumen LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%"
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
			"id",
			"id_jenis",
			"tgl_pengesahan",
			"tgl_permohonan",
			"nik",
			"nama",
			"alamat",
			"id_wilayah",
			"status_surat",
			"id_user",
			"kelengkapan_dokumen" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id",
			"id_jenis",
			"tgl_pengesahan",
			"tgl_permohonan",
			"nik",
			"nama",
			"alamat",
			"id_wilayah",
			"status_surat",
			"id_user",
			"kelengkapan_dokumen" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id",
			"id_jenis",
			"tgl_pengesahan",
			"tgl_permohonan",
			"nik",
			"nama",
			"alamat",
			"id_wilayah",
			"status_surat",
			"id_user",
			"kelengkapan_dokumen" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id",
			"id_jenis",
			"tgl_pengesahan",
			"tgl_permohonan",
			"nik",
			"nama",
			"alamat",
			"id_wilayah",
			"status_surat",
			"id_user",
			"kelengkapan_dokumen" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id_jenis",
			"tgl_pengesahan",
			"tgl_permohonan",
			"nik",
			"nama",
			"alamat",
			"id_wilayah",
			"status_surat",
			"id_user",
			"kelengkapan_dokumen",
			"id" 
		];
	}
}
