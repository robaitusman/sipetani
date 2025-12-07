<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Page extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'page';
	

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
		'title','type','content','fresh_content','keyword','description','link','template'
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
				title LIKE ?  OR 
				type LIKE ?  OR 
				content LIKE ?  OR 
				fresh_content LIKE ?  OR 
				keyword LIKE ?  OR 
				description LIKE ?  OR 
				link LIKE ?  OR 
				template LIKE ? 
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
			"title",
			"type",
			"content",
			"fresh_content",
			"keyword",
			"description",
			"link",
			"template",
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
			"title",
			"type",
			"content",
			"fresh_content",
			"keyword",
			"description",
			"link",
			"template",
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
			"title",
			"type",
			"content",
			"fresh_content",
			"keyword",
			"description",
			"link",
			"template",
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
			"title",
			"type",
			"content",
			"fresh_content",
			"keyword",
			"description",
			"link",
			"template",
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
			"title",
			"type",
			"content",
			"fresh_content",
			"keyword",
			"description",
			"link",
			"template",
			"id" 
		];
	}
}
