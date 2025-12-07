<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\KonsultasiAddRequest;
use App\Http\Requests\KonsultasiEditRequest;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Exception;
class KonsultasiController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.konsultasi.list";
		$query = Konsultasi::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Konsultasi::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "konsultasi.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Konsultasi::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Konsultasi::query();
		$record = $query->findOrFail($rec_id, Konsultasi::viewFields());
		return $this->renderView("pages.konsultasi.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.konsultasi.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(KonsultasiAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Konsultasi record
		$record = Konsultasi::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("konsultasi", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(KonsultasiEditRequest $request, $rec_id = null){
		$query = Konsultasi::query();
		$record = $query->findOrFail($rec_id, Konsultasi::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("konsultasi", "Record updated successfully");
		}
		return $this->renderView("pages.konsultasi.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Konsultasi::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
