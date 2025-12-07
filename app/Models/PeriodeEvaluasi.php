<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PeriodeEvaluasi extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'periode_evaluasi';
	

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
		'tahun','nama_periode','deskripsi','tanggal_mulai','tanggal_selesai','created_by','status_periode'
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
				nama_periode LIKE ?  OR 
				deskripsi LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%"
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
			"tahun",
			"nama_periode",
			"deskripsi",
			"tanggal_mulai",
			"tanggal_selesai",
			"status_periode" 
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
			"tahun",
			"nama_periode",
			"deskripsi",
			"tanggal_mulai",
			"tanggal_selesai",
			"status_periode" 
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
			"tahun",
			"nama_periode",
			"deskripsi",
			"tanggal_mulai",
			"tanggal_selesai",
			"created_by",
			"created_at",
			"updated_at",
			"status_periode" 
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
			"tahun",
			"nama_periode",
			"deskripsi",
			"tanggal_mulai",
			"tanggal_selesai",
			"created_by",
			"created_at",
			"updated_at",
			"status_periode" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"tahun",
			"nama_periode",
			"deskripsi",
			"tanggal_mulai",
			"tanggal_selesai",
			"created_by",
			"status_periode",
			"id" 
		];
	}
	

	/**
     * return evaluasi page fields of the model.
     * 
     * @return array
     */
	public static function evaluasiFields(){
		return [ 
			"id",
			"tahun",
			"nama_periode",
			"tanggal_mulai",
			"tanggal_selesai",
			"status_periode",
			"created_by" 
		];
	}
	

	/**
     * return exportEvaluasi page fields of the model.
     * 
     * @return array
     */
	public static function exportEvaluasiFields(){
		return [ 
			"id",
			"tahun",
			"nama_periode",
			"tanggal_mulai",
			"tanggal_selesai",
			"status_periode",
			"created_by" 
		];
	}
}
