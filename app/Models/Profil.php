<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Profil extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'profil';
	

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
		'id_jenis','judul','deskripsi','layanan','jam_kerja','photo','video','penulis','alamat','long','lat'
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
				judul LIKE ?  OR 
				layanan LIKE ?  OR 
				jam_kerja LIKE ?  OR 
				video LIKE ?  OR 
				deskripsi LIKE ?  OR 
				Alamat LIKE ?  OR 
				long LIKE ?  OR 
				lat LIKE ? 
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
			"id_jenis",
			"judul",
			"layanan",
			"jam_kerja",
			"photo",
			"video",
			"penulis",
			"deskripsi",
			"Alamat AS alamat",
			"long",
			"lat" 
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
			"id_jenis",
			"judul",
			"layanan",
			"jam_kerja",
			"photo",
			"video",
			"penulis",
			"deskripsi",
			"Alamat AS alamat",
			"long",
			"lat" 
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
			"id_jenis",
			"judul",
			"layanan",
			"jam_kerja",
			"photo",
			"video",
			"penulis",
			"deskripsi",
			"Alamat AS alamat",
			"long",
			"lat" 
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
			"id_jenis",
			"judul",
			"layanan",
			"jam_kerja",
			"photo",
			"video",
			"penulis",
			"deskripsi",
			"Alamat AS alamat",
			"long",
			"lat" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id_jenis",
			"judul",
			"deskripsi",
			"layanan",
			"jam_kerja",
			"photo",
			"video",
			"penulis",
			"id",
			"Alamat AS alamat",
			"long",
			"lat" 
		];
	}
}
