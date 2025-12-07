<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permohonan_SuratAddRequest;
use App\Http\Requests\Permohonan_SuratEditRequest;
use App\Models\Permohonan_Surat;
use Illuminate\Http\Request;
use Exception;
class Permohonan_SuratController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.permohonan_surat.list";
		$query = Permohonan_Surat::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Permohonan_Surat::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "permohonan_surat.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Permohonan_Surat::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Permohonan_Surat::query();
		$record = $query->findOrFail($rec_id, Permohonan_Surat::viewFields());
		return $this->renderView("pages.permohonan_surat.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.permohonan_surat.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Permohonan_SuratAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Permohonan_Surat record
		$record = Permohonan_Surat::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("permohonan_surat", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Permohonan_SuratEditRequest $request, $rec_id = null){
		$query = Permohonan_Surat::query();
		$record = $query->findOrFail($rec_id, Permohonan_Surat::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("permohonan_surat", "Record updated successfully");
		}
		return $this->renderView("pages.permohonan_surat.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Permohonan_Surat::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
