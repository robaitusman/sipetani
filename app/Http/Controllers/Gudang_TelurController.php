<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Gudang_TelurAddRequest;
use App\Http\Requests\Gudang_TelurEditRequest;
use App\Models\Gudang_Telur;
use Illuminate\Http\Request;
use Exception;
class Gudang_TelurController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.gudang_telur.list";
		$query = Gudang_Telur::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Gudang_Telur::search($query, $search); // search table records
		}
		$query->join("wilayah", "gudang_telur.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "gudang_telur.penulis", "=", "aauth_users.id");
		$orderby = $request->orderby ?? "gudang_telur.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Gudang_Telur::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Gudang_Telur::query();
		$query->join("wilayah", "gudang_telur.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "gudang_telur.penulis", "=", "aauth_users.id");
		$record = $query->findOrFail($rec_id, Gudang_Telur::viewFields());
		return $this->renderView("pages.gudang_telur.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.gudang_telur.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Gudang_TelurAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
		$modeldata['penulis'] = auth()->user()->id;
		
		//save Gudang_Telur record
		$record = Gudang_Telur::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("gudang_telur", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Gudang_TelurEditRequest $request, $rec_id = null){
		$query = Gudang_Telur::query();
		$record = $query->findOrFail($rec_id, Gudang_Telur::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("gudang_telur", "Record updated successfully");
		}
		return $this->renderView("pages.gudang_telur.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Gudang_Telur::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
