<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgendaAddRequest;
use App\Http\Requests\AgendaEditRequest;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Exception;
class AgendaController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.agenda.list";
		$query = Agenda::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Agenda::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "agenda.id_agenda";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Agenda::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Agenda::query();
		$record = $query->findOrFail($rec_id, Agenda::viewFields());
		return $this->renderView("pages.agenda.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return view("pages.agenda.add");
	}
	

	/**
     * Insert multiple record into the database table
     * @return \Illuminate\Http\Response
     */
	function store(AgendaAddRequest $request){
		$postdata = $request->input("row");
		$modeldata = array_values($postdata);
		Agenda::insert($modeldata);
		return $this->redirect("agenda", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(AgendaEditRequest $request, $rec_id = null){
		$query = Agenda::query();
		$record = $query->findOrFail($rec_id, Agenda::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("agenda", "Record updated successfully");
		}
		return $this->renderView("pages.agenda.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Agenda::query();
		$query->whereIn("id_agenda", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
