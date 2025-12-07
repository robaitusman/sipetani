<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Petugas_VaksinAddRequest;
use App\Http\Requests\Petugas_VaksinEditRequest;
use App\Models\Petugas_Vaksin;
use Illuminate\Http\Request;
use Exception;
class Petugas_VaksinController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.petugas_vaksin.list";
		$query = Petugas_Vaksin::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Petugas_Vaksin::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "petugas_vaksin.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Petugas_Vaksin::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Petugas_Vaksin::query();
		$record = $query->findOrFail($rec_id, Petugas_Vaksin::viewFields());
		return $this->renderView("pages.petugas_vaksin.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.petugas_vaksin.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Petugas_VaksinAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Petugas_Vaksin record
		$record = Petugas_Vaksin::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("petugas_vaksin", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Petugas_VaksinEditRequest $request, $rec_id = null){
		$query = Petugas_Vaksin::query();
		$record = $query->findOrFail($rec_id, Petugas_Vaksin::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("petugas_vaksin", "Record updated successfully");
		}
		return $this->renderView("pages.petugas_vaksin.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Petugas_Vaksin::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
