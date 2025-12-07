<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebAddRequest;
use App\Http\Requests\WebEditRequest;
use App\Models\Web;
use Illuminate\Http\Request;
use Exception;
class WebController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.web.list";
		$query = Web::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Web::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "web.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Web::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Web::query();
		$record = $query->findOrFail($rec_id, Web::viewFields());
		return $this->renderView("pages.web.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.web.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(WebAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Web record
		$record = Web::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("web", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(WebEditRequest $request, $rec_id = null){
		$query = Web::query();
		$record = $query->findOrFail($rec_id, Web::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("web", "Record updated successfully");
		}
		return $this->renderView("pages.web.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Web::query();
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
	function peternakan(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.web.peternakan";
		$query = Web::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Web::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "web.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Web::peternakanFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function pertanian(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.web.pertanian";
		$query = Web::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Web::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "web.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Web::pertanianFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function perikanan(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.web.perikanan";
		$query = Web::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Web::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "web.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Web::perikananFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function ketahananpangan(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.web.ketahananpangan";
		$query = Web::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Web::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "web.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Web::ketahananpanganFields());
		return $this->renderView($view, compact("records"));
	}
}
