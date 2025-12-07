<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Data_VaksinasiAddRequest;
use App\Http\Requests\Data_VaksinasiEditRequest;
use App\Models\Data_Vaksinasi;
use Illuminate\Http\Request;
use Exception;
class Data_VaksinasiController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.data_vaksinasi.list";
		$query = Data_Vaksinasi::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Data_Vaksinasi::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "data_vaksinasi.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Data_Vaksinasi::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Data_Vaksinasi::query();
		$record = $query->findOrFail($rec_id, Data_Vaksinasi::viewFields());
		return $this->renderView("pages.data_vaksinasi.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.data_vaksinasi.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Data_VaksinasiAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Data_Vaksinasi record
		$record = Data_Vaksinasi::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("data_vaksinasi", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Data_VaksinasiEditRequest $request, $rec_id = null){
		$query = Data_Vaksinasi::query();
		$record = $query->findOrFail($rec_id, Data_Vaksinasi::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("data_vaksinasi", "Record updated successfully");
		}
		return $this->renderView("pages.data_vaksinasi.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Data_Vaksinasi::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
