<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\WilayahAddRequest;
use App\Http\Requests\WilayahEditRequest;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Exception;
class WilayahController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.wilayah.list";
		$query = Wilayah::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Wilayah::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "wilayah.id_wilayah";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Wilayah::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Wilayah::query();
		$record = $query->findOrFail($rec_id, Wilayah::viewFields());
		return $this->renderView("pages.wilayah.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.wilayah.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(WilayahAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Wilayah record
		$record = Wilayah::create($modeldata);
		$rec_id = $record->id_wilayah;
		return $this->redirect("wilayah", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(WilayahEditRequest $request, $rec_id = null){
		$query = Wilayah::query();
		$record = $query->findOrFail($rec_id, Wilayah::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("wilayah", "Record updated successfully");
		}
		return $this->renderView("pages.wilayah.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Wilayah::query();
		$query->whereIn("id_wilayah", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
