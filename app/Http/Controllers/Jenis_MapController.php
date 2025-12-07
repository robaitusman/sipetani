<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Jenis_MapAddRequest;
use App\Http\Requests\Jenis_MapEditRequest;
use App\Models\Jenis_Map;
use Illuminate\Http\Request;
use Exception;
class Jenis_MapController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.jenis_map.list";
		$query = Jenis_Map::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Jenis_Map::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "jenis_map.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Jenis_Map::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Jenis_Map::query();
		$record = $query->findOrFail($rec_id, Jenis_Map::viewFields());
		return $this->renderView("pages.jenis_map.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.jenis_map.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Jenis_MapAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Jenis_Map record
		$record = Jenis_Map::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("jenis_map", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Jenis_MapEditRequest $request, $rec_id = null){
		$query = Jenis_Map::query();
		$record = $query->findOrFail($rec_id, Jenis_Map::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("jenis_map", "Record updated successfully");
		}
		return $this->renderView("pages.jenis_map.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = Jenis_Map::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
