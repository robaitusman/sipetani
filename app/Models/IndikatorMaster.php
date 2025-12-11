<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class IndikatorMaster extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'indikator_master';
	

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
		'bidang','sasaran_program','indikator_kinerja','satuan','urutan','is_active'
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
				roles.role_name LIKE ?  OR 
				indikator_master.sasaran_program LIKE ?  OR 
				indikator_master.indikator_kinerja LIKE ?  OR 
				indikator_master.satuan LIKE ?  OR 
				indikator_master.id LIKE ?  OR 
				roles.role_id LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"indikator_master.urutan AS urutan",
			"roles.role_name AS roles_role_name",
			"indikator_master.sasaran_program AS sasaran_program",
			"indikator_master.indikator_kinerja AS indikator_kinerja",
			"indikator_master.satuan AS satuan",
			"indikator_master.is_active AS is_active",
			"indikator_master.id AS id",
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
			"indikator_master.urutan AS urutan",
			"roles.role_name AS roles_role_name",
			"indikator_master.sasaran_program AS sasaran_program",
			"indikator_master.indikator_kinerja AS indikator_kinerja",
			"indikator_master.satuan AS satuan",
			"indikator_master.is_active AS is_active",
			"indikator_master.id AS id",
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
			"indikator_master.id AS id",
			"indikator_master.bidang AS bidang",
			"indikator_master.sasaran_program AS sasaran_program",
			"indikator_master.indikator_kinerja AS indikator_kinerja",
			"indikator_master.satuan AS satuan",
			"indikator_master.urutan AS urutan",
			"indikator_master.is_active AS is_active",
			"indikator_master.created_at AS created_at",
			"indikator_master.updated_at AS updated_at",
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
			"indikator_master.id AS id",
			"indikator_master.bidang AS bidang",
			"indikator_master.sasaran_program AS sasaran_program",
			"indikator_master.indikator_kinerja AS indikator_kinerja",
			"indikator_master.satuan AS satuan",
			"indikator_master.urutan AS urutan",
			"indikator_master.is_active AS is_active",
			"indikator_master.created_at AS created_at",
			"indikator_master.updated_at AS updated_at",
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
			"bidang",
			"sasaran_program",
			"indikator_kinerja",
			"satuan",
			"urutan",
			"is_active",
			"id" 
		];
	}
	

	/**
     * return input page fields of the model.
     * 
     * @return array
     */
	public static function inputFields(){
		return [ 
			"indikator_master.urutan AS urutan",
			"indikator_master.sasaran_program AS sasaran_program",
			"indikator_master.indikator_kinerja AS indikator_kinerja",
			"indikator_master.satuan AS satuan",
			"indikator_master.is_active AS is_active",
			"indikator_master.id AS id",
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
			"indikator_master.urutan AS urutan",
			"indikator_master.sasaran_program AS sasaran_program",
			"indikator_master.indikator_kinerja AS indikator_kinerja",
			"indikator_master.satuan AS satuan",
			"indikator_master.is_active AS is_active",
			"indikator_master.id AS id",
			"evaluasi.id AS evaluasi_id",
			"evaluasi.nilai AS evaluasi_nilai",
			"evaluasi.bukti_dukung AS evaluasi_bukti_dukung",
			"evaluasi.input_by AS evaluasi_input_by"
		];
	}
	

	/**
     * return laporan page fields of the model.
     * 
     * @return array
     */
	public static function laporanFields(){
		return [ 
			"indikator_master.urutan AS urutan",
			"roles.role_name AS roles_role_name",
			"indikator_master.sasaran_program AS sasaran_program",
			"indikator_master.indikator_kinerja AS indikator_kinerja",
			"indikator_master.satuan AS satuan",
			"roles.role_id AS roles_role_id",
			"indikator_master.id AS id",
			"evaluasi.id AS evaluasi_id",
			"evaluasi.target AS evaluasi_target",
			"evaluasi.nilai AS evaluasi_nilai",
			"evaluasi.bukti_dukung AS evaluasi_bukti_dukung",
			"evaluasi.input_by AS evaluasi_input_by",
			"evaluasi.periode_id AS evaluasi_periode_id"
		];
	}
	

	/**
     * return exportLaporan page fields of the model.
     * 
     * @return array
     */
	public static function exportLaporanFields(){
		return [ 
			"indikator_master.urutan AS urutan",
			"roles.role_name AS roles_role_name",
			"indikator_master.sasaran_program AS sasaran_program",
			"indikator_master.indikator_kinerja AS indikator_kinerja",
			"indikator_master.satuan AS satuan",
			"roles.role_id AS roles_role_id",
			"indikator_master.id AS id" 
		];
	}
}
