<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PeriodeEvaluasiAddRequest;
use App\Http\Requests\PeriodeEvaluasiEditRequest;
use App\Models\PeriodeEvaluasi;
use Illuminate\Http\Request;
use Exception;
class PeriodeEvaluasiController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.periodeevaluasi.list";
		$query = PeriodeEvaluasi::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			PeriodeEvaluasi::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "periode_evaluasi.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PeriodeEvaluasi::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = PeriodeEvaluasi::query();
		$record = $query->findOrFail($rec_id, PeriodeEvaluasi::viewFields());
		return $this->renderView("pages.periodeevaluasi.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.periodeevaluasi.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PeriodeEvaluasiAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['created_by'] = auth()->user()->id;
		
		//save PeriodeEvaluasi record
		$record = PeriodeEvaluasi::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("periodeevaluasi", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PeriodeEvaluasiEditRequest $request, $rec_id = null){
		$query = PeriodeEvaluasi::query();
		$record = $query->findOrFail($rec_id, PeriodeEvaluasi::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("periodeevaluasi", "Record updated successfully");
		}
		return $this->renderView("pages.periodeevaluasi.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = PeriodeEvaluasi::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function evaluasi(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.periodeevaluasi.evaluasi";
		$query = PeriodeEvaluasi::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			PeriodeEvaluasi::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "periode_evaluasi.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("status_periode", "=" , "active");
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, PeriodeEvaluasi::evaluasiFields());
		return $this->renderView($view, compact("records"));
	}
}
