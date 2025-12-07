<?php 

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
/**
 * Home Page Controller
 * @category  Controller
 */
class HomeController extends Controller{
	/**
     * Index Action
     * @return \Illuminate\View\View
     */
	function index(){
		$user = auth()->user();
		if($user->hasRole('admin')){
			return view("pages.home.admin");
		}
		elseif($user->hasRole('operator_pertanian')){
			return view("pages.home.operator_pertanian");
		}
		elseif($user->hasRole('operator_peternakan')){
			return view("pages.home.operator_peternakan");
		}
		elseif($user->hasRole('operator_ketahanan_pangan')){
			return view("pages.home.operator_ketahanan_pangan");
		}
		elseif($user->hasRole('operator_perikanan')){
			return view("pages.home.operator_perikanan");
		}
		elseif($user->hasRole('pertanian')){
			return view("pages.home.pertanian");
		}
		elseif($user->hasRole('peternakan')){
			return view("pages.home.peternakan");
		}
		elseif($user->hasRole('ketahananpangan')){
			return view("pages.home.ketahananpangan");
		}
		elseif($user->hasRole('perikanan')){
			return view("pages.home.perikanan");
		}
		elseif($user->hasRole('sekretariat')){
			return view("pages.home.sekretariat");
		}
		else{
			return view("pages.home.index");
		}
	}
	
}
