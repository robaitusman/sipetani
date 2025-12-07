<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdataAddRequest;
use App\Http\Requests\MasterAdataEditRequest;
use App\Models\MasterAdata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class MasterAdataController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.masteradata.list";
		$query = MasterAdata::query();
		$limit = $request->limit ?? 60;
		if($request->search){
			$search = trim($request->search);
			MasterAdata::search($query, $search); // search table records
		}
		$query->leftJoin("roles", "master_adata.bidang", "=", "roles.role_id");
		if($request->orderby){
			$orderby = $request->orderby;
			$ordertype = ($request->ordertype ? $request->ordertype : "desc");
			$query->orderBy($orderby, $ordertype);
		}
		else{
			$query->orderBy("master_adata.id", "ASC");
		}
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->bidang){
			$val = $request->bidang;
			$query->where(DB::raw("master_adata.bidang"), "=", $val);
		}
		$records = $query->paginate($limit, MasterAdata::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = MasterAdata::query();
		$query->leftJoin("roles", "master_adata.bidang", "=", "roles.role_id");
		$record = $query->findOrFail($rec_id, MasterAdata::viewFields());
		return $this->renderView("pages.masteradata.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.masteradata.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(MasterAdataAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save MasterAdata record
		$record = MasterAdata::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("masteradata", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(MasterAdataEditRequest $request, $rec_id = null){
		$query = MasterAdata::query();
		$record = $query->findOrFail($rec_id, MasterAdata::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("masteradata", "Record updated successfully");
		}
		return $this->renderView("pages.masteradata.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = MasterAdata::query();
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
	function input(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.masteradata.input";
		$query = MasterAdata::query();
		$limit = $request->limit ?? 999;
		if($request->search){
			$search = trim($request->search);
			MasterAdata::search($query, $search); // search table records
		}
		if($request->orderby){
			$orderby = $request->orderby;
			$ordertype = ($request->ordertype ? $request->ordertype : "desc");
			$query->orderBy($orderby, $ordertype);
		}
		else{
			$query->orderBy("master_adata.id", "ASC");
		}
		$userId = auth()->id();
		$periodeId = $request->get('period') ?? getActivePeriod();
		$query->where("bidang", "=" , auth()->user()->user_role_id);
		$query->leftJoin('evaluasi_adata as evaluasi', function($join) use ($userId, $periodeId){
			$join->on('evaluasi.master_adata_id', '=', 'master_adata.id')
				->where('evaluasi.input_by', '=', $userId)
				->where('evaluasi.periode_id', '=', $periodeId);
		});
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, MasterAdata::inputFields());
		return $this->renderView($view, compact("records", "periodeId"));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function laporan(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.masteradata.laporan";
		$query = MasterAdata::query();
		$limit = $request->limit ?? 2000;
		if($request->search){
			$search = trim($request->search);
			MasterAdata::search($query, $search); // search table records
		}
		$query->leftJoin("roles", "master_adata.bidang", "=", "roles.role_id");
		$userId = $request->get('user_id');
		$periodeId = $request->get('period') ?? getActivePeriod();
		$query->leftJoin('evaluasi_adata as evaluasi', function($join) use ($userId, $periodeId){
			$join->on('evaluasi.master_adata_id', '=', 'master_adata.id')
				->where('evaluasi.periode_id', '=', $periodeId);
			if($userId){
				$join->where('evaluasi.input_by', '=', $userId);
			}
		});
		if($request->orderby){
			$orderby = $request->orderby;
			$ordertype = ($request->ordertype ? $request->ordertype : "desc");
			$query->orderBy($orderby, $ordertype);
		}
		else{
			$query->orderBy("master_adata.id_adata", "ASC");
		}
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, MasterAdata::laporanFields());
		$periodes = DB::table('periode_evaluasi')
			->orderBy('tanggal_mulai', 'desc')
			->orderBy('id', 'desc')
			->get(['id', 'nama_periode', 'tahun', 'status_periode']);
		$selectedPeriode = $periodes->firstWhere('id', $periodeId);
		$periodeLabel = $selectedPeriode
			? ($selectedPeriode->nama_periode ?? 'Periode ' . $selectedPeriode->tahun)
			: 'Periode';
		$cardsAdata = getDashboardCardsAdata($periodeId);
		$summaryAdata = getDashboardSummaryAdata($periodeId);
		return $this->renderView($view, compact("records", "periodes", "periodeId", "periodeLabel", "cardsAdata", "summaryAdata", "userId"));
	}
}
