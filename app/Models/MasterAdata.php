<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class MasterAdata extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'master_adata';
	

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
		'id_adata','bidang','elemen','satuan','is_input'
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
				master_adata.id LIKE ?  OR 
				roles.role_name LIKE ?  OR 
				master_adata.elemen LIKE ?  OR 
				master_adata.satuan LIKE ?  OR 
				roles.role_id LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"master_adata.id AS id",
			"master_adata.id_adata AS id_adata",
			"roles.role_name AS roles_role_name",
			"master_adata.elemen AS elemen",
			"master_adata.satuan AS satuan",
			"roles.role_id AS roles_role_id" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"master_adata.id AS id",
			"master_adata.id_adata AS id_adata",
			"roles.role_name AS roles_role_name",
			"master_adata.elemen AS elemen",
			"master_adata.satuan AS satuan",
			"roles.role_id AS roles_role_id" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"master_adata.id AS id",
			"master_adata.id_adata AS id_adata",
			"master_adata.bidang AS bidang",
			"master_adata.elemen AS elemen",
			"master_adata.satuan AS satuan",
			"master_adata.is_input AS is_input",
			"master_adata.created_at AS created_at",
			"master_adata.updated_at AS updated_at",
			"roles.role_id AS roles_role_id",
			"roles.role_name AS roles_role_name" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"master_adata.id AS id",
			"master_adata.id_adata AS id_adata",
			"master_adata.bidang AS bidang",
			"master_adata.elemen AS elemen",
			"master_adata.satuan AS satuan",
			"master_adata.is_input AS is_input",
			"master_adata.created_at AS created_at",
			"master_adata.updated_at AS updated_at",
			"roles.role_id AS roles_role_id",
			"roles.role_name AS roles_role_name" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id",
			"id_adata",
			"bidang",
			"elemen",
			"satuan",
			"is_input" 
		];
	}
	

	/**
     * return input page fields of the model.
     * 
     * @return array
     */
	public static function inputFields(){
		return [ 
			"master_adata.elemen AS elemen",
			"master_adata.satuan AS satuan",
			"master_adata.is_input AS is_input",
			"master_adata.bidang AS bidang",
			"master_adata.created_at AS created_at",
			"master_adata.updated_at AS updated_at",
			"master_adata.id AS id",
			"evaluasi.id AS evaluasi_id",
			"evaluasi.nilai AS evaluasi_nilai",
			"evaluasi.bukti_dukung AS evaluasi_bukti_dukung",
			"evaluasi.input_by AS evaluasi_input_by"
		];
	}
	

	/**
     * return exportInput page fields of the model.
     * 
     * @return array
     */
	public static function exportInputFields(){
		return [ 
			"master_adata.elemen AS elemen",
			"master_adata.satuan AS satuan",
			"master_adata.is_input AS is_input",
			"master_adata.bidang AS bidang",
			"master_adata.created_at AS created_at",
			"master_adata.updated_at AS updated_at",
			"master_adata.id AS id" 
		];
	}
	

	/**
     * return laporan page fields of the model.
     * 
     * @return array
     */
	public static function laporanFields(){
		return [ 
			"master_adata.id_adata AS id_adata",
			"roles.role_name AS roles_role_name",
			"master_adata.elemen AS elemen",
			"master_adata.satuan AS satuan",
			"master_adata.id AS id",
			"master_adata.is_input AS is_input",
			"roles.role_id AS roles_role_id",
			"evaluasi.id AS evaluasi_id",
			"evaluasi.nilai AS evaluasi_nilai",
			"evaluasi.bukti_dukung AS evaluasi_bukti_dukung",
			"evaluasi.input_by AS evaluasi_input_by"
		];
	}
	

	/**
     * return exportLaporan page fields of the model.
     * 
     * @return array
     */
	public static function exportLaporanFields(){
		return [ 
			"master_adata.id_adata AS id_adata",
			"roles.role_name AS roles_role_name",
			"master_adata.elemen AS elemen",
			"master_adata.satuan AS satuan",
			"master_adata.id AS id",
			"roles.role_id AS roles_role_id" 
		];
	}
}
