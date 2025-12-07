<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileAddRequest;
use App\Http\Requests\ProfileEditRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Exception;
class ProfileController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.profile.list";
		$query = Profile::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Profile::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "profile.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Profile::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Profile::query();
		$record = $query->findOrFail($rec_id, Profile::viewFields());
		return $this->renderView("pages.profile.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.profile.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(ProfileAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Profile record
		$record = Profile::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("profile", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ProfileEditRequest $request, $rec_id = null){
		$query = Profile::query();
		$record = $query->findOrFail($rec_id, Profile::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("profile", "Record updated successfully");
		}
		return $this->renderView("pages.profile.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Profile::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
