<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class EvaluasiIndikator extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'evaluasi_indikator';
	

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
		'periode_id','indikator_master_id','target','nilai','bukti_dukung','input_by','input_at'
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
				id LIKE ?  OR 
				nilai LIKE ?  OR 
				keterangan LIKE ?  OR 
				bukti_dukung LIKE ?  OR 
				target LIKE ? 
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
			"id",
			"periode_id",
			"indikator_master_id",
			"nilai",
			"keterangan",
			"bukti_dukung",
			"input_by",
			"input_at",
			"created_at",
			"target" 
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
			"periode_id",
			"indikator_master_id",
			"nilai",
			"keterangan",
			"bukti_dukung",
			"input_by",
			"input_at",
			"created_at",
			"target" 
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
			"periode_id",
			"indikator_master_id",
			"nilai",
			"keterangan",
			"bukti_dukung",
			"input_by",
			"input_at",
			"created_at",
			"updated_at",
			"target" 
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
			"periode_id",
			"indikator_master_id",
			"nilai",
			"keterangan",
			"bukti_dukung",
			"input_by",
			"input_at",
			"created_at",
			"updated_at",
			"target" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"periode_id",
			"indikator_master_id",
			"target",
			"nilai",
			"bukti_dukung",
			"input_by",
			"input_at",
			"id" 
		];
	}
}
