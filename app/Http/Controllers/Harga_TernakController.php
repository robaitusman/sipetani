<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Harga_TernakAddRequest;
use App\Http\Requests\Harga_TernakEditRequest;
use App\Models\Harga_Ternak;
use Illuminate\Http\Request;
use Exception;
class Harga_TernakController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.harga_ternak.list";
		$query = Harga_Ternak::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Harga_Ternak::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "harga_ternak.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Harga_Ternak::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Harga_Ternak::query();
		$record = $query->findOrFail($rec_id, Harga_Ternak::viewFields());
		return $this->renderView("pages.harga_ternak.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.harga_ternak.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Harga_TernakAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Harga_Ternak record
		$record = Harga_Ternak::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("harga_ternak", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Harga_TernakEditRequest $request, $rec_id = null){
		$query = Harga_Ternak::query();
		$record = $query->findOrFail($rec_id, Harga_Ternak::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("harga_ternak", "Record updated successfully");
		}
		return $this->renderView("pages.harga_ternak.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Harga_Ternak::query();
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
	function widgetharga(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.harga_ternak.widgetharga";
		$query = Harga_Ternak::query();
		$limit = $request->limit ?? 1;
		if($request->search){
			$search = trim($request->search);
			Harga_Ternak::search($query, $search); // search table records
		}
		if($request->orderby){
			$orderby = $request->orderby;
			$ordertype = ($request->ordertype ? $request->ordertype : "desc");
			$query->orderBy($orderby, $ordertype);
		}
		else{
			$query->orderBy("harga_ternak.tanggal", "ASC");
		}
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Harga_Ternak::widgethargaFields());
		return $this->renderView($view, compact("records"));
	}
}
