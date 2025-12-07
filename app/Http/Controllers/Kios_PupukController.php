<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kios_PupukAddRequest;
use App\Http\Requests\Kios_PupukEditRequest;
use App\Models\Kios_Pupuk;
use Illuminate\Http\Request;
use Exception;
class Kios_PupukController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.kios_pupuk.list";
		$query = Kios_Pupuk::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Kios_Pupuk::search($query, $search); // search table records
		}
		$query->join("wilayah", "kios_pupuk.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "kios_pupuk.penulis", "=", "aauth_users.id");
		$orderby = $request->orderby ?? "kios_pupuk.id_kios";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Kios_Pupuk::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Kios_Pupuk::query();
		$query->join("wilayah", "kios_pupuk.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "kios_pupuk.penulis", "=", "aauth_users.id");
		$record = $query->findOrFail($rec_id, Kios_Pupuk::viewFields());
		return $this->renderView("pages.kios_pupuk.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.kios_pupuk.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Kios_PupukAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
		$modeldata['penulis'] = auth()->user()->id;
		
		//save Kios_Pupuk record
		$record = Kios_Pupuk::create($modeldata);
		$rec_id = $record->id_kios;
		return $this->redirect("kios_pupuk", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Kios_PupukEditRequest $request, $rec_id = null){
		$query = Kios_Pupuk::query();
		$record = $query->findOrFail($rec_id, Kios_Pupuk::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("kios_pupuk", "Record updated successfully");
		}
		return $this->renderView("pages.kios_pupuk.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Kios_Pupuk::query();
		$query->whereIn("id_kios", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
