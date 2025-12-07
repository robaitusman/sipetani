<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pelaku_Usaha_PeternakanAddRequest;
use App\Http\Requests\Pelaku_Usaha_PeternakanEditRequest;
use App\Models\Pelaku_Usaha_Peternakan;
use Illuminate\Http\Request;
use Exception;
class Pelaku_Usaha_PeternakanController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pelaku_usaha_peternakan.list";
		$query = Pelaku_Usaha_Peternakan::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Pelaku_Usaha_Peternakan::search($query, $search); // search table records
		}
		$query->join("wilayah", "pelaku_usaha_peternakan.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "pelaku_usaha_peternakan.penulis", "=", "aauth_users.id");
		$orderby = $request->orderby ?? "pelaku_usaha_peternakan.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Pelaku_Usaha_Peternakan::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Pelaku_Usaha_Peternakan::query();
		$query->join("wilayah", "pelaku_usaha_peternakan.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "pelaku_usaha_peternakan.penulis", "=", "aauth_users.id");
		$record = $query->findOrFail($rec_id, Pelaku_Usaha_Peternakan::viewFields());
		return $this->renderView("pages.pelaku_usaha_peternakan.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.pelaku_usaha_peternakan.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Pelaku_Usaha_PeternakanAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
		$modeldata['penulis'] = auth()->user()->id;
		
		//save Pelaku_Usaha_Peternakan record
		$record = Pelaku_Usaha_Peternakan::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("pelaku_usaha_peternakan", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Pelaku_Usaha_PeternakanEditRequest $request, $rec_id = null){
		$query = Pelaku_Usaha_Peternakan::query();
		$record = $query->findOrFail($rec_id, Pelaku_Usaha_Peternakan::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("pelaku_usaha_peternakan", "Record updated successfully");
		}
		return $this->renderView("pages.pelaku_usaha_peternakan.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Pelaku_Usaha_Peternakan::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
