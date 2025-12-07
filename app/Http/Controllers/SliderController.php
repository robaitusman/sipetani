<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderAddRequest;
use App\Http\Requests\SliderEditRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Exception;
class SliderController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.slider.list";
		$query = Slider::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Slider::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "slider.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Slider::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Slider::query();
		$record = $query->findOrFail($rec_id, Slider::viewFields());
		return $this->renderView("pages.slider.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.slider.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(SliderAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("img_slider", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['img_slider'], "img_slider");
			$modeldata['img_slider'] = $fileInfo['filepath'];
		}
		
		//save Slider record
		$record = Slider::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("slider", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(SliderEditRequest $request, $rec_id = null){
		$query = Slider::query();
		$record = $query->findOrFail($rec_id, Slider::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("img_slider", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['img_slider'], "img_slider");
			$modeldata['img_slider'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("slider", "Record updated successfully");
		}
		return $this->renderView("pages.slider.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Slider::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
