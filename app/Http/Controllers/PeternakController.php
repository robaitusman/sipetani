<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PeternakAddRequest;
use App\Http\Requests\PeternakEditRequest;
use App\Models\Peternak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class PeternakController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.peternak.list";
		$query = Peternak::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Peternak::search($query, $search); // search table records
		}
		$query->join("wilayah", "peternak.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "peternak.penulis", "=", "aauth_users.id");
		if($request->orderby){
			$orderby = $request->orderby;
			$ordertype = ($request->ordertype ? $request->ordertype : "desc");
			$query->orderBy($orderby, $ordertype);
		}
		else{
			$query->orderBy("peternak.id", "DESC");
		}
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Peternak::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Peternak::query();
		$query->join("wilayah", "peternak.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("aauth_users", "peternak.penulis", "=", "aauth_users.id");
		$record = $query->findOrFail($rec_id, Peternak::viewFields());
		return $this->renderView("pages.peternak.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.peternak.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(PeternakAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
		$modeldata['penulis'] = auth()->user()->id;
		
		//save Peternak record
		$record = Peternak::create($modeldata);
		$rec_id = $record->id;
		$this->afterAdd($record);
		return $this->redirect("peternak", "Record added successfully");
	}
    /**
     * After new record created
     * @param array $record // newly created record
     */
    private function afterAdd($record){
        //enter statement here
    }
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PeternakEditRequest $request, $rec_id = null){
		$query = Peternak::query();
		$record = $query->findOrFail($rec_id, Peternak::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("peternak", "Record updated successfully");
		}
		return $this->renderView("pages.peternak.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Peternak::query();
		$query->whereIn("id", $arr_id);
		$records = $query->get(['photo']); //get records files to be deleted before delete
		$query->delete();
		foreach($records as $record){
			$this->deleteRecordFiles($record['photo'], "photo"); //delete file after record delete
		}
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
		$view = "pages.peternak.depan";
		$query = Peternak::query();
		$limit = $request->limit ?? 9999;
		if($request->search){
			$search = trim($request->search);
			Peternak::search($query, $search); // search table records
		}
		$query->leftJoin("wilayah", "peternak.id_wilayah", "=", "wilayah.id_wilayah");
		$query->join("jenis_hewan", "peternak.id_jenis_hewan", "=", "jenis_hewan.id_jenis_hewan");
		$orderby = $request->orderby ?? "peternak.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Peternak::depanFields());
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
		$view = "pages.peternak.peta";
		$query = Peternak::query();
		$limit = $request->limit ?? 9999;
		if($request->search){
			$search = trim($request->search);
			Peternak::search($query, $search); // search table records
		}
		$query->leftJoin("jenis_hewan", "peternak.id_jenis_hewan", "=", "jenis_hewan.id_jenis_hewan");
		$query->join("wilayah", "peternak.id_wilayah", "=", "wilayah.id_wilayah");
		$orderby = $request->orderby ?? "peternak.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("lat", "!=" , '');
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->id_wilayah){
			$val = $request->id_wilayah;
			$query->where(DB::raw("peternak.id_wilayah"), "=", $val);
		}
		$records = $query->paginate($limit, Peternak::petaFields());
		return $this->renderView($view, compact("records"));
	}
}
