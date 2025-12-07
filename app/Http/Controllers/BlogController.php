<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogAddRequest;
use App\Http\Requests\BlogEditRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Exception;
class BlogController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.blog.list";
		$query = Blog::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Blog::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "blog.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Blog::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Blog::query();
		$query->leftJoin("aauth_users", "blog.author", "=", "aauth_users.id");
		$record = $query->findOrFail($rec_id, Blog::viewFields());
		return $this->renderView("pages.blog.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.blog.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(BlogAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}
		$modeldata['author'] = auth()->user()->id;
		
		//save Blog record
		$record = Blog::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("blog", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(BlogEditRequest $request, $rec_id = null){
		$query = Blog::query();
		$record = $query->findOrFail($rec_id, Blog::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("blog", "Record updated successfully");
		}
		return $this->renderView("pages.blog.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Blog::query();
		$query->whereIn("id", $arr_id);
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
	function list_front(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.blog.list_front";
		$query = Blog::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Blog::search($query, $search); // search table records
		}
		$query->leftJoin("aauth_users", "blog.author", "=", "aauth_users.id");
		$orderby = $request->orderby ?? "blog.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Blog::listFrontFields());
		return $this->renderView($view, compact("records"));
	}
}
