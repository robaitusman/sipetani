<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pelaku_Usaha_TaniAddRequest;
use App\Http\Requests\Pelaku_Usaha_TaniEditRequest;
use App\Models\Pelaku_Usaha_Tani;
use Illuminate\Http\Request;
use Exception;
class Pelaku_Usaha_TaniController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.pelaku_usaha_tani.list";
		$query = Pelaku_Usaha_Tani::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Pelaku_Usaha_Tani::search($query, $search); // search table records
		}
		$query->join("wilayah", "pelaku_usaha_tani.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "pelaku_usaha_tani.penulis", "=", "aauth_users.id");
		$orderby = $request->orderby ?? "pelaku_usaha_tani.id_pelaku";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Pelaku_Usaha_Tani::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Pelaku_Usaha_Tani::query();
		$query->join("wilayah", "pelaku_usaha_tani.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "pelaku_usaha_tani.penulis", "=", "aauth_users.id");
		$record = $query->findOrFail($rec_id, Pelaku_Usaha_Tani::viewFields());
		return $this->renderView("pages.pelaku_usaha_tani.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.pelaku_usaha_tani.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Pelaku_Usaha_TaniAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
		$modeldata['penulis'] = auth()->user()->id;
		
		//save Pelaku_Usaha_Tani record
		$record = Pelaku_Usaha_Tani::create($modeldata);
		$rec_id = $record->id_pelaku;
		return $this->redirect("pelaku_usaha_tani", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Pelaku_Usaha_TaniEditRequest $request, $rec_id = null){
		$query = Pelaku_Usaha_Tani::query();
		$record = $query->findOrFail($rec_id, Pelaku_Usaha_Tani::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("pelaku_usaha_tani", "Record updated successfully");
		}
		return $this->renderView("pages.pelaku_usaha_tani.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Pelaku_Usaha_Tani::query();
		$query->whereIn("id_pelaku", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
