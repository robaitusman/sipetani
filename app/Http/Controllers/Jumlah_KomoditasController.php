<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Jumlah_KomoditasAddRequest;
use App\Http\Requests\Jumlah_KomoditasEditRequest;
use App\Models\Jumlah_Komoditas;
use Illuminate\Http\Request;
use Exception;
class Jumlah_KomoditasController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.jumlah_komoditas.list";
		$query = Jumlah_Komoditas::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Jumlah_Komoditas::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "jumlah_komoditas.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Jumlah_Komoditas::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Jumlah_Komoditas::query();
		$record = $query->findOrFail($rec_id, Jumlah_Komoditas::viewFields());
		return $this->renderView("pages.jumlah_komoditas.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.jumlah_komoditas.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Jumlah_KomoditasAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Jumlah_Komoditas record
		$record = Jumlah_Komoditas::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("jumlah_komoditas", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Jumlah_KomoditasEditRequest $request, $rec_id = null){
		$query = Jumlah_Komoditas::query();
		$record = $query->findOrFail($rec_id, Jumlah_Komoditas::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("jumlah_komoditas", "Record updated successfully");
		}
		return $this->renderView("pages.jumlah_komoditas.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Jumlah_Komoditas::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
