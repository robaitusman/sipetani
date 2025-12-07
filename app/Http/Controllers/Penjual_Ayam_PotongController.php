<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Penjual_Ayam_PotongAddRequest;
use App\Http\Requests\Penjual_Ayam_PotongEditRequest;
use App\Models\Penjual_Ayam_Potong;
use Illuminate\Http\Request;
use Exception;
class Penjual_Ayam_PotongController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.penjual_ayam_potong.list";
		$query = Penjual_Ayam_Potong::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Penjual_Ayam_Potong::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "penjual_ayam_potong.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Penjual_Ayam_Potong::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Penjual_Ayam_Potong::query();
		$record = $query->findOrFail($rec_id, Penjual_Ayam_Potong::viewFields());
		return $this->renderView("pages.penjual_ayam_potong.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.penjual_ayam_potong.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Penjual_Ayam_PotongAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//Validate Photo form data
		$photoPostData = $request->photo;
		$photoValidator = validator()->make($photoPostData, ["*.photo" => "required"]);
		if ($photoValidator->fails()) {
			return $photoValidator->errors();
		}
		$photoValidData = $photoValidator->valid();
		$photoModeldata = array_values($photoValidData);

		if( array_key_exists("photo", $photoModeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($photoModeldata['photo'], "photo");
			 $photoModeldata['photo'] = $fileInfo['filepath'];
		}
		
		//Validate Peta form data
		$petaPostData = $request->peta;
		$petaValidator = validator()->make($petaPostData, ["alamat" => "required",
				"geojson" => "required|string"]);
		if ($petaValidator->fails()) {
			return $petaValidator->errors();
		}
		$petaModeldata = $this->normalizeFormData($petaValidator->valid());
		
		//save Penjual_Ayam_Potong record
		$record = Penjual_Ayam_Potong::create($modeldata);
		$rec_id = $record->id;
		
		// set photo.id_content to penjual_ayam_potong $rec_id
		foreach ($photoModeldata as &$data) {
			$data['id_content'] = $rec_id;
		}
		
		//Save Photo record
		\App\Models\Photo::insert($photoModeldata);
		
        // set peta.id_content to penjual_ayam_potong.id
		$petaModeldata['id_content'] = $rec_id;
		//save Peta record
		$petaRecord = \App\Models\Peta::create($petaModeldata);
		return $this->redirect("penjual_ayam_potong", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Penjual_Ayam_PotongEditRequest $request, $rec_id = null){
		$query = Penjual_Ayam_Potong::query();
		$record = $query->findOrFail($rec_id, Penjual_Ayam_Potong::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("penjual_ayam_potong", "Record updated successfully");
		}
		return $this->renderView("pages.penjual_ayam_potong.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Penjual_Ayam_Potong::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
