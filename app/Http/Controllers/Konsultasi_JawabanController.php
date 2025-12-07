<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Konsultasi_JawabanAddRequest;
use App\Http\Requests\Konsultasi_JawabanEditRequest;
use App\Models\Konsultasi_Jawaban;
use Illuminate\Http\Request;
use Exception;
class Konsultasi_JawabanController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.konsultasi_jawaban.list";
		$query = Konsultasi_Jawaban::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Konsultasi_Jawaban::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "konsultasi_jawaban.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Konsultasi_Jawaban::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Konsultasi_Jawaban::query();
		$record = $query->findOrFail($rec_id, Konsultasi_Jawaban::viewFields());
		return $this->renderView("pages.konsultasi_jawaban.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.konsultasi_jawaban.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Konsultasi_JawabanAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Konsultasi_Jawaban record
		$record = Konsultasi_Jawaban::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("konsultasi_jawaban", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Konsultasi_JawabanEditRequest $request, $rec_id = null){
		$query = Konsultasi_Jawaban::query();
		$record = $query->findOrFail($rec_id, Konsultasi_Jawaban::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("konsultasi_jawaban", "Record updated successfully");
		}
		return $this->renderView("pages.konsultasi_jawaban.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Konsultasi_Jawaban::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
