<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Aauth_UsersAccountEditRequest;
use App\Http\Requests\Aauth_UsersAddRequest;
use App\Http\Requests\Aauth_UsersEditRequest;
use App\Models\Aauth_Users;
use Illuminate\Http\Request;
use Exception;
class Aauth_UsersController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.aauth_users.list";
		$query = Aauth_Users::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Aauth_Users::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "aauth_users.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$allowedRoles = auth()->user()->hasRole(["admin"]);
		if(!$allowedRoles){
			//check if user is the owner of the record.
			$query->where("aauth_users.id", auth()->user()->id);
		}
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Aauth_Users::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.aauth_users.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Aauth_UsersAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("avatar", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['avatar'], "avatar");
			$modeldata['avatar'] = $fileInfo['filepath'];
		}
		$modeldata['password'] = bcrypt($modeldata['password']);
		
		//save Aauth_Users record
		$record = Aauth_Users::create($modeldata);
		$record->assignRole("Admin"); //set default role for user
		$rec_id = $record->id;
		return $this->redirect("aauth_users", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Aauth_UsersEditRequest $request, $rec_id = null){
		$query = Aauth_Users::query();
		$allowedRoles = auth()->user()->hasRole(["admin"]);
		if(!$allowedRoles){
			//check if user is the owner of the record.
			$query->where("aauth_users.id", auth()->user()->id);
		}
		$record = $query->findOrFail($rec_id, Aauth_Users::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("avatar", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['avatar'], "avatar");
			$modeldata['avatar'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("aauth_users", "Record updated successfully");
		}
		return $this->renderView("pages.aauth_users.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Aauth_Users::query();
		$allowedRoles = auth()->user()->hasRole(["admin"]);
		if(!$allowedRoles){
			//check if user is the owner of the record.
			$query->where("aauth_users.id", auth()->user()->id);
		}
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
