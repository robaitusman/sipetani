<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PoultryAddRequest;
use App\Http\Requests\PoultryEditRequest;
use App\Models\Poultry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class PoultryController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.poultry.list";
		$query = Poultry::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Poultry::search($query, $search); // search table records
		}
		$query->join("wilayah", "poultry.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "poultry.penulis", "=", "aauth_users.id");
		$orderby = $request->orderby ?? "poultry.id_poultry";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Poultry::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Poultry::query();
		$query->join("wilayah", "poultry.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "poultry.penulis", "=", "aauth_users.id");
		$record = $query->findOrFail($rec_id, Poultry::viewFields());
		return $this->renderView("pages.poultry.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.poultry.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PoultryAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
		$modeldata['penulis'] = auth()->user()->id;
		
		//save Poultry record
		$record = Poultry::create($modeldata);
		$rec_id = $record->id_poultry;
		return $this->redirect("poultry", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PoultryEditRequest $request, $rec_id = null){
		$query = Poultry::query();
		$record = $query->findOrFail($rec_id, Poultry::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("poultry", "Record updated successfully");
		}
		return $this->renderView("pages.poultry.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Poultry::query();
		$query->whereIn("id_poultry", $arr_id);
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
	function depan(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.poultry.depan";
		$query = Poultry::query();
		$limit = $request->limit ?? 9999;
		if($request->search){
			$search = trim($request->search);
			Poultry::search($query, $search); // search table records
		}
		$query->leftJoin("wilayah", "poultry.id_wilayah", "=", "wilayah.id_wilayah");
		$orderby = $request->orderby ?? "poultry.id_poultry";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->id_wilayah){
			$val = $request->id_wilayah;
			$query->where(DB::raw("wilayah.id_wilayah"), "=", $val);
		}
		$records = $query->paginate($limit, Poultry::depanFields());
		return $this->renderView($view, compact("records"));
	}
}
