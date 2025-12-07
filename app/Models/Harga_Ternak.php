<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Harga_Ternak extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'harga_ternak';
	

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
		'sapi','kambing','domba','ayam_pedaging','ayam_petelor','ayam_petelor_afkir','burung_puyuh','burung_dara','itik','entok','susu_sapi','susu_kambing','tanggal','penulis','daging_sapi','daging_ayam','daging_kambing','daging_babi','harga_telur','daging_bebek'
	];
	public $timestamps = false;
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"sapi",
			"kambing",
			"domba",
			"ayam_pedaging",
			"ayam_petelor",
			"ayam_petelor_afkir",
			"burung_puyuh",
			"burung_dara",
			"itik",
			"entok",
			"susu_sapi",
			"susu_kambing",
			"id",
			"tanggal",
			"penulis",
			"daging_sapi",
			"daging_ayam",
			"daging_kambing",
			"daging_babi",
			"harga_telur",
			"daging_bebek" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"sapi",
			"kambing",
			"domba",
			"ayam_pedaging",
			"ayam_petelor",
			"ayam_petelor_afkir",
			"burung_puyuh",
			"burung_dara",
			"itik",
			"entok",
			"susu_sapi",
			"susu_kambing",
			"id",
			"tanggal",
			"penulis",
			"daging_sapi",
			"daging_ayam",
			"daging_kambing",
			"daging_babi",
			"harga_telur",
			"daging_bebek" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"sapi",
			"kambing",
			"domba",
			"ayam_pedaging",
			"ayam_petelor",
			"ayam_petelor_afkir",
			"burung_puyuh",
			"burung_dara",
			"itik",
			"entok",
			"susu_sapi",
			"susu_kambing",
			"id",
			"tanggal",
			"penulis",
			"daging_sapi",
			"daging_ayam",
			"daging_kambing",
			"daging_babi",
			"harga_telur",
			"daging_bebek" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"sapi",
			"kambing",
			"domba",
			"ayam_pedaging",
			"ayam_petelor",
			"ayam_petelor_afkir",
			"burung_puyuh",
			"burung_dara",
			"itik",
			"entok",
			"susu_sapi",
			"susu_kambing",
			"id",
			"tanggal",
			"penulis",
			"daging_sapi",
			"daging_ayam",
			"daging_kambing",
			"daging_babi",
			"harga_telur",
			"daging_bebek" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"sapi",
			"kambing",
			"domba",
			"ayam_pedaging",
			"ayam_petelor",
			"ayam_petelor_afkir",
			"burung_puyuh",
			"burung_dara",
			"itik",
			"entok",
			"susu_sapi",
			"susu_kambing",
			"tanggal",
			"penulis",
			"id",
			"daging_sapi",
			"daging_ayam",
			"daging_kambing",
			"daging_babi",
			"harga_telur",
			"daging_bebek" 
		];
	}
	

	/**
     * return widgetharga page fields of the model.
     * 
     * @return array
     */
	public static function widgethargaFields(){
		return [ 
			"sapi",
			"kambing",
			"domba",
			"ayam_pedaging",
			"ayam_petelor",
			"ayam_petelor_afkir",
			"burung_puyuh",
			"burung_dara",
			"itik",
			"entok",
			"susu_sapi",
			"susu_kambing",
			"id",
			"tanggal",
			"penulis",
			"daging_sapi",
			"daging_ayam",
			"daging_kambing",
			"daging_babi",
			"harga_telur",
			"daging_bebek" 
		];
	}
	

	/**
     * return exportWidgetharga page fields of the model.
     * 
     * @return array
     */
	public static function exportWidgethargaFields(){
		return [ 
			"sapi",
			"kambing",
			"domba",
			"ayam_pedaging",
			"ayam_petelor",
			"ayam_petelor_afkir",
			"burung_puyuh",
			"burung_dara",
			"itik",
			"entok",
			"susu_sapi",
			"susu_kambing",
			"id",
			"tanggal",
			"penulis",
			"daging_sapi",
			"daging_ayam",
			"daging_kambing",
			"daging_babi",
			"harga_telur",
			"daging_bebek" 
		];
	}
}
