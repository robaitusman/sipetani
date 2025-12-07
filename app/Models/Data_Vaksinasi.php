<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Data_Vaksinasi extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'data_vaksinasi';
	

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
		'tanggal_vaksin','id_petugas','id_vaksin','nama_pemilik','alamat','rt','rw','id_wilayah'
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
				alamat LIKE ?  OR 
				rt LIKE ?  OR 
				rw LIKE ? 
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
			"tanggal_vaksin",
			"id_petugas",
			"id_vaksin",
			"nama_pemilik",
			"alamat",
			"rt",
			"rw",
			"id_wilayah" 
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
			"tanggal_vaksin",
			"id_petugas",
			"id_vaksin",
			"nama_pemilik",
			"alamat",
			"rt",
			"rw",
			"id_wilayah" 
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
			"tanggal_vaksin",
			"id_petugas",
			"id_vaksin",
			"nama_pemilik",
			"alamat",
			"rt",
			"rw",
			"id_wilayah" 
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
			"tanggal_vaksin",
			"id_petugas",
			"id_vaksin",
			"nama_pemilik",
			"alamat",
			"rt",
			"rw",
			"id_wilayah" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"tanggal_vaksin",
			"id_petugas",
			"id_vaksin",
			"nama_pemilik",
			"alamat",
			"rt",
			"rw",
			"id_wilayah",
			"id" 
		];
	}
}
