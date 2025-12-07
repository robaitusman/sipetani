<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Jenis_IkanAddRequest;
use App\Http\Requests\Jenis_IkanEditRequest;
use App\Models\Jenis_Ikan;
use Illuminate\Http\Request;
use Exception;
class Jenis_IkanController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.jenis_ikan.list";
		$query = Jenis_Ikan::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Jenis_Ikan::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "jenis_ikan.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Jenis_Ikan::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Jenis_Ikan::query();
		$record = $query->findOrFail($rec_id, Jenis_Ikan::viewFields());
		return $this->renderView("pages.jenis_ikan.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.jenis_ikan.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Jenis_IkanAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Jenis_Ikan record
		$record = Jenis_Ikan::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("jenis_ikan", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Jenis_IkanEditRequest $request, $rec_id = null){
		$query = Jenis_Ikan::query();
		$record = $query->findOrFail($rec_id, Jenis_Ikan::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("jenis_ikan", "Record updated successfully");
		}
		return $this->renderView("pages.jenis_ikan.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Jenis_Ikan::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
