<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Konsul extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'konsul';
	

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
		'nama_lengkap','id_user','pertanyaan','jawaban','id_jenis','status','is_publish'
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
				nama_lengkap LIKE ?  OR 
				pertanyaan LIKE ?  OR 
				jawaban LIKE ? 
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
			"nama_lengkap",
			"id_user",
			"pertanyaan",
			"jawaban",
			"id_jenis",
			"status",
			"is_publish" 
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
			"nama_lengkap",
			"id_user",
			"pertanyaan",
			"jawaban",
			"id_jenis",
			"status",
			"is_publish" 
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
			"nama_lengkap",
			"id_user",
			"pertanyaan",
			"jawaban",
			"id_jenis",
			"status",
			"is_publish" 
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
			"nama_lengkap",
			"id_user",
			"pertanyaan",
			"jawaban",
			"id_jenis",
			"status",
			"is_publish" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"nama_lengkap",
			"id_user",
			"pertanyaan",
			"jawaban",
			"id_jenis",
			"status",
			"is_publish",
			"id" 
		];
	}
}
