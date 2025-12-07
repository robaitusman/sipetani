<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoAddRequest;
use App\Http\Requests\PhotoEditRequest;
use App\Models\Photo;
use Illuminate\Http\Request;
use Exception;
class PhotoController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.photo.list";
		$query = Photo::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Photo::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "photo.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Photo::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Photo::query();
		$record = $query->findOrFail($rec_id, Photo::viewFields());
		return $this->renderView("pages.photo.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return view("pages.photo.add");
	}
	

	/**
     * Insert multiple record into the database table
     * @return \Illuminate\Http\Response
     */
	function store(PhotoAddRequest $request){
		$postdata = $request->input("row");
		$modeldata = array_values($postdata);
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
		Photo::insert($modeldata);
		return $this->redirect("photo", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PhotoEditRequest $request, $rec_id = null){
		$query = Photo::query();
		$record = $query->findOrFail($rec_id, Photo::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("photo", "Record updated successfully");
		}
		return $this->renderView("pages.photo.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Photo::query();
		$query->whereIn("id", $arr_id);
		$records = $query->get(['photo']); //get records files to be deleted before delete
		$query->delete();
		foreach($records as $record){
			$this->deleteRecordFiles($record['photo'], "photo"); //delete file after record delete
		}
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
