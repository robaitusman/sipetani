<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Toko_TaniAddRequest;
use App\Http\Requests\Toko_TaniEditRequest;
use App\Models\Toko_Tani;
use Illuminate\Http\Request;
use Exception;
class Toko_TaniController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.toko_tani.list";
		$query = Toko_Tani::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Toko_Tani::search($query, $search); // search table records
		}
		$query->join("wilayah", "toko_tani.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "toko_tani.penulis", "=", "aauth_users.id");
		$orderby = $request->orderby ?? "toko_tani.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Toko_Tani::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Toko_Tani::query();
		$query->join("wilayah", "toko_tani.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "toko_tani.penulis", "=", "aauth_users.id");
		$record = $query->findOrFail($rec_id, Toko_Tani::viewFields());
		return $this->renderView("pages.toko_tani.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.toko_tani.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Toko_TaniAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
		$modeldata['penulis'] = auth()->user()->id;
		
		//save Toko_Tani record
		$record = Toko_Tani::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("toko_tani", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Toko_TaniEditRequest $request, $rec_id = null){
		$query = Toko_Tani::query();
		$record = $query->findOrFail($rec_id, Toko_Tani::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("toko_tani", "Record updated successfully");
		}
		return $this->renderView("pages.toko_tani.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Toko_Tani::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
