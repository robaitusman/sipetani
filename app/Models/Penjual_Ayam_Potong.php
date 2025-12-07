<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Penjual_Ayam_Potong extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'penjual_ayam_potong';
	

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
		'nama_pedagang','lokasi_penjual','kapasitas_max','kontak_hp','legalitas','ket_legalitas','visibility','status'
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
				nama_pedagang LIKE ?  OR 
				lokasi_penjual LIKE ?  OR 
				kontak_hp LIKE ?  OR 
				ket_legalitas LIKE ? 
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
			"nama_pedagang",
			"lokasi_penjual",
			"kapasitas_max",
			"kontak_hp",
			"legalitas",
			"ket_legalitas",
			"status" 
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
			"nama_pedagang",
			"lokasi_penjual",
			"kapasitas_max",
			"kontak_hp",
			"legalitas",
			"ket_legalitas",
			"status" 
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
			"nama_pedagang",
			"lokasi_penjual",
			"kapasitas_max",
			"kontak_hp",
			"legalitas",
			"ket_legalitas",
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
			"id",
			"nama_pedagang",
			"lokasi_penjual",
			"kapasitas_max",
			"kontak_hp",
			"legalitas",
			"ket_legalitas",
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
			"nama_pedagang",
			"lokasi_penjual",
			"kapasitas_max",
			"kontak_hp",
			"legalitas",
			"ket_legalitas",
			"visibility",
			"status",
			"id" 
		];
	}
}
