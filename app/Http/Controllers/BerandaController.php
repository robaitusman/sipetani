<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Beranda;
use Illuminate\Http\Request;
use Exception;
class BerandaController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.beranda.list";
		$query = Beranda::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Beranda::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "beranda.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Beranda::listFields());
		return $this->renderView($view, compact("records"));
	}
}
