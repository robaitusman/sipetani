<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Jenis_HewanAddRequest;
use App\Http\Requests\Jenis_HewanEditRequest;
use App\Models\Jenis_Hewan;
use Illuminate\Http\Request;
use Exception;
class Jenis_HewanController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.jenis_hewan.list";
		$query = Jenis_Hewan::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Jenis_Hewan::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "jenis_hewan.id_jenis_hewan";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Jenis_Hewan::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Jenis_Hewan::query();
		$record = $query->findOrFail($rec_id, Jenis_Hewan::viewFields());
		return $this->renderView("pages.jenis_hewan.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.jenis_hewan.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Jenis_HewanAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Jenis_Hewan record
		$record = Jenis_Hewan::create($modeldata);
		$rec_id = $record->id_jenis_hewan;
		return $this->redirect("jenis_hewan", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Jenis_HewanEditRequest $request, $rec_id = null){
		$query = Jenis_Hewan::query();
		$record = $query->findOrFail($rec_id, Jenis_Hewan::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("jenis_hewan", "Record updated successfully");
		}
		return $this->renderView("pages.jenis_hewan.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Jenis_Hewan::query();
		$query->whereIn("id_jenis_hewan", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
