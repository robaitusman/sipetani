<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\EvaluasiAdataAddRequest;
use App\Http\Requests\EvaluasiAdataEditRequest;
use App\Models\EvaluasiAdata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class EvaluasiAdataController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.evaluasiadata.list";
		$query = EvaluasiAdata::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			EvaluasiAdata::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "evaluasi_adata.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, EvaluasiAdata::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = EvaluasiAdata::query();
		$record = $query->findOrFail($rec_id, EvaluasiAdata::viewFields());
		return $this->renderView("pages.evaluasiadata.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.evaluasiadata.add");
	}
	

	/**
	 * Save form record to the table
	 * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
	 */
	function store(EvaluasiAdataAddRequest $request){
		try {
			$modeldata = $this->normalizeFormData($request->validated());
			//save EvaluasiAdata record
			$record = EvaluasiAdata::create($modeldata);
			$rec_id = $record->id;
			if ($request->expectsJson() || $request->isJson()) {
				return response()->json([
					'status' => true,
					'success' => true,
					'id' => $rec_id,
					'message' => 'Record added successfully',
					'data' => $record
				]);
			}
			return $this->redirect("evaluasiadata", "Record added successfully");
		} catch (\Illuminate\Validation\ValidationException $e) {
			if ($request->expectsJson() || $request->isJson()) {
				return response()->json([
					'status' => false,
					'success' => false,
					'message' => $e->getMessage(),
					'errors' => $e->errors()
				], 422);
			}
			throw $e;
		} catch (\Exception $e) {
			if ($request->expectsJson() || $request->isJson()) {
				return response()->json([
					'status' => false,
					'success' => false,
					'message' => $e->getMessage()
				], 500);
			}
			throw $e;
		}
	}
	


	function edit(Request $request, $rec_id = null){
    try {
        // Simple validation
        $request->validate([
            'nilai' => 'required|string|max:255',
            'master_adata_id' => 'required|integer',
            'periode_id' => 'required|integer',
            'input_by' => 'required|integer'
        ]);
        
        // Find and update record
        $record = EvaluasiAdata::findOrFail($rec_id);
        
        $record->update([
            'nilai' => $request->input('nilai'),
            'master_adata_id' => $request->input('master_adata_id'),
            'periode_id' => $request->input('periode_id'),
            'input_by' => $request->input('input_by'),
            'updated_at' => now()
        ]);
        
        return response()->json([
            'status' => true,
            'success' => true,
            'id' => $rec_id,
            'message' => 'Record updated successfully',
            'data' => $record->fresh()
        ]);
        
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'status' => false,
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422);
        
    } catch (\Exception $e) {
        \Log::error('Edit error:', ['message' => $e->getMessage(), 'id' => $rec_id]);
        
        return response()->json([
            'status' => false,
            'success' => false,
            'message' => 'Error updating record: ' . $e->getMessage()
        ], 500);
    }
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
		$query = EvaluasiAdata::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
    /**
     * Endpoint action
     * @return \Illuminate\Http\Response
     */
    public function input(Request $request){
        $modeldata =  ['email' => 'john@example.com', 'votes' => 10];
        DB::table('users')->insert($modeldata);
        $sqltext = "SELECT column FROM table WHERE column=:param1";
        $query_params = ["param1" => "value"];
        $records = DB::select($sqltext, $query_params);
        return $records;
    }
}
