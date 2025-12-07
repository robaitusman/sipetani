<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\TpiAddRequest;
use App\Http\Requests\TpiEditRequest;
use App\Models\Tpi;
use Illuminate\Http\Request;
use Exception;
class TpiController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.tpi.list";
		$query = Tpi::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Tpi::search($query, $search); // search table records
		}
		$query->join("wilayah", "tpi.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "tpi.penulis", "=", "aauth_users.id");
		$orderby = $request->orderby ?? "tpi.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Tpi::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Tpi::query();
		$query->join("wilayah", "tpi.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "tpi.penulis", "=", "aauth_users.id");
		$record = $query->findOrFail($rec_id, Tpi::viewFields());
		return $this->renderView("pages.tpi.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.tpi.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(TpiAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
		$modeldata['penulis'] = auth()->user()->id;
		
		//save Tpi record
		$record = Tpi::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("tpi", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(TpiEditRequest $request, $rec_id = null){
		$query = Tpi::query();
		$record = $query->findOrFail($rec_id, Tpi::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("tpi", "Record updated successfully");
		}
		return $this->renderView("pages.tpi.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Tpi::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
