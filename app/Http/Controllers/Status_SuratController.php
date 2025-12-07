<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Status_SuratAddRequest;
use App\Http\Requests\Status_SuratEditRequest;
use App\Models\Status_Surat;
use Illuminate\Http\Request;
use Exception;
class Status_SuratController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.status_surat.list";
		$query = Status_Surat::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Status_Surat::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "status_surat.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Status_Surat::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Status_Surat::query();
		$record = $query->findOrFail($rec_id, Status_Surat::viewFields());
		return $this->renderView("pages.status_surat.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.status_surat.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Status_SuratAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Status_Surat record
		$record = Status_Surat::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("status_surat", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Status_SuratEditRequest $request, $rec_id = null){
		$query = Status_Surat::query();
		$record = $query->findOrFail($rec_id, Status_Surat::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("status_surat", "Record updated successfully");
		}
		return $this->renderView("pages.status_surat.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Status_Surat::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
