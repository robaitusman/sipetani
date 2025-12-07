<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PenyakitAddRequest;
use App\Http\Requests\PenyakitEditRequest;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Exception;
class PenyakitController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.penyakit.list";
		$query = Penyakit::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Penyakit::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "penyakit.id_penyakit";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Penyakit::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Penyakit::query();
		$record = $query->findOrFail($rec_id, Penyakit::viewFields());
		return $this->renderView("pages.penyakit.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.penyakit.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PenyakitAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Penyakit record
		$record = Penyakit::create($modeldata);
		$rec_id = $record->id_penyakit;
		return $this->redirect("penyakit", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PenyakitEditRequest $request, $rec_id = null){
		$query = Penyakit::query();
		$record = $query->findOrFail($rec_id, Penyakit::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("penyakit", "Record updated successfully");
		}
		return $this->renderView("pages.penyakit.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Penyakit::query();
		$query->whereIn("id_penyakit", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
