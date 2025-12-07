<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Komoditas_Price extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'komoditas_price';
	

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
		'tanggal','kebutuhan','ketersediaan','harga','id_trans'
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
				id LIKE ? 
		)';
		$search_params = [
			"%$text%"
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
			"id_komoditas",
			"tanggal",
			"kebutuhan",
			"ketersediaan",
			"harga",
			"id_trans" 
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
			"id_komoditas",
			"tanggal",
			"kebutuhan",
			"ketersediaan",
			"harga",
			"id_trans" 
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
			"id_komoditas",
			"tanggal",
			"kebutuhan",
			"ketersediaan",
			"harga",
			"id_trans" 
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
			"id_komoditas",
			"tanggal",
			"kebutuhan",
			"ketersediaan",
			"harga",
			"id_trans" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"tanggal",
			"kebutuhan",
			"ketersediaan",
			"harga",
			"id_trans",
			"id" 
		];
	}
	

	/**
     * return widgetKomoditas page fields of the model.
     * 
     * @return array
     */
	public static function widgetKomoditasFields(){
		return [ 
			"id",
			"id_komoditas",
			"tanggal",
			"kebutuhan",
			"ketersediaan",
			"harga",
			"id_trans" 
		];
	}
	

	/**
     * return exportWidgetKomoditas page fields of the model.
     * 
     * @return array
     */
	public static function exportWidgetKomoditasFields(){
		return [ 
			"id",
			"id_komoditas",
			"tanggal",
			"kebutuhan",
			"ketersediaan",
			"harga",
			"id_trans" 
		];
	}
}
