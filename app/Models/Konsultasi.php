<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Konsultasi extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'konsultasi';
	

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
		'tanggal','penulis','nama','pertanyaan','jawaban','status','jenis'
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
			"tanggal",
			"penulis",
			"nama",
			"pertanyaan",
			"jawaban",
			"status",
			"jenis" 
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
			"tanggal",
			"penulis",
			"nama",
			"pertanyaan",
			"jawaban",
			"status",
			"jenis" 
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
			"tanggal",
			"penulis",
			"nama",
			"pertanyaan",
			"jawaban",
			"status",
			"jenis" 
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
			"tanggal",
			"penulis",
			"nama",
			"pertanyaan",
			"jawaban",
			"status",
			"jenis" 
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
			"penulis",
			"nama",
			"pertanyaan",
			"jawaban",
			"status",
			"jenis",
			"id" 
		];
	}
}
