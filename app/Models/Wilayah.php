<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Wilayah extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'wilayah';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_wilayah';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'kelurahan','kecamatan'
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
				kelurahan LIKE ?  OR 
				kecamatan LIKE ? 
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
			"id_wilayah",
			"kelurahan",
			"kecamatan" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id_wilayah",
			"kelurahan",
			"kecamatan" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id_wilayah",
			"kelurahan",
			"kecamatan" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id_wilayah",
			"kelurahan",
			"kecamatan" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"kelurahan",
			"kecamatan",
			"id_wilayah" 
		];
	}
}
