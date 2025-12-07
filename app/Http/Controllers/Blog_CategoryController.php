<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blog_CategoryAddRequest;
use App\Http\Requests\Blog_CategoryEditRequest;
use App\Models\Blog_Category;
use Illuminate\Http\Request;
use Exception;
class Blog_CategoryController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.blog_category.list";
		$query = Blog_Category::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Blog_Category::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "blog_category.category_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Blog_Category::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Blog_Category::query();
		$record = $query->findOrFail($rec_id, Blog_Category::viewFields());
		return $this->renderView("pages.blog_category.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.blog_category.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Blog_CategoryAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Blog_Category record
		$record = Blog_Category::create($modeldata);
		$rec_id = $record->category_id;
		return $this->redirect("blog_category", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Blog_CategoryEditRequest $request, $rec_id = null){
		$query = Blog_Category::query();
		$record = $query->findOrFail($rec_id, Blog_Category::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("blog_category", "Record updated successfully");
		}
		return $this->renderView("pages.blog_category.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Blog_Category::query();
		$query->whereIn("category_id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
