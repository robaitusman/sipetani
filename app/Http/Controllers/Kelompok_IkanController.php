<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kelompok_IkanAddRequest;
use App\Http\Requests\Kelompok_IkanEditRequest;
use App\Models\Kelompok_Ikan;
use Illuminate\Http\Request;
use Exception;
class Kelompok_IkanController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.kelompok_ikan.list";
		$query = Kelompok_Ikan::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Kelompok_Ikan::search($query, $search); // search table records
		}
		$query->join("wilayah", "kelompok_ikan.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "kelompok_ikan.penulis", "=", "aauth_users.id");
		$orderby = $request->orderby ?? "kelompok_ikan.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Kelompok_Ikan::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Kelompok_Ikan::query();
		$query->join("wilayah", "kelompok_ikan.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "kelompok_ikan.penulis", "=", "aauth_users.id");
		$record = $query->findOrFail($rec_id, Kelompok_Ikan::viewFields());
		return $this->renderView("pages.kelompok_ikan.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.kelompok_ikan.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Kelompok_IkanAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
		$modeldata['penulis'] = auth()->user()->id;
		
		//save Kelompok_Ikan record
		$record = Kelompok_Ikan::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("kelompok_ikan", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Kelompok_IkanEditRequest $request, $rec_id = null){
		$query = Kelompok_Ikan::query();
		$record = $query->findOrFail($rec_id, Kelompok_Ikan::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("kelompok_ikan", "Record updated successfully");
		}
		return $this->renderView("pages.kelompok_ikan.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Kelompok_Ikan::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
