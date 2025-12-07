<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Komoditas_PriceAddRequest;
use App\Http\Requests\Komoditas_PriceEditRequest;
use App\Models\Komoditas_Price;
use Illuminate\Http\Request;
use Exception;
class Komoditas_PriceController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.komoditas_price.list";
		$query = Komoditas_Price::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Komoditas_Price::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "komoditas_price.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Komoditas_Price::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Komoditas_Price::query();
		$record = $query->findOrFail($rec_id, Komoditas_Price::viewFields());
		return $this->renderView("pages.komoditas_price.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.komoditas_price.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Komoditas_PriceAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Komoditas_Price record
		$record = Komoditas_Price::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("komoditas_price", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Komoditas_PriceEditRequest $request, $rec_id = null){
		$query = Komoditas_Price::query();
		$record = $query->findOrFail($rec_id, Komoditas_Price::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("komoditas_price", "Record updated successfully");
		}
		return $this->renderView("pages.komoditas_price.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Komoditas_Price::query();
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
	function widget_komoditas(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.komoditas_price.widget_komoditas";
		$query = Komoditas_Price::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Komoditas_Price::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "komoditas_price.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Komoditas_Price::widgetKomoditasFields());
		return $this->renderView($view, compact("records"));
	}
}
