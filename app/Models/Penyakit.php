<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Penyakit extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'penyakit';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id_penyakit';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'nama','vaksin','jenis_hewan','sifat','visibility','status'
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
				nama LIKE ?  OR 
				vaksin LIKE ?  OR 
				jenis_hewan LIKE ?  OR 
				sifat LIKE ? 
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
			"id_penyakit",
			"nama",
			"vaksin",
			"jenis_hewan",
			"sifat",
			"visibility",
			"status",
			"created_at" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id_penyakit",
			"nama",
			"vaksin",
			"jenis_hewan",
			"sifat",
			"visibility",
			"status",
			"created_at" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id_penyakit",
			"nama",
			"vaksin",
			"jenis_hewan",
			"sifat",
			"visibility",
			"status",
			"created_at" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id_penyakit",
			"nama",
			"vaksin",
			"jenis_hewan",
			"sifat",
			"visibility",
			"status",
			"created_at" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id_penyakit",
			"nama",
			"vaksin",
			"jenis_hewan",
			"sifat",
			"visibility",
			"status" 
		];
	}
}
