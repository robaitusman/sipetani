<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kel_TaniAddRequest;
use App\Http\Requests\Kel_TaniEditRequest;
use App\Models\Kel_Tani;
use Illuminate\Http\Request;
use Exception;
class Kel_TaniController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.kel_tani.list";
		$query = Kel_Tani::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Kel_Tani::search($query, $search); // search table records
		}
		$query->join("wilayah", "kel_tani.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "kel_tani.penulis", "=", "aauth_users.id");
		$orderby = $request->orderby ?? "kel_tani.id_kel";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Kel_Tani::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Kel_Tani::query();
		$query->join("wilayah", "kel_tani.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "kel_tani.penulis", "=", "aauth_users.id");
		$record = $query->findOrFail($rec_id, Kel_Tani::viewFields());
		return $this->renderView("pages.kel_tani.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.kel_tani.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.kel_tani.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Kel_TaniAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
		$modeldata['penulis'] = auth()->user()->id;
		
		//save Kel_Tani record
		$record = Kel_Tani::create($modeldata);
		$rec_id = $record->id_kel;
		return $this->redirect("kel_tani", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Kel_TaniEditRequest $request, $rec_id = null){
		$query = Kel_Tani::query();
		$record = $query->findOrFail($rec_id, Kel_Tani::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("kel_tani", "Record updated successfully");
		}
		return $this->renderView("pages.kel_tani.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Kel_Tani::query();
		$query->whereIn("id_kel", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
