<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Web extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'web';
	

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
		'body'
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
				body LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%"
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
			"body" 
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
			"body" 
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
			"body" 
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
			"body" 
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
			"body" 
		];
	}
	

	/**
     * return peternakan page fields of the model.
     * 
     * @return array
     */
	public static function peternakanFields(){
		return [ 
			"id",
			"body" 
		];
	}
	

	/**
     * return exportPeternakan page fields of the model.
     * 
     * @return array
     */
	public static function exportPeternakanFields(){
		return [ 
			"id",
			"body" 
		];
	}
	

	/**
     * return pertanian page fields of the model.
     * 
     * @return array
     */
	public static function pertanianFields(){
		return [ 
			"id",
			"body" 
		];
	}
	

	/**
     * return exportPertanian page fields of the model.
     * 
     * @return array
     */
	public static function exportPertanianFields(){
		return [ 
			"id",
			"body" 
		];
	}
	

	/**
     * return perikanan page fields of the model.
     * 
     * @return array
     */
	public static function perikananFields(){
		return [ 
			"id",
			"body" 
		];
	}
	

	/**
     * return exportPerikanan page fields of the model.
     * 
     * @return array
     */
	public static function exportPerikananFields(){
		return [ 
			"id",
			"body" 
		];
	}
	

	/**
     * return ketahananpangan page fields of the model.
     * 
     * @return array
     */
	public static function ketahananpanganFields(){
		return [ 
			"id",
			"body" 
		];
	}
	

	/**
     * return exportKetahananpangan page fields of the model.
     * 
     * @return array
     */
	public static function exportKetahananpanganFields(){
		return [ 
			"id",
			"body" 
		];
	}
}
