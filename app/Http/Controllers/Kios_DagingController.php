<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kios_DagingAddRequest;
use App\Http\Requests\Kios_DagingEditRequest;
use App\Models\Kios_Daging;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class Kios_DagingController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.kios_daging.list";
		$query = Kios_Daging::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Kios_Daging::search($query, $search); // search table records
		}
		$query->join("wilayah", "kios_daging.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "kios_daging.penulis", "=", "aauth_users.id");
		$orderby = $request->orderby ?? "kios_daging.id_kios";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Kios_Daging::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Kios_Daging::query();
		$query->join("wilayah", "kios_daging.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "kios_daging.penulis", "=", "aauth_users.id");
		$record = $query->findOrFail($rec_id, Kios_Daging::viewFields());
		return $this->renderView("pages.kios_daging.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.kios_daging.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Kios_DagingAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
		$modeldata['penulis'] = auth()->user()->id;
		
		//save Kios_Daging record
		$record = Kios_Daging::create($modeldata);
		$rec_id = $record->id_kios;
		return $this->redirect("kios_daging", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Kios_DagingEditRequest $request, $rec_id = null){
		$query = Kios_Daging::query();
		$record = $query->findOrFail($rec_id, Kios_Daging::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("kios_daging", "Record updated successfully");
		}
		return $this->renderView("pages.kios_daging.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Kios_Daging::query();
		$query->whereIn("id_kios", $arr_id);
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
	function depan(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.kios_daging.depan";
		$query = Kios_Daging::query();
		$limit = $request->limit ?? 99999;
		if($request->search){
			$search = trim($request->search);
			Kios_Daging::search($query, $search); // search table records
		}
		$query->leftJoin("wilayah", "kios_daging.id_wilayah", "=", "wilayah.id_wilayah");
		$orderby = $request->orderby ?? "kios_daging.id_kios";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->id_wilayah){
			$val = $request->id_wilayah;
			$query->where(DB::raw("kios_daging.id_wilayah"), "=", $val);
		}
		$records = $query->paginate($limit, Kios_Daging::depanFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function peta(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.kios_daging.peta";
		$query = Kios_Daging::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Kios_Daging::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "kios_daging.id_kios";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Kios_Daging::petaFields());
		return $this->renderView($view, compact("records"));
	}
}
