<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\P4sAddRequest;
use App\Http\Requests\P4sEditRequest;
use App\Models\P4s;
use Illuminate\Http\Request;
use Exception;
class P4sController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.p4s.list";
		$query = P4s::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			P4s::search($query, $search); // search table records
		}
		$query->join("wilayah", "p4s.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "p4s.penulis", "=", "aauth_users.id");
		$orderby = $request->orderby ?? "p4s.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, P4s::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = P4s::query();
		$query->join("wilayah", "p4s.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "p4s.penulis", "=", "aauth_users.id");
		$record = $query->findOrFail($rec_id, P4s::viewFields());
		return $this->renderView("pages.p4s.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.p4s.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(P4sAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
		$modeldata['penulis'] = auth()->user()->id;
		
		//save P4s record
		$record = P4s::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("p4s", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(P4sEditRequest $request, $rec_id = null){
		$query = P4s::query();
		$record = $query->findOrFail($rec_id, P4s::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("p4s", "Record updated successfully");
		}
		return $this->renderView("pages.p4s.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = P4s::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
