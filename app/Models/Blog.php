<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Blog extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'blog';
	

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
		'title','content','image','category','status','author'
	];
	public $timestamps = true;
	const CREATED_AT = 'date_created'; 
	const UPDATED_AT = 'date_updated'; 
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				title LIKE ?  OR 
				slug LIKE ?  OR 
				tags LIKE ?  OR 
				category LIKE ?  OR 
				status LIKE ?  OR 
				author LIKE ?  OR 
				content LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"slug",
			"image",
			"tags",
			"category",
			"status",
			"author",
			"viewers",
			"date_created",
			"date_updated" 
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
			"slug",
			"image",
			"tags",
			"category",
			"status",
			"author",
			"viewers",
			"date_created",
			"date_updated" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"blog.title AS title",
			"blog.content AS content",
			"blog.image AS image",
			"blog.date_updated AS date_updated",
			"blog.id AS id",
			"aauth_users.id AS aauth_users_id",
			"aauth_users.username AS aauth_users_username" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"blog.title AS title",
			"blog.content AS content",
			"blog.image AS image",
			"blog.date_updated AS date_updated",
			"blog.id AS id",
			"aauth_users.id AS aauth_users_id",
			"aauth_users.username AS aauth_users_username" 
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
			"content",
			"image",
			"category",
			"status",
			"author",
			"id" 
		];
	}
	

	/**
     * return listFront page fields of the model.
     * 
     * @return array
     */
	public static function listFrontFields(){
		return [ 
			"blog.id AS id",
			"blog.title AS title",
			"blog.slug AS slug",
			"blog.content AS content",
			"blog.image AS image",
			"blog.tags AS tags",
			"blog.category AS category",
			"blog.status AS status",
			"blog.author AS author",
			"blog.viewers AS viewers",
			"blog.date_created AS date_created",
			"blog.date_updated AS date_updated",
			"aauth_users.id AS aauth_users_id",
			"aauth_users.email AS aauth_users_email",
			"aauth_users.oauth_uid AS aauth_users_oauth_uid",
			"aauth_users.oauth_provider AS aauth_users_oauth_provider",
			"aauth_users.username AS aauth_users_username",
			"aauth_users.full_name AS aauth_users_full_name",
			"aauth_users.avatar AS aauth_users_avatar",
			"aauth_users.banned AS aauth_users_banned",
			"aauth_users.last_login AS aauth_users_last_login",
			"aauth_users.last_activity AS aauth_users_last_activity",
			"aauth_users.date_created AS aauth_users_date_created",
			"aauth_users.forgot_exp AS aauth_users_forgot_exp",
			"aauth_users.remember_time AS aauth_users_remember_time",
			"aauth_users.remember_exp AS aauth_users_remember_exp",
			"aauth_users.verification_code AS aauth_users_verification_code",
			"aauth_users.top_secret AS aauth_users_top_secret",
			"aauth_users.ip_address AS aauth_users_ip_address",
			"aauth_users.user_role_id AS aauth_users_user_role_id",
			"aauth_users.otp_code AS aauth_users_otp_code",
			"aauth_users.otp_date AS aauth_users_otp_date" 
		];
	}
	

	/**
     * return exportListFront page fields of the model.
     * 
     * @return array
     */
	public static function exportListFrontFields(){
		return [ 
			"blog.id AS id",
			"blog.title AS title",
			"blog.slug AS slug",
			"blog.content AS content",
			"blog.image AS image",
			"blog.tags AS tags",
			"blog.category AS category",
			"blog.status AS status",
			"blog.author AS author",
			"blog.viewers AS viewers",
			"blog.date_created AS date_created",
			"blog.date_updated AS date_updated",
			"aauth_users.id AS aauth_users_id",
			"aauth_users.email AS aauth_users_email",
			"aauth_users.oauth_uid AS aauth_users_oauth_uid",
			"aauth_users.oauth_provider AS aauth_users_oauth_provider",
			"aauth_users.username AS aauth_users_username",
			"aauth_users.full_name AS aauth_users_full_name",
			"aauth_users.avatar AS aauth_users_avatar",
			"aauth_users.banned AS aauth_users_banned",
			"aauth_users.last_login AS aauth_users_last_login",
			"aauth_users.last_activity AS aauth_users_last_activity",
			"aauth_users.date_created AS aauth_users_date_created",
			"aauth_users.forgot_exp AS aauth_users_forgot_exp",
			"aauth_users.remember_time AS aauth_users_remember_time",
			"aauth_users.remember_exp AS aauth_users_remember_exp",
			"aauth_users.verification_code AS aauth_users_verification_code",
			"aauth_users.top_secret AS aauth_users_top_secret",
			"aauth_users.ip_address AS aauth_users_ip_address",
			"aauth_users.user_role_id AS aauth_users_user_role_id",
			"aauth_users.otp_code AS aauth_users_otp_code",
			"aauth_users.otp_date AS aauth_users_otp_date" 
		];
	}
}
