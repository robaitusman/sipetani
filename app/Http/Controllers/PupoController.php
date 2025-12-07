<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PupoAddRequest;
use App\Http\Requests\PupoEditRequest;
use App\Models\Pupo;
use Illuminate\Http\Request;
use Exception;
class PupoController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pupo.list";
		$query = Pupo::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Pupo::search($query, $search); // search table records
		}
		$query->join("wilayah", "pupo.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "pupo.penulis", "=", "aauth_users.id");
		$orderby = $request->orderby ?? "pupo.id_pupo";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Pupo::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Pupo::query();
		$query->join("wilayah", "pupo.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "pupo.penulis", "=", "aauth_users.id");
		$record = $query->findOrFail($rec_id, Pupo::viewFields());
		return $this->renderView("pages.pupo.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.pupo.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PupoAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
		$modeldata['penulis'] = auth()->user()->id;
		
		//save Pupo record
		$record = Pupo::create($modeldata);
		$rec_id = $record->id_pupo;
		return $this->redirect("pupo", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PupoEditRequest $request, $rec_id = null){
		$query = Pupo::query();
		$record = $query->findOrFail($rec_id, Pupo::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("pupo", "Record updated successfully");
		}
		return $this->renderView("pages.pupo.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Pupo::query();
		$query->whereIn("id_pupo", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
