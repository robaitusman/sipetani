<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Rph extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'rph';
	

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
		'nama','nama_ketua','alamat','kapasitas','id_wilayah','rt','rw','legalitas','ket_legalitas','gambar','body','visibility','status'
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
				nama_ketua LIKE ?  OR 
				alamat LIKE ?  OR 
				rt LIKE ?  OR 
				rw LIKE ?  OR 
				ket_legalitas LIKE ?  OR 
				gambar LIKE ?  OR 
				body LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"nama",
			"nama_ketua",
			"alamat",
			"kapasitas",
			"id_wilayah",
			"rt",
			"rw",
			"id_map",
			"legalitas",
			"ket_legalitas",
			"gambar",
			"body",
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
			"id",
			"nama",
			"nama_ketua",
			"alamat",
			"kapasitas",
			"id_wilayah",
			"rt",
			"rw",
			"id_map",
			"legalitas",
			"ket_legalitas",
			"gambar",
			"body",
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
			"id",
			"nama",
			"nama_ketua",
			"alamat",
			"kapasitas",
			"id_wilayah",
			"rt",
			"rw",
			"id_map",
			"legalitas",
			"ket_legalitas",
			"gambar",
			"body",
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
			"nama",
			"nama_ketua",
			"alamat",
			"kapasitas",
			"id_wilayah",
			"rt",
			"rw",
			"id_map",
			"legalitas",
			"ket_legalitas",
			"gambar",
			"body",
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
			"nama",
			"nama_ketua",
			"alamat",
			"kapasitas",
			"id_wilayah",
			"rt",
			"rw",
			"legalitas",
			"ket_legalitas",
			"gambar",
			"body",
			"visibility",
			"status",
			"id" 
		];
	}
}
